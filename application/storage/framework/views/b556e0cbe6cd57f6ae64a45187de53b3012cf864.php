
<?php $__env->startSection('account-page'); ?>
<div class="account-wrapper">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="page-notification">
                        <img class="m-b-30" src="<?php echo e(url('/')); ?>/public/images/relax.png"
                            alt="<?php echo app('translator')->get('lang.no_notices_for_account'); ?>" />
                        <h2 class="m-b-30 font-weight-200"> <?php echo app('translator')->get('lang.no_notices_for_account'); ?> </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('account.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/account/notices/none.blade.php ENDPATH**/ ?>