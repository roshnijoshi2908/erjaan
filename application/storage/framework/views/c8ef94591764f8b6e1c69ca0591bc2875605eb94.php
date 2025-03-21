<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo app('translator')->get('lang.status'); ?></label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="project_status" name="project_status">
            <option value="not_started">
                <?php echo e(cleanLang(__('lang.not_started'))); ?></option>
            <option value="in_progress">
                <?php echo e(cleanLang(__('lang.in_progress'))); ?></option>
            <option value="on_hold">
                <?php echo e(cleanLang(__('lang.on_hold'))); ?></option>
            <option value="cancelled">
                <?php echo e(cleanLang(__('lang.cancelled'))); ?></option>
            <option value="completed">
                <?php echo e(cleanLang(__('lang.completed'))); ?></option>
        </select>
    </div>
</div>

<!--skip_notifications-->
<div class="modal-selector m-b-0 m-t-30">
    <div class="form-group form-group-checkbox row">
        <div class="col-12 ">
            <input type="checkbox" id="skip_notifications" name="skip_notifications"
                class="filled-in chk-col-light-blue">
            <label class="p-l-30" for="skip_notifications"><?php echo app('translator')->get('lang.skip_user_notification'); ?> <span
                    class="align-middle text-info font-16" data-toggle="tooltip"
                    title="<?php echo app('translator')->get('lang.skip_user_notification_info'); ?>" data-placement="top"><i
                        class="ti-info-alt"></i></span></label>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/projects/components/modals/bulk-change-status.blade.php ENDPATH**/ ?>