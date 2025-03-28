<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\GeneralExpence\Accountant;
use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for gmApprovels
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //update initiated on a list page
        // if (request('ref') == 'list') {

            //replace the row of this record
            if (auth()->user()->pref_view_projects_layout == 'list') {
                $html = view('pages/generalexpence/components/table/ajax', compact('generalexpence','change_status','accountant'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => "#generalexpence_" . $generalexpence_id,
                    'action' => 'replace-with',
                    'value' => $html);
            }

            //update cards view
                $html = view('pages/generalexpence/components/table/ajax', compact('generalexpence','change_status','accountant'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => "#generalexpence_" . $generalexpence_id,
                    'action' => 'replace-with',
                    'value' => $html);

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '.modal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        // }

        // //editing from main page
        // if (request('ref') == 'page') {

        //     //close modal
        //     $jsondata['dom_visibility'][] = array('selector' => '.modal', 'action' => 'close-modal');

        //     //redirect to gm-approvals page
        //     $jsondata['redirect_url'] = url("gm-approvals/$purchase_id");
        // }

        //response
        return response()->json($jsondata);
    }

}
