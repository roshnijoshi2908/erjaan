<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show] process for the proposals
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Documents;
use Illuminate\Contracts\Support\Responsable;

class ShowPreviewResponse implements Responsable {

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

        $payload = $this->payload;
        
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

        //print-mode
        if (request('render') == 'print') {
            config(['visibility.page_rendering' => 'print-page']);
        } else {
            config(['visibility.page_rendering' => 'view']);
        }

        //generate the estimate
        if ($has_estimate) {
            $rendered_estimate = view('pages/bill/bill-embed', compact('page', 'bill', 'taxrates', 'taxes', 'elements', 'units', 'lineitems', 'customfields', 'estimate','data', 'bodyClass'))->render();
        }

        //render the page
        $final_document = view('pages/documents/preview/page', compact('page', 'document', 'payload', 'customfields', 'estimate','data', 'bodyClass'))->render();

        //add estimate
        if ($has_estimate) {
            $final_document = str_replace('{pricing_table}', $rendered_estimate, $final_document);
        } else {
            $final_document = str_replace('{pricing_table}', '', $final_document);
        }

        //replace all other variables
        if ($document->doc_type == 'proposal') {
            $final_document = str_replace('{company_name}', config('system.settings_company_name'), $final_document);
            $final_document = str_replace('{proposal_id}', $document->doc_id, $final_document);
            $final_document = str_replace('{title}', $document->doc_title, $final_document);
            $final_document = str_replace('{proposal_date}', runtimeDate($document->doc_date_start), $final_document);
            $final_document = str_replace('{expiry_date}', runtimeDate($document->doc_date_end), $final_document);
            $final_document = str_replace('{prepared_by_name}', $document->first_name . ' ' . $document->last_name, $final_document);
            $final_document = str_replace('{pricing_total}', runtimeMoneyFormat($bill->bill_final_amount), $final_document);
            $final_document = str_replace('{todays_date}', runtimeDate(now()), $final_document);
        }

        //replace all other variables
        if ($document->doc_type == 'contract') {
            $final_document = str_replace('{company_name}', config('system.settings_company_name'), $final_document);
            $final_document = str_replace('{contract_id}', $document->doc_id, $final_document);
            $final_document = str_replace('{contract_title}', $document->doc_title, $final_document);
            $final_document = str_replace('{contract_date}', runtimeDate($document->doc_date_start), $final_document);
            $final_document = str_replace('{contract_end_date}', runtimeDate($document->doc_date_end), $final_document);
            $final_document = str_replace('{prepared_by_name}', $document->first_name . ' ' . $document->last_name, $final_document);
            $final_document = str_replace('{pricing_table_total}', runtimeMoneyFormat($bill->bill_final_amount), $final_document);
            $final_document = str_replace('{contract_value}', runtimeMoneyFormat($document->doc_value), $final_document);
            $final_document = str_replace('{todays_date}', runtimeDate(now()), $final_document);

            $final_document = str_replace('{client_company_name}', $document->client_company_name, $final_document);
            $final_document = str_replace('{client_phone}', $document->client_phone, $final_document);
            $final_document = str_replace('{client_street}', $document->client_billing_street, $final_document);
            $final_document = str_replace('{client_city}', $document->client_billing_city, $final_document);
            $final_document = str_replace('{client_state}', $document->client_billing_state, $final_document);
            $final_document = str_replace('{client_zip}', $document->client_billing_zip, $final_document);
            $final_document = str_replace('{client_country}', $document->client_billing_country, $final_document);
            $final_document = str_replace('{client_website}', $document->client_website, $final_document);


        }

        if ($document->docresource_type == 'lead') {
            $final_document = str_replace('{client_company_name}', $document->lead_company_name, $final_document);
            $final_document = str_replace('{client_first_name}', $document->lead_firstname, $final_document);
            $final_document = str_replace('{client_last_name}', $document->lead_lastname, $final_document);
        } else {
            $final_document = str_replace('{client_company_name}', $document->client_company_name, $final_document);
            $final_document = str_replace('{client_first_name}', $document->client_first_name, $final_document);
            $final_document = str_replace('{client_last_name}', $document->client_last_name, $final_document);
        }

        //show page
        return $final_document;
    }

}
