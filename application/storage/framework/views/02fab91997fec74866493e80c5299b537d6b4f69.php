<!--checkbox actions-->
<?php echo $__env->make('pages.bank.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.bank.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<!--if(auth()->user()->is_team)-->
<?php echo $__env->make('pages.bank.components.misc.filter-bank', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--endif-->
<!--filter--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bank/components/table/wrapper.blade.php ENDPATH**/ ?>