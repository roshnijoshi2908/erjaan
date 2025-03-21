
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.category_name'); ?></label>
        <div class="col-sm-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="expence_categoryid" name="expence_categoryid">
                
                <?php $__currentLoopData = $generalExpenceCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->expense_category_id); ?>" 
                        <?php echo e(isset($generalexpencesubcat) && $generalexpencesubcat->expense_category_id == $category->expense_category_id ? 'selected' : ''); ?>>
                        <?php echo e($category->category_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.subcategory_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="expense_subcategory_name" name="expense_subcategory_name"
            value="<?php echo e($generalexpencesubcat->expense_subcategory_name ?? ''); ?>">
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/generalexpencesubcategory/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>