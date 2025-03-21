<!--checkbox actions-->
<!--include('pages.purchase.gm.components.actions.checkbox-actions')-->

<!--main table view-->
<?php echo $__env->make('pages.purchase.gm.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<!--if(auth()->user()->is_team)-->
<!--include('pages.purchase.gm.components.misc.filter-purchase')-->
<!--endif-->
<!--filter--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/gm/components/table/wrapper.blade.php ENDPATH**/ ?>