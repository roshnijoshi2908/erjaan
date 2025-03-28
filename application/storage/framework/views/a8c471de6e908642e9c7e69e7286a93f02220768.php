
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form">

    <!--keyid-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label required"><?php echo e(cleanLang(__('lang.key_id'))); ?>*
            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.razorpay_general_info'))); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span>
        </label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_razorpay_keyid"
                name="settings_razorpay_keyid" value="<?php echo e($settings->settings_razorpay_keyid ?? ''); ?>">
        </div>
    </div>

    <!--secret key-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label required"><?php echo e(cleanLang(__('lang.secret_key'))); ?>*
            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.razorpay_general_info'))); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span>
        </label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_razorpay_secretkey"
                name="settings_razorpay_secretkey" value="<?php echo e($settings->settings_razorpay_secretkey ?? ''); ?>">
        </div>
    </div>

    <!--currency-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label required"><?php echo e(cleanLang(__('lang.currency'))); ?>*
            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.payment_gateway_currency_code_example'))); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span>
        </label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_razorpay_currency"
                name="settings_razorpay_currency" value="<?php echo e($settings->settings_razorpay_currency ?? ''); ?>">
        </div>
    </div>



    <!--display name-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label required"><?php echo e(cleanLang(__('lang.display_name'))); ?>*
            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.display_name_info'))); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span>
        </label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_razorpay_display_name"
                name="settings_razorpay_display_name" value="<?php echo e($settings->settings_razorpay_display_name ?? ''); ?>">
        </div>
    </div>

    <!--webhooks url-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label required"><?php echo e(cleanLang(__('lang.webhooks_url'))); ?>*
            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.add_this_inside_your_dashboard'))); ?> (Razorpay)" data-placement="top"><i
                    class="ti-info-alt"></i></span>
        </label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_razorpay_ipn_url"
                name="settings_razorpay_ipn_url" value="<?php echo e(url('/api/razorpay/webhooks')); ?>" disabled>
        </div>
    </div>

    <!--Enabled-->
    <div class="form-group form-group-checkbox row">
        <label class="col-3 col-form-label" title="Foo"><?php echo e(cleanLang(__('lang.enable_payment_method'))); ?></label>
        <div class="col-9 p-t-5">
            <input type="checkbox" id="settings_razorpay_status" name="settings_razorpay_status"
                class="filled-in chk-col-light-blue" <?php echo e(runtimePrechecked($settings->settings_razorpay_status)); ?>>
            <label for="settings_razorpay_status"></label>
        </div>
    </div>


    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton"
            class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request" data-url="/settings/razorpay"
            data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<a href="https://growcrm.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
        class="ti-info-alt"></i>
    <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

</a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/settings/sections/razorpay/page.blade.php ENDPATH**/ ?>