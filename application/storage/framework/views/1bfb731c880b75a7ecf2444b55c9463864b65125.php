 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--settings content-->
    <?php echo $__env->yieldContent('settings_content'); ?>

</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/wrapper.blade.php ENDPATH**/ ?>