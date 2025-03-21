
<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.status'))); ?></label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="purchase_status" name="purchase_status">
    <option value="approved" <?php echo e($purchase->purchase_status === 'approved' ? 'selected' : ''); ?>>
        <?php echo e(cleanLang(__('lang.approved'))); ?>

    </option>
    <option value="rejected" <?php echo e($purchase->purchase_status === 'rejected' ? 'selected' : ''); ?>>
        <?php echo e(cleanLang(__('lang.rejected'))); ?>

    </option>
</select>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/gm/components/actions/change-status.blade.php ENDPATH**/ ?>