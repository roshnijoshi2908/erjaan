
<?php $__env->startSection('settings_content'); ?>

<!--form-->
<div class="card">
    <div class="card-body landlord-settings-start" id="landlord-settings-form">

        <img src="<?php echo e(url('public/images/landlord-settings-start.svg')); ?>" alt="<?php echo app('translator')->get('lang.frontend'); ?>" />

    </div>
</div>

<form class="form" id="settingsFormStart">

    <!--settings_frontend_domain-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.front_end_domain'); ?> <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.frontend_domain_info'); ?>"
                data-placement="top"><i class="ti-info-alt"></i></span></label>
        <div class="col-sm-12">
            <input type="text" class="form-control form-control-sm" id="settings_frontend_domain"
                name="settings_frontend_domain" value="<?php echo e($settings->settings_frontend_domain ?? ''); ?>">
        </div>
    </div>

    <!--frontend-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.frontend_status'); ?></label>
        <div class="col-sm-12">
            <select class="select2-basic form-control form-control-sm select2-preselected" id="settings_frontend_status"
                name="settings_frontend_status" data-preselected="<?php echo e($settings->settings_frontend_status ?? ''); ?>">
                <option></option>
                <option value="enabled"><?php echo app('translator')->get('lang.enabled'); ?></option>
                <option value="disabled"><?php echo app('translator')->get('lang.disabled'); ?></option>
            </select>
        </div>
    </div>

    <!--submit-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton"
            class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
            data-url="<?php echo e(url('app-admin/frontend/start')); ?>" data-form-id="settingsFormStart" data-loading-target=""
            data-ajax-type="post" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.frontend.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/start/page.blade.php ENDPATH**/ ?>