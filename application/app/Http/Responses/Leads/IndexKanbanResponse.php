<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the leads
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Leads;
use Illuminate\Contracts\Support\Responsable;

class IndexKanbanResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {
        
        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //was this call made from an embedded page/ajax or directly on team page
        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {

            //template and dom - for additional ajax loading
            switch (request('action')) {

            //from the sorting links
            case 'sort':
                $template = 'pages/leads/components/kanban/wrapper';
                $dom_container = '#leads-view-wrapper';
                $dom_action = 'replace-with';
                break;

            //from search box or filter panel
            case 'search':
                $template = 'pages/leads/components/kanban/wrapper';
                $dom_container = '#leads-view-wrapper';
                $dom_action = 'replace-with';
                break;

            //leadlate and dom - for ajax initial loading
            default:
                $template = 'pages/leads/tabswrapper';
                $dom_container = '#embed-content-container';
                $dom_action = 'replace';
                break;
            }

            //load more button - change the page number and determine buttons visibility
            if (request('action') == 'load') {
                foreach ($boards as $board) {
                    $leads = $board['leads'];
                    $name = $board['name'];
                    $board_id = $board['id'];
                    //only update the clicked button
                    if (request('source') == $board_id) {
                        if ($leads->currentPage() < $leads->lastPage()) {
                            $url = loadMoreButtonUrl($leads->currentPage() + 1, request('source'));
                            $jsondata['dom_attributes'][] = array(
                                'selector' => '#load-more-button-' . $board_id,
                                'attr' => 'data-url',
                                'value' => $url);
                        } else {
                            $jsondata['dom_visibility'][] = array('selector' => '#leads-loadmore-container-' . $board_id, 'action' => 'hide');
                        }
                    }
                }
            } else {
                foreach ($boards as $board) {
                    $leads = $board['leads'];
                    $name = $board['name'];
                    $board_id = $board['id'];
                    if ($leads->currentPage() < $leads->lastPage()) {
                        $url = loadMoreButtonUrl($leads->currentPage() + 1, request('source'));
                        $jsondata['dom_attributes'][] = array(
                            'selector' => '#load-more-button-' . $board_id,
                            'attr' => 'data-url',
                            'value' => $url);
                        //load more - visible
                        //$jsondata['dom_visibility'][] = array('selector' => '#leads-loadmore-container-' . $board_id, 'action' => 'show');
                    } else {
                        $jsondata['dom_visibility'][] = array('selector' => '#leads-loadmore-container-' . $board_id, 'action' => 'hide');
                    }
                }
            }

            //flip sorting url for this particular link - only is we clicked sort menu links
            if (request('action') == 'sort') {
                $sort_url = flipSortingUrl(request()->fullUrl(), request('sortorder'));
                $element_id = '#sort_kanban_' . request('orderby');
                $jsondata['dom_attributes'][] = array(
                    'selector' => $element_id,
                    'attr' => 'data-url',
                    'value' => $sort_url);
            }

            //render the view and save to json
            if (request('action') == 'load') {
                //only append to the single board (load more button clicked)
                if (request()->filled('source')) {

                    //board payload
                    $leads = $board['leads'];
                    $name = request('source');
                    $board = $boards[$name];
                    $board_id = $board['id'];

                    //append the cards
                    $html = view('pages/leads/components/kanban/card', compact('board'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#kanban-board-wrapper-' . $board_id,
                        'action' => 'append',
                        'value' => $html);

                    //remove original loadmore button
                    $jsondata['dom_visibility'][] = [
                        'selector' => '#leads-loadmore-container-' . $board_id,
                        'action' => 'hide-remove',
                    ];

                    //append a new button
                    $board['load_more_url'] = loadMoreButtonUrl($leads->currentPage() + 1, request('source'));
                    $html = view('pages/leads/components/kanban/loadmore-button', compact('board'))->render();
                    $jsondata['dom_html'][] = [
                        'selector' => '#kanban-board-wrapper-' . $board_id,
                        'action' => 'append',
                        'value' => $html,
                    ];
                }
            } else {
                $html = view($template, compact('page', 'boards', 'stats', 'contact_lead', 'categories', 'tags', 'statuses', 'fields'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => $dom_container,
                    'action' => $dom_action,
                    'value' => $html);
            }

            //move the actions buttons
            if (request('source') == 'ext' && request('action') == '') {
                $jsondata['dom_move_element'][] = array(
                    'element' => '#list-page-actions',
                    'newparent' => '.parent-page-actions',
                    'method' => 'replace',
                    'visibility' => 'show');
                $jsondata['dom_visibility'][] = [
                    'selector' => '#list-page-actions-container',
                    'action' => 'show',
                ];
            }

            //for embedded - change breadcrumb title
            $jsondata['dom_html'][] = [
                'selector' => '.active-bread-crumb',
                'action' => 'replace',
                'value' => strtoupper(__('lang.leads')),
            ];

            //reload stats widget
            $html = view('misc/list-pages-stats', compact('stats'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#list-pages-stats-widget',
                'action' => 'replace-with',
                'value' => $html);
            //stats visibility of reload
            if (auth()->user()->stats_panel_position == 'open') {
                $jsondata['dom_visibility'][] = [
                    'selector' => '#list-pages-stats-widget',
                    'action' => 'show-flex',
                ];
            }

            //filter my leads button
            if (auth()->user()->pref_filter_own_leads == 'yes') {
                $jsondata['dom_classes'][] = [
                    'selector' => '#pref_filter_own_leads',
                    'action' => 'add',
                    'value' => 'active',
                ];
            } else {
                $jsondata['dom_classes'][] = [
                    'selector' => '#pref_filter_own_leads',
                    'action' => 'remove',
                    'value' => 'active',
                ];
            }

            //filter my leads button
            if (auth()->user()->pref_filter_show_archived_leads == 'yes') {
                $jsondata['dom_classes'][] = [
                    'selector' => '#pref_filter_show_archived_leads',
                    'action' => 'add',
                    'value' => 'active',
                ];
            } else {
                $jsondata['dom_classes'][] = [
                    'selector' => '#pref_filter_show_archived_leads',
                    'action' => 'remove',
                    'value' => 'active',
                ];
            }

            //add kanban layout
            $jsondata['dom_classes'][] = [
                'selector' => '#pref_view_leads_layout',
                'action' => 'add',
                'value' => 'active',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#main-body',
                'action' => 'add',
                'value' => 'kanban',
            ];
            $jsondata['dom_visibility'][] = [
                'selector' => '#list_actions_sort_kanban',
                'action' => 'show',
                
            ];
            
            $jsondata['dom_visibility'][] = [
                'selector' => '#lead_title',
                'value' => 'show',
                
            ];

            // POSTRUN FUNCTIONS------
            $jsondata['postrun_functions'][] = [
                'value' => 'NXLeadsKanban',
            ];

            //ajax response
            return response()->json($jsondata);

        } else {
            //standard view
            $page['loading_target'] = 'leads-td-container';
            return view('pages/leads/wrapper', compact('page', 'boards', 'stats','categories', 'tags', 'statuses', 'fields'))->render();
        }

    }

}
