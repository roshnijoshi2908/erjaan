<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.status'))); ?></label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="status" name="status">
            <option value="approved" <?php echo e($generalExpence->status === 'approved' ? 'selected' : ''); ?>>
                <?php echo e(cleanLang(__('lang.approved'))); ?>

            </option>
            <option value="rejected" <?php echo e($generalExpence->status === 'rejected' ? 'selected' : ''); ?>>
                <?php echo e(cleanLang(__('lang.rejected'))); ?>

            </option>
        </select>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/gm/components/actions/change-status.blade.php ENDPATH**/ ?>