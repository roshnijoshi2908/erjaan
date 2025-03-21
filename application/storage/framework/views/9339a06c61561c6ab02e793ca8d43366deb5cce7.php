<!--faq_title-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.title'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="faq_title" name="faq_title"
            value="<?php echo e($faq->faq_title ?? ''); ?>">
    </div>
</div>


<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.content'); ?></label>
    <div class="col-sm-12">
        <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="faq_content"
            id="faq_content"><?php echo e($faq->faq_content ?? ''); ?></textarea>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/faq/modals/add-edit.blade.php ENDPATH**/ ?>