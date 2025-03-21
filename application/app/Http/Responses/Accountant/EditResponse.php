<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the project
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Accountant;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{

    private $payload;

    public function __construct($payload = array())
    {
        $this->payload = $payload;
    }

    /**
     * render the view for project members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        $html = view('pages/accountant/proposals/components/modals/add-edit-inc', compact('page', 'purchase', 'banks', 'categories', 'fields'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html
        );

        //show modal projectter
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');

        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            // 'value' => 'NXAddEditProjectTemplate',
        ];

        //ajax response
        return response()->json($jsondata);
    }
}
