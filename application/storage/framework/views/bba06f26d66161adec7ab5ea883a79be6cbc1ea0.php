
<?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid <?php echo e($document->doc_type); ?>">

    <!--container-->
    <div class="row" id="embed-content-container">

        <!--HEADER & ACTIONS-->
        <?php if(config('visibility.proposal_accept_decline_button_header')): ?>
        <?php echo $__env->make('pages.documents.components.proposal.actions-public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!--DOCUMENT-->
        <?php echo $__env->yieldContent('document'); ?>

    </div>

</div>
<!--page content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapperplain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/documents/wrapper-public.blade.php ENDPATH**/ ?>