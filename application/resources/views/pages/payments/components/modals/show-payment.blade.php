<div class="row" id="modalBody">
    <div class="col-lg-12">
        <div class="p-b-30">

            <table width="700px" cellpadding="0" cellspacing="0" align="center" style="text-align: left;font-family: 'Poppins', sans-serif;">
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.payment_id')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">#{{ $payment->payment_id }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.amount')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ runtimeMoneyFormat($payment->payment_amount) }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.invoice_id')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ runtimeInvoiceIdFormat($payment->payment_invoiceid) }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.date')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ runtimeDate($payment->payment_date) }}</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.payment_method')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ $payment->payment_gateway }}</p>
                    </td>
                </tr>
                @if(auth()->user()->is_team)
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.client')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ $payment->client_company_name }}</p>
                    </td>
                </tr>
                @endif
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.project')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ $payment->project_title }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;">{{ cleanLang(__('lang.notes')) }}</p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">{{ $payment->payment_notes }}</p>
                    </td>
                </tr>
            </table>
           
        </div>
    </div>
</div>

<div class="invoice-container" id="hiddenContent" style="display:none; max-width: 700px; margin: auto; font-family: 'Poppins', sans-serif; color: #747e84; background-color: #fff; padding: 20px; border: 1px solid #edebeb; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <!-- Header -->
    <div class="invoice-header" style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #edebeb; position: relative;">
        <div style="position: absolute;left: 10px;">
            <img src="{{ runtimeLogoSmall() }}" alt="logo" class="logo-large" style="max-width: 150px; height: auto;" />
        </div>
        <h2 style="color: #ff0000;">{{ cleanLang(__('lang.payment')) }} - #{{ $payment->payment_id }}</h2>
    </div>

    <!-- Invoice Info -->
    <div class="invoice-info" style="display: flex; justify-content: space-between; padding: 20px 0; border-bottom: 2px solid #edebeb;">
        <div>
            <p style="margin: 0; color: #aab0b3;">@lang('lang.invoice_no')</p>
            <p style="margin: 0; color: #747e84;">{{ runtimeInvoiceIdFormat($payment->bill_invoiceid) }}</p>
        </div>
        <div>
            <p style="margin: 0; color: #aab0b3;">@lang('lang.invoice_date')</p>
            <p style="margin: 0; color: #747e84;">{{ runtimeDate($payment->bill_date) }}</p>
        </div>
        <div>
            <p style="margin: 0; color: #aab0b3;">@lang('lang.due_date')</p>
            <p style="margin: 0; color: #ff0000;">{{ runtimeDate($payment->bill_due_date) }}</p>
        </div>
    </div>

    @if( $payment->client_company_name || $payment->project_title)
        <!-- Client and Project Info -->
        <div class="client-project-info" style="display: flex; justify-content: space-between; padding: 20px 0; border-bottom: 2px solid #edebeb;">
            @if( $payment->client_company_name)
            <div>
                <p style="margin: 0; color: #aab0b3;">{{ cleanLang(__('lang.client')) }}</p>
                <p style="margin: 0; color: #747e84;">{{ $payment->client_company_name }}</p>
            </div>
            @endif
            @if( $payment->project_title)
            <div>
                <p style="margin: 0; color: #aab0b3;">{{ cleanLang(__('lang.project')) }}</p>
                <p style="margin: 0; color: #747e84;">{{ $payment->project_title }}</p>
            </div>
            @endif
            <div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
        </div>
    @endif
    <!-- Payment Summary -->
    <div class="payment-summary" style="padding: 20px 0; border-bottom: 2px solid #edebeb;">
        <h3 style="color: #ff0000; margin-bottom: 10px;">{{ cleanLang(__('lang.payment_summary')) }}</h3>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;">{{ cleanLang(__('lang.amount')) }}</p>
            <p style="color: #747e84;">{{ runtimeMoneyFormat($payment->payment_amount) }}</p>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;">{{ cleanLang(__('lang.payment_method')) }}</p>
            <p style="color: #747e84;">{{ $payment->payment_gateway }}</p>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;">{{ cleanLang(__('lang.payment_date')) }}</p>
            <p style="color: #747e84;">{{ runtimeDate($payment->payment_date) }}</p>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="notes-section" style="padding: 20px 0;">
        <p style="color: #aab0b3; margin-bottom: 5px;">{{ cleanLang(__('lang.notes')) }}</p>
        <p style="color: #747e84;">{{ $payment->payment_notes }}</p>
    </div>

    <!-- Total Section -->
    <div class="total-section" style="padding: 20px 0; text-align: right; background-color: #f7f7f7; border-radius: 5px;">
        <h3 style="color: #ff0000; margin-right: 3px;">{{ cleanLang(__('lang.total')) }}</h3>
        <h2 style="color: #ff0000; margin-right: 3px;">{{ runtimeMoneyFormat($payment->payment_amount) }}</h2>
    </div>
</div>



 <button type="button" class="btn btn-primary" onclick="printModalContent()">Print</button>
            
<script>

    function printModalContent() {
        const printContent = document.getElementById('hiddenContent').innerHTML;
        hiddenContent.style.display = 'block';
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.open();
        printWindow.document.write(`
            <body>${printContent}</body>
            
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        hiddenContent.style.display = 'none';
    }
    </script>