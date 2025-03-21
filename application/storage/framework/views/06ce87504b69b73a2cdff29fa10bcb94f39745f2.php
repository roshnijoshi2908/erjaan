 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- bread crumbs -->
        <?php echo $__env->make('landlord.misc.crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- bread crumbs -->

    </div>
    <!--page heading-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--clients table-->
            <?php echo $__env->make('landlord.offlinepayments.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--clients table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/offlinepayments/wrapper.blade.php ENDPATH**/ ?>