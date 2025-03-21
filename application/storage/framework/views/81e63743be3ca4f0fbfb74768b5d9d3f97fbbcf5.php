<!--importing results-->
<div class="importing-step-3" id="importing-step-3">
    <div class="x-splash-image"><img src="<?php echo e(url('public/images/import-results-nothing.svg')); ?>"
            alt="importing completed" /></div>
    <div class="x-splash-text">
        <h3><?php echo app('translator')->get('lang.no_data_rows_were_found'); ?></h3>
    </div>
    <div class="x-splash-subtext p-b-15">
        <span class="label label-rounded label-warning p-r-16 p-l-16"><strong>0</strong>
            <?php echo app('translator')->get('lang.records_imported'); ?></span>
    </div>

    <!--samples-->
    <?php echo $__env->make('pages.import.common.samples', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/import/common/nothing.blade.php ENDPATH**/ ?>