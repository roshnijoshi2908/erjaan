    <!--balances-->
    <div class="pull-right invoice-dues">
        <table>
            <tr>
                <td class="x-payments-lang" id="fx-payments-date-lang"><?php echo e($data['payments']); ?></td>
                <?php if($bill->sum_payments > 0): ?>
                <td class="x-payments add-padding-row"> <a href="javascript:void(0)" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal" data-footer-visibility="hidden"
                        data-url="<?php echo e(urlResource('/payments?action=invoice-payments-modal&paymentresource_type=invoice&paymentresource_id='.$bill->bill_invoiceid)); ?>"
                        data-loading-target="commonModalBody" data-modal-title="<?php echo e($data['payments']); ?>"
                        data-modal-size="modal-lg"><span
                            class="p-l-20"><?php echo _clean(runtimeMoneyFormatPDF($bill->sum_payments)); ?></span></a>
                </td>
                <?php else: ?>

                <td class="x-payments add-padding-row"> <span class="p-l-20"><?php echo _clean(runtimeMoneyFormatPDF(0.00)); ?></span> </td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="x-balance-due-lang"><?php echo e($data['balance_due']); ?> </td>
                <td class="x-balance-due add-padding-row"> <span class="x-due-amount-label">
                        <?php if($bill->invoice_balance > 0): ?>
                        <label class="label label-rounded label-danger"
                            id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                        <?php else: ?>
                        <label class="label label-rounded label-success"
                            id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                        <?php endif; ?>
                    </span>
                    <!--pdf-->
                    <span class="x-due-amount-plain hidden"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></span>
                </td>
            </tr>
        </table>
    </div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bill/components/elements/invoice/payments.blade.php ENDPATH**/ ?>