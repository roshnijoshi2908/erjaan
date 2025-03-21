<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the purchase
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Bank;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for general
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //set create mode
        config(['mode.create' => true]);
        
        //render the form
        $html = view('pages/bank/components/modals/add-edit-inc', compact('page'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal footer
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');

        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            'value' => 'NXProposalCreate',
        ];

        //ajax response
        return response()->json($jsondata);
    
        //return view('pages/purchase/purchaseCreate', compact('page','client','project','supplier'))->render();
    }

}
