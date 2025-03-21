 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <!--include('pages.purchase.components.misc.list-page-actions')-->
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <!--if(auth()->user()->is_team)-->
    <div class="stats-wrapper" id="projects-stats-wrapper">
    <!--include('misc.list-pages-stats')-->
    </div>
    <!--endif-->
    <!--stats panel-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--projects table-->
            <?php echo $__env->make('pages.purchase.gm.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--projects table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/gm/wrapper.blade.php ENDPATH**/ ?>