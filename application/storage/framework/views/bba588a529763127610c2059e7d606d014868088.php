<!--use when customer replies-->
<div class="form-group form-group-checkbox row">
    <label class="col-12 col-form-label text-left"><?php echo app('translator')->get('lang.tickets_apply_when_customer_replied'); ?></label>
    <div class="col-12 text-left p-t-5">
        <input type="checkbox" id="ticketstatus_use_for_client_replied" name="ticketstatus_use_for_client_replied" class="filled-in chk-col-light-blue"
        <?php echo e(runtimePrechecked($status->ticketstatus_use_for_client_replied ?? '')); ?>>
        <label class="p-l-30" for="ticketstatus_use_for_client_replied"></label>
    </div>
</div>

<div class="line"></div>

<!--use when team replies-->
<div class="form-group form-group-checkbox row">
    <label class="col-12 col-form-label text-left"><?php echo app('translator')->get('lang.tickets_apply_when_staff_replied'); ?></label>
    <div class="col-12 text-left p-t-5">
        <input type="checkbox" id="ticketstatus_use_for_team_replied" name="ticketstatus_use_for_team_replied" class="filled-in chk-col-light-blue"
        <?php echo e(runtimePrechecked($status->ticketstatus_use_for_team_replied ?? '')); ?>>
        <label class="p-l-30" for="ticketstatus_use_for_team_replied"></label>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/settings/sections/tickets/modals/settings.blade.php ENDPATH**/ ?>