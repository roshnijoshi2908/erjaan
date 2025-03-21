<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the projects
 * controller
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Home;

use Illuminate\Contracts\Support\Responsable;

class HomesResponse implements Responsable
{

    private $payload;

    public function __construct($payload = array())
    {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
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

        $payload = $this->payload;

        //show dashboard
        return view('pages/home/dashboard', compact('page', 'payload', 'leads', 'stats', 'statuses', 'boards', 'statusCounts', 'statusCount', 'convertedQualifiedRatio', 'conversionRatio', 'categoryData', 'categoryValue', 'leadSourceData', 'leadSourceValue', 'leadsData', 'leadsValue', 'leadTop3', 'top3Revenues'))->render();
    }
}
