<!--checkbox actions-->
<?php echo $__env->make('pages.purchase.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.purchase.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<!--if(auth()->user()->is_team)-->
<?php echo $__env->make('pages.purchase.components.misc.filter-purchase', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('pages.export.purchase.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--endif-->
<!--filter--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/table/wrapper.blade.php ENDPATH**/ ?>