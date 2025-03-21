<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [pdf] process for the invoices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Invoices;
use App\Http\Responses\Invoices\PDFResponse;
use Illuminate\Contracts\Support\Responsable;
use PDF;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class PDFResponse implements Responsable {

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
        
        $data = ['request' => request('view'),
                'css' => config('css.bill_mode'),
                'logo' => config('system.settings_system_logo_large_name'),
                'themecss' => config('theme.selected_theme_pdf_css'),
                'url' => url('/'),
                'companyName' => config('system.settings_company_name'),
                'baseDir' => BASE_DIR,
                'pdfCss' => config('system.settings2_bills_pdf_css'),
                'draft' => cleanLang(__('lang.draft')),
                'due' => cleanLang(__('lang.due')),
                'overdue' => cleanLang(__('lang.overdue')),
                'paid' => cleanLang(__('lang.paid')),
                'invoice' => cleanLang(__('lang.invoice')),
                'new' => cleanLang(__('lang.new')),
                'accepted' => cleanLang(__('lang.accepted')),
                'declined' => cleanLang(__('lang.declined')),
                'revised' => cleanLang(__('lang.revised')),
                'expire' => cleanLang(__('lang.expired')),
                'estimate' => cleanLang(__('lang.estimate')),
                'terms' => cleanLang(__('lang.terms')),
                'invoice_date' => cleanLang(__('lang.invoice_date')),
                'due_date' => cleanLang(__('lang.due_date')),
                'estimate_date' => cleanLang(__('lang.estimate_date')),
                'expiry_date' => cleanLang(__('lang.expiry_date')),
                'payments' => cleanLang(__('lang.payments')),
                'balance_due' => cleanLang(__('lang.balance_due')),
                'description' => cleanLang(__('lang.description')),
                'qty'=> cleanLang(__('lang.qty')),
                'unit' => cleanLang(__('lang.unit')),
                'rate' =>cleanLang(__('lang.rate')),
                'tax' => cleanLang(__('lang.tax')),
                'total' => cleanLang(__('lang.total')),
                'css_bill_mode' => config('css.bill_mode'),
                'bill_mode' => config('visibility.bill_mode'),
                'company_address_line_1' => config('system.settings_company_address_line_1'),
                'company_state' => config('system.settings_company_state'),
                'company_city' => config('system.settings_company_city'),
                'company_zipcode' => config('system.settings_company_zipcode'),
                'company_country' =>config('system.settings_company_country'),
                'company_customfield_1' => config('system.settings_company_customfield_1'),
                'company_customfield_2' => config('system.settings_company_customfield_2'),
                'company_customfield_3' => config('system.settings_company_customfield_3'),
                'company_customfield_4' =>config('system.settings_company_customfield_4'),
        ]; 
        
        // Retrieve body class data from the request 
        $bodyClass = $request->bodyClass;
        

        //[debugging purposes] view invoice in browser (https://domain.com/invoice/1/pdf?view=preview)
        if (request('view') == 'preview') {
            config([
                'css.bill_mode' => 'pdf-mode-preview',
                'bill.render_mode' => 'web',
            ]);
            return view('pages/bill/bill-pdf', compact('page', 'bill', 'taxrates', 'taxes', 'elements', 'lineitems', 'customfields','data', 'bodyClass','invoicecolor'))->render();
        }

        //visibility render mode & css mode
        config([
            'css.bill_mode' => 'pdf-mode-download',
            'bill.render_mode' => 'web',
        ]);
        

        //render the bill
        $mpdf = new Mpdf();
        
        $pdf = View::make('pages/bill/bill-pdf',compact('page', 'bill', 'taxrates', 'taxes', 'elements', 'lineitems', 'customfields','data', 'bodyClass','invoicecolor'))->render();
        
        
        $mpdf->SetDirectionality($bodyClass);
        
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($pdf);

        $filename = strtoupper(__('lang.invoice')) . '-' . $bill->formatted_bill_invoiceid . '.pdf'; //invoice_inv0001.pdf
        
        return $mpdf->OutputHttpDownload($filename);
        
    }
}
