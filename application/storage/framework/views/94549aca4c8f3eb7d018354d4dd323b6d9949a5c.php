<!--GENERAL FEED-->
<?php if(in_array(request('ref-source'), ['home','events']) || !request()->filled('ref-source')): ?>
<!--title-->
<div class="m-t-7">
    <?php echo app('translator')->get('lang.event_created_account'); ?>
</div>
<!--plan-->
<div class="m-t-3">
    <?php echo e($event->event_payload_2); ?>

</div>
<!--link to customer-->
<div class="m-t-3">
    <a href="<?php echo e(url('app-admin/customer').$event->event_customer_id); ?>" target="_blank"><?php echo e($event->event_payload_1); ?></a>
</div>
<?php endif; ?>

<!--CUSTOMER PAGE-->
<?php if(in_array(request('ref-source'), ['customer'])): ?>
<!--title-->
<div class="m-t-7">
    <?php echo app('translator')->get('lang.event_created_account'); ?>
</div>
<!--plan-->
<div class="m-t-3">
    <?php echo e($event->event_payload_2); ?>

</div>
<?php endif; ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/events/components/account_created.blade.php ENDPATH**/ ?>