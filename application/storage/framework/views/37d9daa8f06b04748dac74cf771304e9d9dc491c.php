<div class="form-group row m-b-50">
    <label class="col-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.users'); ?>
        <span class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.bulk_assign_info'); ?>"
            data-placement="top"><i class="ti-info-alt"></i></span></label>
    <div class="col-12">
        <select name="assigned" id="assigned"
            class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
            multiple="multiple" tabindex="-1" aria-hidden="true">
            <!--users list-->
            <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>">
                <?php echo e($user->full_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--/#users list-->
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
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/projects/components/modals/bulk-assign.blade.php ENDPATH**/ ?>