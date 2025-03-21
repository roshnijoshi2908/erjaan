<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show] process for the estimates
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Estimates;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable {

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

        //visibility of tax selector, files section & bill rendering mode
        config([
            'visibility.bill_files_section' => true,
            'visibility.tax_type_selector' => true,
            'bill.render_mode' => 'web'
        ]);
        
        $data = ['estimate_date' => cleanLang(__('lang.estimate_date')),
                        'expiry_date' => cleanLang(__('lang.expiry_date')),
                        'bill_mode' => config('visibility.bill_mode'),
                        'css_bill_mode' => config('css.bill_mode'),
                        'due_date' => cleanLang(__('lang.due_date')),
                        'payments' => cleanLang(__('lang.payments')),
                        'balance_due' => cleanLang(__('lang.balance_due')),
                        'description' => cleanLang(__('lang.description')),
                        'qty'=> cleanLang(__('lang.qty')),
                        'unit' => cleanLang(__('lang.unit')),
                        'rate' =>cleanLang(__('lang.rate')),
                        'tax' => cleanLang(__('lang.tax')),
                        'total' => cleanLang(__('lang.total')),
            ];
            
            $bodyClass = $request->bodyClass;

        //render the page
        return view('pages/bill/wrapper', compact('page', 'bill', 'taxrates', 'taxes', 'elements', 'units', 'lineitems', 'customfields', 'files','data','bodyClass','invoicecolor'))->render();

    }

}
