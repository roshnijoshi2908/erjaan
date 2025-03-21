
<?php
    $contact_lead = null;
    if (request()->has('kanban_lead_id') && request('kanban_lead_id') !== null) {
        $contact_lead = \App\Models\Lead::where('lead_id', (int) request('kanban_lead_id'))->first();
    }
?>
<div class="boards count-<?php echo e(@count($leads ?? [])); ?> js-trigger-leads-kanban-board" id="leads-view-wrapper" data-position="<?php echo e(url('leads/update-position')); ?>">
    <center>
        <h2 style="font-size:33px">
            <?php echo e(ucfirst($contact_lead->lead_firstname ?? '')); ?> <?php echo e(ucfirst($contact_lead->lead_lastname ?? '')); ?>

        </h2>
    </center>

    <!--each board-->
    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--board-->
    <?php echo $__env->make('pages.leads.components.kanban.board', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/leads/components/kanban/kanban.blade.php ENDPATH**/ ?>