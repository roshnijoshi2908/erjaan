<!--january-->
<?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <span class="hidden used-for-sorting"><?php echo e(runtimeMonthNumeric($invoice->invoice_month)); ?></span>
        <?php echo e(runtimeLang($invoice->invoice_month)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e($invoice->invoice_count); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($invoice->sum_bill_amount_before_tax)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($invoice->sum_bill_tax_total_amount)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($invoice->sum_bill_discount_amount)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($invoice->sum_bill_adjustment_amount)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($invoice->sum_bill_final_amount)); ?>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/reports/invoices/month/ajax.blade.php ENDPATH**/ ?>