<div class="row" id="js-trigger-general_expenses" data-section="<?php echo e($page['section']); ?>">
    <div class="col-lg-12">
        <style>
            .loading:after{
                display:none;
            }
        </style>
        <!--TITLE-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.purpose'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="purpose" name="purpose"
                    placeholder="">
            </div>
        </div>
        <!--/#TITLE-->

        <!--Comments-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.comments'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="comments" name="comments"
                    placeholder="">
            </div>
        </div>
        <!--/#Comments-->


        <!--AMOUNT-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.amount'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="amount" name="amount"
                    placeholder="">
            </div>
        </div>
        <!--AMOUNT-->
        
        <!--CATEGORY-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.category_name'); ?></label>
            <div class="col-sm-12">
                <select class="form-control form-control-sm" data-allow-clear="false"
                    id="expence_categoryid" name="expence_categoryid">
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $generalExpenceCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->expense_category_id); ?>" 
                            <?php echo e(isset($generalexpencesubcat) && $generalexpencesubcat->expense_category_id == $category->expense_category_id ? 'selected' : ''); ?>>
                            <?php echo e($category->category_name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <!--CATEGORY-->
        
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.subcategory_name'); ?></label>
            <div class="col-sm-12">
                <select class="form-control form-control-sm" id="expence_subcategoryid" name="expence_subcategoryid">
                    <option value="">Select Subcategory</option>
                </select>
            </div>
        </div>

            
        <!--PAid-->
        <!--<div class="form-group row">-->
        <!--    <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.paid'))); ?></label>-->
        <!--    <div class="col-12">-->
        <!--        <select class="select2 form-control form-control-sm" data-allow-clear="false" id="paid" name="paid">-->
        <!--            <option value="1">Yes</option>-->
        <!--            <option value="0">No</option>-->
        <!--        </select>-->
        <!--    </div>-->
        <!--</div>-->
        <!--PAid-->
        
        <!--Select bank-->
    
        <!--<div class="form-group row">-->
        <!--    <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.selected_the_bank'))); ?></label>-->
        <!--    <div class="col-12">-->
        <!--        <select id="selected_the_bank" name="selected_the_bank" class="select2-basic form-control form-control-sm">-->
        <!--            <?php $__currentLoopData = config('system.gateways'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
        <!--                <option value="<?php echo e($gateway); ?>"><?php echo e($gateway); ?></option>-->
        <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
        <!--        </select>-->
        <!--    </div>-->
        <!--</div>-->
        <!--Select bank-->
        
        <!--attach recipt-->
        <div id="add_expense_attach_receipt">
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_expense_receipt">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            <!--<?php if(isset($page['section']) && $page['section'] == 'edit'): ?>-->
            <!--<table class="table table-bordered">-->
            <!--    <tbody>-->
            <!--        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
            <!--        <tr id="expense_attachment_<?php echo e($attachment->attachment_id); ?>">-->
            <!--            <td><?php echo e($attachment->attachment_filename); ?> </td>-->
            <!--            <td class="w-px-40"> <button type="button"-->
            <!--                    class="btn btn-danger btn-circle btn-sm confirm-action-danger"-->
            <!--                    data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"-->
            <!--                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" active"-->
            <!--                    data-ajax-type="DELETE"-->
            <!--                    data-url="<?php echo e(url('/expenses/attachments/'.$attachment->attachment_uniqiueid)); ?>">-->
            <!--                    <i class="sl-icon-trash"></i>-->
            <!--                </button></td>-->
            <!--        </tr>-->
            <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
            <!--    </tbody>-->
            <!--</table>-->
            <!--<?php endif; ?>-->
        </div>
        
    </div>        
</div>

<script>
   function fetchSubcategories(categoryId) {
        $.ajax({
            url: '/get-subcategories/' + categoryId, // Route to fetch subcategories
            type: 'GET',
            success: function(data) {
                let subcategorySelect = $('#expence_subcategoryid'); // Using jQuery to select the element
                subcategorySelect.empty(); // Reset subcategories
                subcategorySelect.append('<option value="">Select Subcategory</option>'); // Add default option
                // Loop through the returned subcategories and add them to the dropdown
                $.each(data, function(index, subcategory) {
                   
                    subcategorySelect.append('<option value="' + subcategory.expense_subcategory_id + '">' + subcategory.expense_subcategory_name + '</option>');
                });
            },
            error: function(error) {
                console.error("There was an error fetching subcategories:", error);
            }
        });
    }

    // Trigger when category is changed
    $('#expence_categoryid').on('change', function() {

        let selectedCategoryId = $(this).val(); // Using jQuery to get the value
        if (selectedCategoryId) {
            fetchSubcategories(selectedCategoryId);
        } else {
            $('#expence_subcategoryid').empty().append('<option value="">Select Subcategory</option>');
        }
    });
</script><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>