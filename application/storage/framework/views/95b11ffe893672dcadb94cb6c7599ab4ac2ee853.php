<div class="row">
    <div class="col-lg-12">
        <!--title-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.form_name'); ?>*</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="webform_title" name="webform_title" value="<?php echo e($webform->webform_title ?? ''); ?>">
            </div>
        </div>
    </div>
</div>
<!--section js resource--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/settings/sections/webforms/modals/add-edit-inc.blade.php ENDPATH**/ ?>