<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name"
            value="<?php echo e(isset($supplier) ? $supplier->supplier_name ?? '' : ''); ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_address'); ?></label>
    <div class="col-sm-12">
        <textarea class="form-control form-control-sm" rows="10" name="supplier_address"
                id="supplier_address"><?php echo e(isset($supplier) ? $supplier->supplier_address ?? '' : ''); ?>

</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_telephone'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_telephone" name="supplier_telephone"
            value="<?php echo e(isset($supplier) ? $supplier->supplier_telephone ?? '' : ''); ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_category'); ?></label>
        <div class="col-sm-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="supplier_categoryid" name="supplier_categoryid">
                
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->supplier_category_id); ?>" <?php echo e(isset($supplier) && $supplier->supplier_category_id == $category->supplier_category_id ? 'selected' : ''); ?>

>
                    <?php echo e($category->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_contact_person_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_contact_person_name" name="supplier_contact_person_name"
            value="<?php echo e(isset($supplier) ? $supplier->supplier_contact_person_name ?? '' : ''); ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_contact_person_mobile'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_contact_person_mobile" name="supplier_contact_person_mobile"
            value="<?php echo e(isset($supplier) ? $supplier->supplier_contact_person_mobile ?? '' : ''); ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.supplier_created_date'); ?></label>
    <!--<div class="col-sm-12">-->
    <!--    <input type="date" class="form-control form-control-sm" id="supplier_created_date" name="supplier_created_date"-->
    <!--        value="<?php echo e(isset($supplier) ? $supplier->supplier_created_date ?? '' : ''); ?>">-->
    <!--</div>-->
    
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="supplier_created_date"
            value="<?php echo e(runtimeDatepickerDate($supplier->supplier_created_date ?? '')); ?>">
        <input class="mysql-date" type="hidden" name="supplier_created_date" id="supplier_created_date"
            value="<?php echo e(runtimeDatepickerDate($supplier->supplier_created_date ?? '')); ?>">
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/supplier/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>