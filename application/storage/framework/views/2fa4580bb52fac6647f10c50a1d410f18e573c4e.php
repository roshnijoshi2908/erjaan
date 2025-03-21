<!--checkbox actions-->
<?php echo $__env->make('pages.generalexpence.generalexpencesubcategory.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->

<?php echo $__env->make('pages.generalexpence.generalexpencesubcategory.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<!--if(auth()->user()->is_team)-->
<?php echo $__env->make('pages.generalexpence.generalexpencesubcategory.components.misc.filter-generalexpence', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--endif-->
<!--filter--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/generalexpencesubcategory/components/table/wrapper.blade.php ENDPATH**/ ?>