<div class="w-100 text-center" id="change-subscription-plan-form">


    <img class="m-t-30 w-px-300" src="<?php echo e(url('public/images/saas/change-plans.png')); ?>"
        alt="<?php echo app('translator')->get('lang.change_plan'); ?>" />

    <div class="m-l-30 m-r-30 m-t-20 m-b-40">
        <h6 class="text-uc font-weight-600 m-b-15"><?php echo app('translator')->get('lang.change_plan'); ?></h6>
        <h4><?php echo e($package->package_name); ?></h4>
        <?php if($package->package_subscription_options == 'paid'): ?>
        <!--item-->
        <div class="form-group row w-px-300 m-l-auto m-r-auto m-b-o m-t-20">
            <div class="col-sm-12">
                <select class="select2-basic form-control form-control-sm" id="billing_cycle"
                    name="billing_cycle">
                    <?php if($package->package_amount_monthly != ''): ?>
                    <option value="monthly"><?php echo e(runtimeMoneyFormat($package->package_amount_monthly)); ?> / <?php echo app('translator')->get('lang.month'); ?></option>
                    <?php endif; ?>
                    <?php if($package->package_amount_yearly != ''): ?>
                    <option value="yearly"><?php echo e(runtimeMoneyFormat($package->package_amount_yearly)); ?> / <?php echo app('translator')->get('lang.year'); ?></option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <?php else: ?>
        <div class="form-group row w-px-300 m-l-auto m-r-auto m-b-o m-t-20">
            <div class="col-sm-12">
                <select class="select2-basic form-control form-control-sm" id="project_category"
                    name="project_category">
                    <option value="free"><?php echo e(runtimeMoneyFormat(0)); ?> - <?php echo app('translator')->get('lang.free'); ?></option>
                </select>
            </div>
        </div>
        <?php endif; ?>      

        <!--form buttons-->
        <div class="p-t-0">
            <button type="button" class="btn btn-info confirm-action-info"
                title="<?php echo e(cleanLang(__('lang.edit'))); ?>" data-confirm-title="<?php echo app('translator')->get('lang.change_plan'); ?>"
                data-type="form"
                data-form-id="change-subscription-plan-form"
                data-ajax-type="POST" 
                data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>" data-url="<?php echo e(url('settings/account/'.$package->package_id.'/change-plan')); ?>">
                <?php echo app('translator')->get('lang.select_plan'); ?>
            </button>

        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/account/changeplan/start.blade.php ENDPATH**/ ?>