<!-- action buttons -->
<?php echo $__env->make('pages.timesheets.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="timesheets-stats-wrapper" class="stats-wrapper card-embed-fix">
<?php if(@count($timesheets ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
</div>
<?php endif; ?>
<!--stats panel-->

<!--timesheets table-->
<div class="card-embed-fix">
<?php echo $__env->make('pages.timesheets.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!--timesheets table--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/timesheets/tabswrapper.blade.php ENDPATH**/ ?>