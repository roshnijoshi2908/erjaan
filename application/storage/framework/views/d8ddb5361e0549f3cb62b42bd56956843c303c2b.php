<!--main table view-->
<?php echo $__env->make('pages.subscriptions.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.subscriptions.components.misc.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/subscriptions/components/table/wrapper.blade.php ENDPATH**/ ?>