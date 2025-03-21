<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.category_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="category_name" name="category_name"
            value="<?php echo e($supplierCategory->category_name ?? ''); ?>">
    </div>
</div>

<!--proposal_template_body-->
<!--<div class="form-group row">-->
<!--    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.content'); ?></label>-->
<!--    <div class="col-sm-12">-->
<!--        <textarea class="form-control form-control-sm tinymce-textarea-extended" rows="5" name="proposal_template_body"-->
<!--            id="proposal_template_body">$template->proposal_template_body</textarea>-->
<!--    </div>-->
<!--</div>-->

<?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/category/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>