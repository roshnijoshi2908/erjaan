
<?php $__env->startSection('settings_content'); ?>

<!--form-->
<div class="card">
    <div class="card-body" id="landlord-settings-form">

        <form class="form" id="settingsForm">


            <!--title-->
            <div class="form-group row">
                <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.title'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="settings_code_meta_title"
                        name="settings_code_meta_title" value="<?php echo e($settings->settings_code_meta_title ?? ''); ?>">
                </div>
            </div>


            <!--description-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.description'); ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control form-control-sm" rows="5" name="settings_code_meta_description"
                        id="settings_code_meta_description"><?php echo e($settings->settings_code_meta_description ?? ''); ?></textarea>
                </div>
            </div>

            <div class="alert alert-info"><?php echo app('translator')->get('lang.meta_tags_info'); ?>
            </div>

            <!--submit-->
            <div class="text-right">
                <button type="submit" id="commonModalSubmitButton"
                    class="btn btn-rounded-x btn-danger btn-sm waves-effect text-left ajax-request"
                    data-url="<?php echo e(url('/app-admin/frontend/metatags')); ?>" data-form-id="landlord-settings-form"
                    data-loading-target="" data-ajax-type="post" data-type="form"
                    data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.frontend.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/metatags/page.blade.php ENDPATH**/ ?>