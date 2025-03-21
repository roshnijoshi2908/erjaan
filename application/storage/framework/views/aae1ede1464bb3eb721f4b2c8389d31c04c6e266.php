<div class="row">
    <div class="col-lg-12">
        <!--name-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.name'))); ?>*</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="taxrate_name" name="taxrate_name"
                    value="<?php echo e($taxrate->taxrate_name ?? ''); ?>">
            </div>
        </div>
        <!--rate-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.rate'))); ?>

                (%)</label>
            <div class="col-12">
                <input type="number" class="form-control form-control-sm" id="taxrate_value" name="taxrate_value"
                    <?php echo e(runtimeSystemTaxRate($taxrate->taxrate_type ?? '')); ?>

                    value="<?php echo e($taxrate->taxrate_value ?? ''); ?>">
            </div>
        </div>

        <!--taxrate_status-->
        <div class="form-group row">
            <label
                class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.status'); ?></label>
            <div class="col-sm-12">
                <select class="select2-basic form-control form-control-sm select2-preselected" id="taxrate_status" <?php echo e(runtimeSystemTaxRate($taxrate->taxrate_type ?? '')); ?>

                    name="taxrate_status" data-preselected="<?php echo e($taxrate->taxrate_status ?? 'enabled'); ?>">
                    <option></option>
                    <option value="enabled"><?php echo app('translator')->get('lang.enabled'); ?></option>
                    <option value="disabled"><?php echo app('translator')->get('lang.disabled'); ?></option>
                </select>
            </div>
        </div>

    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/settings/sections/taxrates/modals/add-edit-inc.blade.php ENDPATH**/ ?>