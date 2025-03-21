<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the proposal
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Accountant;
use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for proposal members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

         //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        //replace the row of this record
        $html = view('pages/accountant/proposals/components/table/ajax', compact('templates'))->render();
       $jsondata['dom_html'][] = array(
            'selector' => "#template_" . $templates->first()->purchase_id,
            'action' => 'replace-with', // Replaces the old row with the new HTML
            'value' => $html,
        );
        // dd($html);
       
        //close modal
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);


    }

}
