<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $data['companyName'] }}</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">

    <!--
        web preview example
        http://example.com/invoices/29/pdf?view=preview
        {{ BASE_DIR.'/' }}
    -->

    <!--@if(request('view') == 'preview')-->
    <base href="{{ $data['url'] }}" target="_self">
    <link href="public/vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--@else-->
    <!--<base href="" target="_self">-->
    <!--<link href="{{ BASE_DIR }}/public/vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">-->
    <!--@endif-->

    <!-- [DYNAMIC] style sets dynamic paths to font files-->
    <style>
        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path("app/DejaVuSans.ttf") }}') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: 400;
            src: url('{{ storage_path("app/DejaVuSans.ttf") }}') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: bold;
            src: url('{{ storage_path("app/DejaVuSans-Bold.ttf") }}') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: 600;
            src: url('{{ storage_path("app/DejaVuSans-Bold.ttf") }}') format("truetype");
        }
        
        body {font-family: DejaVuSans !important; font-size: 20px !important;}

        @media only screen and (max-width: 640px)  {
            .deviceWidth {width:440px!important; padding:0;}
        }
        @media only screen and (max-width: 479px) {
            .deviceWidth {width:280px!important; padding:0;}
        }
        .text-left {text-align: right;}
        .pl-30 {padding-left: 30px;}
        .rtl .text-right {text-align: right;}
        .rtl .text-left {text-align: left !important;}
        .rtl .pl-30 {padding-left: 0; padding-right: 30px;}
    </style>



<!--@if(request('view') == 'preview')-->
<link href="{{ $data['themecss'] }}" rel="stylesheet">
<!--@else-->
<!--<link href="{{ BASE_DIR }}/{{ config('theme.selected_theme_pdf_css') }}" rel="stylesheet">-->
<!--@endif-->

<!--custom CSS file (DB) -->
{!! customDPFCSS($data['pdfCss']) !!}

</head>

<body>
    <div class="{{$bodyClass}}  {{ $data['css'] }} {{ $page['bill_mode'] ?? '' }}">
        <table width="100%" cellpadding="0" cellspacing="0" align="center" style="text-align: left;font-family: 'Poppins', sans-serif;" class="{{$bodyClass}}">
            <tr>
                <td width="100%" valign="top" bgcolor="#fff">
                    <table width="1000" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                        <tr>
                            <td colspan="2" style="background:#fff; text-align: center;">
                                @if(optional($invoicecolor)->logo == null)
                                    <img src="http://erjaan.erjaan.com/storage/logos/app/kgjvRTJz37JLvL61712734616.png?v=1712734634" style="height: 80px;padding: 10px 10px 10px 10px;">
                                @else
                                    <img src="{{ url('storage/invoice-logo/'.optional($invoicecolor)->logo) }}" style="height: 80px;padding: 10px 10px 10px 10px;">
                                @endif
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 20px;"></td></tr>
                        <tr><td colspan="2" style="height: 1px; background-color: #b9c1ef;"></td></tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td style="text-align: center;">
                                <h1 style="font-family:'Poppins', sans-serif;font-size: 40px;color: #000; letter-spacing: 2px;font-weight: 900; margin: 0;">
                                    <b>
                                        @if($bill->bill_type == 'invoice')
                                        {{ $data['invoice'] }}
                                        @if($bill->bill_status == 'draft')
                                        <span class="js-invoice-statuses {{ runtimeInvoiceStatus('draft', $bill->bill_status) }}" id="invoice-status-draft">
                                            | <span class="{{ runtimeInvoiceStatusColors($bill->bill_status, 'text') }} muted" style="color: #67757c">{{ $data['draft'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status == 'due')
                                        <span class="js-invoice-statuses {{ runtimeInvoiceStatus('due', $bill->bill_status) }}" id="invoice-status-due">
                                            | <span class="{{ runtimeInvoiceStatusColors($bill->bill_status, 'text') }}">{{ $data['due'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status == 'overdue')
                                        <span class="js-invoice-statuses {{ runtimeInvoiceStatus('overdue', $bill->bill_status) }}" id="invoice-status-overdue">
                                            | <span class="{{ runtimeInvoiceStatusColors($bill->bill_status, 'text') }}" style="color: #ff5c6c">{{ $data['overdue'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status == 'paid')
                                        <span class="js-invoice-statuses {{ runtimeInvoiceStatus('paid', $bill->bill_status) }}" id="invoice-status-paid">
                                            | <span class="{{ runtimeInvoiceStatusColors($bill->bill_status, 'text') }}" style="color: #24d2b5">{{ $data['paid'] }}</span>
                                        </span>
                                        @endif
                                        @endif
                                        <!--ESTIMATE HEADER-->
                                        @if($bill->bill_type =='estimate') 
                                        {{ $data['estimate'] }} 
                                        @if($bill->bill_status = 'draft')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('draft', $bill->bill_status) }}" id="estimate-status-draft">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }} muted" style="color: #67757c">{{ $data['draft'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status = 'new')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('new', $bill->bill_status) }}" id="estimate-status-new">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }}">{{ $data['new'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status = 'accepted')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('accepted', $bill->bill_status) }}" id="estimate-status-accpeted">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }}" style="color: #24d2b5">{{ $data['accepted'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status = 'decline')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('declined', $bill->bill_status) }}" id="estimate-status-declined">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }}" style="color: #ff5c6c">{{ $data['declined'] }}</h1>
                                        </span>
                                        @elseif($bill->bill_status = 'revised')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('revised', $bill->bill_status) }}" id="estimate-status-revised">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }}" style="color: #6772e5">{{ $data['revised'] }}</span>
                                        </span>
                                        @elseif($bill->bill_status = 'expired')
                                        <span class="js-estimate-statuses {{ runtimeEstimateStatus('expired', $bill->bill_status) }}" id="estimate-status-expired">
                                            | <span class="text-uppercase {{ runtimeEstimateStatusColors($bill->bill_status, 'text') }}" style="color: #ff9041">{{ $data['expired'] }}</span>
                                        </span>
                                        @endif
                                        @endif
                                    </b>
                                </h1>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 100%; margin:0px;padding:0 30px 0 30px;" class="text-right">
                                <p style="margin: 0px;color: #000000;font-size: 20px;">
                                    <b style="color: {{optional($invoicecolor)->color_code ?? '#000' }};">{{ $bill->client_company_name }}</b> <br> 
                                    @if($bill->client_billing_street)
                                    {{ $bill->client_billing_street }}
                                    @endif
                                    @if($bill->client_billing_city)
                                    <br /> {{ $bill->client_billing_city }}
                                    @endif
                                    @if($bill->client_billing_state)
                                    <br /> {{ $bill->client_billing_state }}
                                    @endif
                                    @if($bill->client_billing_zip)
                                    <br /> {{ $bill->client_billing_zip }}
                                    @endif
                                    @if($bill->client_billing_country)
                                    <br /> {{ $bill->client_billing_country }}
                                    @endif
        
                                    <!--custom fields-->
                                    @foreach($customfields as $field)
                                    @if($field->customfields_show_invoice == 'yes' && $field->customfields_status == 'enabled')
                                    @php $key = $field->customfields_name; @endphp
                                    @php $customfield = $bill[$key] ?? ''; @endphp
                                    @if($customfield != '')
                                    <br />{{ $field->customfields_title }}:
                                    {{ runtimeCustomFieldsFormat($customfield, $field->customfields_datatype) }}
                                    @endif
                                    @endif
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 0 30px;">
                                <table width="100%" class="text-right">
                                    <tr>
                                        @if($bill->bill_type =='invoice')
                                        <td colspan="2">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">{{ $data['invoice'] }} : {{ $bill->formatted_bill_invoiceid  }}</p>
                                        </td>
                                        @endif
                                        <!--ESTIMATE HEADER-->
                                        @if($bill->bill_type =='estimate')
                                        <td colspan="2">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">{{ $data['estimate'] }} : #{{ $bill->formatted_bill_estimateid }}</p>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($bill->bill_type =='invoice')
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.invoice_date') : {{ runtimeDate($bill->bill_date) }}</p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left">
                                            <p style="margin: 0px;text-align: right; color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.payments') : {!! _clean(runtimeMoneyFormatPDF($bill->sum_payments)) !!}</p>
                                        </td>
                                        @endif
                                        @if($bill->bill_type =='estimate')
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.estimate_date') : {{ runtimeDate($bill->bill_date) }}</p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($bill->bill_type =='invoice')
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.due_date') : {{ runtimeDate($bill->bill_due_date) }}</p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left">
                                            <p style="margin: 0px;text-align: right; color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.balance_due') : {!! _clean(runtimeMoneyFormatPDF($bill->invoice_balance)) !!}</p>
                                        </td>
                                        @endif
                                        @if($bill->bill_type =='estimate')
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;">@lang('lang.expiry_date') : {{ runtimeDate($bill->bill_expiry_date) }}</p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left"></td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table style="width: 100%; border-collapse: collapse;" cellpadding="15px" class="text-right">
                                    <thead>
                                        <tr style="background: {{optional($invoicecolor)->color_code ?? '#000' }};">
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.description')) }}</p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.qty')) }}</p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.unit')) }}</p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.rate')) }}</p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.tax')) }}</p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: {{optional($invoicecolor)->text_color_code ?? '#fff' }};font-size: 20px;line-height: 23px;">{{ cleanLang(__('lang.total')) }}</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="billing-items-container">
                                        @include('pages.bill.components.elements.lineitems')
                                    </tbody>
                                </table>
                                <table style="width: 100%;">
                                    <tr style="vertical-align: top;">
                                        <td style="width:60%">
                                        <td style="padding:20px 0 0 30px; margin-right: auto;" class="text-left">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b>{{ cleanLang(__('lang.subtotal')) }}</b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b>{!! runtimeMoneyFormatPDF($bill->bill_subtotal) !!}</b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b>{{ cleanLang(__('lang.discount')) }}
                                                                @if($bill->bill_discount_type == 'percentage')
                                                                <span class="x-small" id="dom-billing-discount-type">({{ $bill->bill_discount_percentage }}%)</span>
                                                                @else
                                                                <span class="x-small" id="dom-billing-discount-type">({{ cleanLang(__('lang.fixed')) }})</span>
                                                                @endif
                                                            </b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            - <b>{!! runtimeMoneyFormatPDF($bill->bill_discount_amount) !!}</b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b>{{ cleanLang(__('lang.total')) }}</b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b>{!! runtimeMoneyFormatPDF($bill->bill_final_amount) !!}</b>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 50px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 0 30px;">
                                <table>
                                    <tr>
                                        <td class="text-right">
                                            <h4 style="margin-bottom: 5px; padding: 0 0 10px 0;"><b>{{ $data['terms'] }}</b></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="paddint-top: 10px;" class="text-right">
                                            <p style="margin: 5px 0;">{!! clean($bill->bill_terms) !!}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 50px;"></td></tr>
                        <tr>
                            <td style="width: 100%;padding: 20px; background: {{optional($invoicecolor)->color_code ?? '#000' }}; text-align: center;">
                                <table>
                                    <tr>
                                        <td>
                                            <p style="margin: 0px;text-align: center; color: {{optional($invoicecolor)->text_color_code ?? '#fff' }}; font-size: 20px;font-weight: 400;">@lang('lang.if_you_have_any_questions') info@example.com</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <p style="margin: 0;text-align: center; color: {{optional($invoicecolor)->text_color_code ?? '#fff' }}; font-size: 20px;font-weight: 500;">@lang('lang.thank_you_for_your_business')</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>