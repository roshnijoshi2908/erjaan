
<!--totals-->
<tr class="report-results-table-totals">
    <td colspan="1"><?php echo app('translator')->get('lang.page_totals'); ?></td>
    <td><?php echo e($totals['count_estimates'] ?? 0); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_before_tax'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_tax'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_discount'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_adjustment'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_final_amount'] ?? 0)); ?>

    </td>
</tr><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/reports/estimates/month/footer.blade.php ENDPATH**/ ?>