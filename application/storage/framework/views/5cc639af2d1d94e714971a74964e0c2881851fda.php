<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Paid</label>
    <div class="col-sm-12">
        <select id="paid" name="paid" class="form-control form-control-sm" >
            <option value="">-- Select Paid Status --</option>
            <option value="1" <?php echo e($purchase->paid == '1' ? 'selected' : ''); ?>>Yes</option>
            <option value="0" <?php echo e($purchase->paid == '0' ? 'selected' : ''); ?>>No</option>

        </select>
        <!--<input type="text" class="form-control form-control-sm" id="paid" name="paid"-->
        <!--    value="<?php echo e($purchase->paid ?? ''); ?>">-->
    </div>
</div>

<!--proposal_template_body-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Select Bank</label>
    <div class="col-sm-12">
        <select  name="selected_the_bank" id="selected_the_bank" class="form-control form-control-sm">
            <option value="">-- Select Bank --</option>
           
                <!-- <?php $__currentLoopData = config('system.gateways'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                <!--    <option value="<?php echo e($gateway); ?>" <?php echo e($purchase->selected_the_bank == $gateway ? 'selected' : ''); ?>><?php echo e($gateway); ?></option>-->
                <!--<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                
                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($bank->id); ?>" <?php echo e($purchase->selected_the_bank == $bank->id ? 'selected' : ''); ?>><?php echo e($bank->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/accountant/proposals/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>