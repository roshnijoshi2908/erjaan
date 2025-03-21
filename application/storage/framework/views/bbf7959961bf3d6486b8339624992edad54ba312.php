
<?php $__env->startSection('settings_content'); ?>

<!--tabs menu-->
<?php echo $__env->make('landlord.frontend.components.home-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--form-->
<div class="card">
    <div class="card-body" id="landlord-settings-form">

        <form class="form" id="settingsForm">


            <!--heading_1-->
            <div class="form-group row">
                <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.heading_1'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="frontend_data_1" name="frontend_data_1"
                        value="<?php echo e($section->frontend_data_1 ?? ''); ?>">
                </div>
            </div>

            <!--description-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.description'); ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control form-control-sm tinymce-textarea" rows="15" name="html_frontend_data_2"
                        id="html_frontend_data_2"><?php echo e($section->frontend_data_2 ?? ''); ?></textarea>
                </div>
            </div>


            <!--button_1_text-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.button_1_text'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="frontend_data_3" name="frontend_data_3"
                        value="<?php echo e($section->frontend_data_3 ?? ''); ?>">
                </div>
            </div>


            <!--button_1_link-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.button_1_link'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="frontend_data_4" name="frontend_data_4"
                        value="<?php echo e($section->frontend_data_4 ?? ''); ?>">
                </div>
            </div>


            <!--button_2_text-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.button_2_text'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="frontend_data_5" name="frontend_data_5"
                        value="<?php echo e($section->frontend_data_5 ?? ''); ?>">
                </div>
            </div>


            <!--button_2_link-->
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.button_2_link'); ?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control form-control-sm" id="frontend_data_6" name="frontend_data_6"
                        value="<?php echo e($section->frontend_data_6 ?? ''); ?>">
                </div>
            </div>

            <!--submit-->
            <div class="text-right">
                <button type="submit" id="commonModalSubmitButton"
                    class="btn btn-rounded-x btn-danger btn-sm waves-effect text-left ajax-request"
                    data-url="<?php echo e(url('/app-admin/frontend/footercta')); ?>"
                    data-form-id="landlord-settings-form" data-loading-target="" data-ajax-type="post" data-type="form"
                    data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.frontend.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/footercta/page.blade.php ENDPATH**/ ?>