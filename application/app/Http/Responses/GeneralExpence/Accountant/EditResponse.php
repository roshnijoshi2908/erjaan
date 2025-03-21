<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [change status] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\GeneralExpence\Accountant;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable {

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
        $html = view('pages/generalexpence/accountant/components/actions/edit', compact('generalExpence','banks'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        $jsondata['dom_visibility'][] = array('selector' => '#actionsModalFooter', 'action' => 'show');

        //ajax response
        return response()->json($jsondata);

    }

}
