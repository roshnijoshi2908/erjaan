    <!--dates-->
    <div class="pull-left invoice-dates">
        <table class="estimate-date-table">
            <tr>
                <td class="x-date-lang" id="fx-estimate-date-lang"><?php echo e($data['estimate_date']); ?> </td>
                <?php if($data['bill_mode'] == 'editing'): ?>
                <td class="add-padding-row"><input type="text" class="form-control form-control-xs pickadate" name="bill_date"
                        autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_date)); ?>">
                    <input class="mysql-date" type="hidden" name="bill_date" id="bill_date"
                        value="<?php echo e($bill->bill_date); ?>">
                </td>
                <?php else: ?>
                <td class="x-date add-padding-row"> <span><?php echo e(runtimeDate($bill->bill_date)); ?></span></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="x-date-due-lang"><?php echo e($data['expiry_date']); ?></td>
                <?php if($data['bill_mode'] == 'editing'): ?>
                <td class="add-padding-row"><input type="text" class="form-control form-control-xs pickadate" name="bill_expiry_date"
                        autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_expiry_date)); ?>">
                    <input class="mysql-date" type="hidden" name="bill_expiry_date" id="bill_expiry_date"
                        value="<?php echo e($bill->bill_expiry_date); ?>">
                </td>
                <?php else: ?>
                <td class="x-date-due add-padding-row"> <span><?php echo e(runtimeDate($bill->bill_expiry_date)); ?></span></td>
                <?php endif; ?>
            </tr>
        </table>
    </div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bill/components/elements/estimate/dates.blade.php ENDPATH**/ ?>