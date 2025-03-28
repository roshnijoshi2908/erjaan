<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [change status] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\GeneralExpence\GmApprovals;
use Illuminate\Contracts\Support\Responsable;

class ChangeStatusResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        $html = view('pages/generalexpence/gm/components/actions/change-status', compact('generalExpence','accountant','change_status','generalexpencecat','generalexpencesubcat'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        $jsondata['dom_visibility'][] = array('selector' => '#actionsModalFooter', 'action' => 'show');

        //ajax response
        return response()->json($jsondata);

    }

}
