<!-- action buttons -->
<?php echo $__env->make('pages.accountant.proposals.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="proposals-stats-wrapper" class="stats-wrapper card-embed-fix">
<?php if(@count($proposals ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
</div>
<?php endif; ?>
<!--stats panel-->

<!--proposals table-->
<div class="card-embed-fix">
<?php echo $__env->make('pages.accountant.proposals.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!--proposals table--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/accountant/proposals/tabswrapper.blade.php ENDPATH**/ ?>