<div class="row" id="modalBody">
    <div class="col-lg-12">
        <div class="p-b-30">

            <table width="700px" cellpadding="0" cellspacing="0" align="center" style="text-align: left;font-family: 'Poppins', sans-serif;">
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.payment_id'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;">#<?php echo e($payment->payment_id); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.amount'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e(runtimeMoneyFormat($payment->payment_amount)); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.invoice_id'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e(runtimeInvoiceIdFormat($payment->payment_invoiceid)); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.date'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e(runtimeDate($payment->payment_date)); ?></p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.payment_method'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e($payment->payment_gateway); ?></p>
                    </td>
                </tr>
                <?php if(auth()->user()->is_team): ?>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.client'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e($payment->client_company_name); ?></p>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.project'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e($payment->project_title); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;vertical-align: middle;background: #f7f7f7;border:1px solid #edebeb;">
                        <p style="margin: 0px;color: #aab0b3;font-size: 14px;"><?php echo e(cleanLang(__('lang.notes'))); ?></p>
                    </td>
                    <td style="width:50%;border:1px solid #edebeb;padding:8px;vertical-align: middle;">
                        <p style="margin: 0px;color: #747e84;font-size: 14px;"><?php echo e($payment->payment_notes); ?></p>
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
            <img src="<?php echo e(runtimeLogoSmall()); ?>" alt="logo" class="logo-large" style="max-width: 150px; height: auto;" />
        </div>
        <h2 style="color: #ff0000;"><?php echo e(cleanLang(__('lang.payment'))); ?> - #<?php echo e($payment->payment_id); ?></h2>
    </div>

    <!-- Invoice Info -->
    <div class="invoice-info" style="display: flex; justify-content: space-between; padding: 20px 0; border-bottom: 2px solid #edebeb;">
        <div>
            <p style="margin: 0; color: #aab0b3;"><?php echo app('translator')->get('lang.invoice_no'); ?></p>
            <p style="margin: 0; color: #747e84;"><?php echo e(runtimeInvoiceIdFormat($payment->bill_invoiceid)); ?></p>
        </div>
        <div>
            <p style="margin: 0; color: #aab0b3;"><?php echo app('translator')->get('lang.invoice_date'); ?></p>
            <p style="margin: 0; color: #747e84;"><?php echo e(runtimeDate($payment->bill_date)); ?></p>
        </div>
        <div>
            <p style="margin: 0; color: #aab0b3;"><?php echo app('translator')->get('lang.due_date'); ?></p>
            <p style="margin: 0; color: #ff0000;"><?php echo e(runtimeDate($payment->bill_due_date)); ?></p>
        </div>
    </div>

    <?php if( $payment->client_company_name || $payment->project_title): ?>
        <!-- Client and Project Info -->
        <div class="client-project-info" style="display: flex; justify-content: space-between; padding: 20px 0; border-bottom: 2px solid #edebeb;">
            <?php if( $payment->client_company_name): ?>
            <div>
                <p style="margin: 0; color: #aab0b3;"><?php echo e(cleanLang(__('lang.client'))); ?></p>
                <p style="margin: 0; color: #747e84;"><?php echo e($payment->client_company_name); ?></p>
            </div>
            <?php endif; ?>
            <?php if( $payment->project_title): ?>
            <div>
                <p style="margin: 0; color: #aab0b3;"><?php echo e(cleanLang(__('lang.project'))); ?></p>
                <p style="margin: 0; color: #747e84;"><?php echo e($payment->project_title); ?></p>
            </div>
            <?php endif; ?>
            <div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
        </div>
    <?php endif; ?>
    <!-- Payment Summary -->
    <div class="payment-summary" style="padding: 20px 0; border-bottom: 2px solid #edebeb;">
        <h3 style="color: #ff0000; margin-bottom: 10px;"><?php echo e(cleanLang(__('lang.payment_summary'))); ?></h3>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;"><?php echo e(cleanLang(__('lang.amount'))); ?></p>
            <p style="color: #747e84;"><?php echo e(runtimeMoneyFormat($payment->payment_amount)); ?></p>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;"><?php echo e(cleanLang(__('lang.payment_method'))); ?></p>
            <p style="color: #747e84;"><?php echo e($payment->payment_gateway); ?></p>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <p style="color: #747e84;"><?php echo e(cleanLang(__('lang.payment_date'))); ?></p>
            <p style="color: #747e84;"><?php echo e(runtimeDate($payment->payment_date)); ?></p>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="notes-section" style="padding: 20px 0;">
        <p style="color: #aab0b3; margin-bottom: 5px;"><?php echo e(cleanLang(__('lang.notes'))); ?></p>
        <p style="color: #747e84;"><?php echo e($payment->payment_notes); ?></p>
    </div>

    <!-- Total Section -->
    <div class="total-section" style="padding: 20px 0; text-align: right; background-color: #f7f7f7; border-radius: 5px;">
        <h3 style="color: #ff0000; margin-right: 3px;"><?php echo e(cleanLang(__('lang.total'))); ?></h3>
        <h2 style="color: #ff0000; margin-right: 3px;"><?php echo e(runtimeMoneyFormat($payment->payment_amount)); ?></h2>
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
    </script><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/payments/components/modals/show-payment.blade.php ENDPATH**/ ?>