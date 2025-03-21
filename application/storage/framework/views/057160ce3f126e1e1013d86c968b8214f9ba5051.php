<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-5 align-self-center text-right p-b-9  <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <?php if(auth()->check() && (auth()->user()->is_team && auth()->user()->role->role_estimates >= 2)): ?>
        <!--reminder-->
        <?php if(config('visibility.modules.reminders')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.reminder'))); ?>"
            id="reminders-panel-toggle-button"
            class="reminder-toggle-panel-button list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-reminder-panel ajax-request <?php echo e($bill->reminder_status); ?>"
            data-url="<?php echo e(url('reminders/start?resource_type=estimate&resource_id='.$bill->bill_estimateid)); ?>"
            data-loading-target="reminders-side-panel-body" data-progress-bar='hidden'
            data-target="reminders-side-panel" data-title="<?php echo app('translator')->get('lang.my_reminder'); ?>">
            <i class="ti-alarm-clock"></i>
        </button>
        <?php endif; ?>
        <!--publish-->
        <?php if($bill->bill_status == 'draft'): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.publish_estimate'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.publish_estimate'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.the_estimate_will_be_sent_to_customer'))); ?>"
            data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/publish')); ?>"
            id="estimate-action-publish-estimate"><i class="sl-icon-share-alt"></i></button>
        <?php endif; ?>
        <!--mark as revised-->
        <?php if($bill->bill_status == 'declined'): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.publish_revised_estimate'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.publish_revised_estimate'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.the_estimate_will_be_marked_as_revised'))); ?>"
            data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/publish-revised')); ?>"
            id="estimate-action-publish-revised-estimate"><i class="sl-icon-share-alt"></i></button>
        <?php endif; ?>
        <!--convert to invoice-->
        <button type="button" title="<?php echo e(cleanLang(__('lang.convert_to_invoice'))); ?>"
            class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
            data-modal-title="<?php echo e(cleanLang(__('lang.convert_to_invoice'))); ?>"
            data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/convert-to-invoice')); ?>"
            data-action-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/convert-to-invoice')); ?>"
            data-loading-target="commonModalBody" data-action-method="POST"><i class="sl-icon-shuffle"></i></button>

        <!--clone-->
        <span class="dropdown">
            <button type="button" class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark 
                        actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                title="<?php echo e(cleanLang(__('lang.clone_estimate'))); ?>" data-toggle="modal" data-target="#commonModal"
                data-modal-title="<?php echo e(cleanLang(__('lang.clone_estimate'))); ?>"
                data-url="<?php echo e(url('/estimates/'.$bill->bill_estimateid.'/clone')); ?>"
                data-action-url="<?php echo e(url('/estimates/'.$bill->bill_estimateid.'/clone')); ?>"
                data-loading-target="actionsModalBody" data-action-method="POST">
                <i class=" mdi mdi-content-copy"></i>
            </button>
        </span>

        <!--email estimate-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.send_email'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.send_email'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.confirm'))); ?>"
            data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/resend')); ?>"
            id="estimate-action-email-estimate"><i class="ti-email"></i></button>
        <!--edit-->
        <span class="dropdown">
            <button type="button" data-toggle="dropdown" title="<?php echo e(cleanLang(__('lang.edit'))); ?>" aria-haspopup="true"
                aria-expanded="false"
                class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark">
                <i class="sl-icon-note"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <!--edit estimate-->
                <a class="dropdown-item"
                    href="<?php echo e(url('/estimates/'.$bill->bill_estimateid.'/edit-estimate')); ?>">
                    <i class="sl-icon-note display-inline-block p-r-5"></i><?php echo e(cleanLang(__('lang.edit_estimate'))); ?></a>

                <!--estimate url-->
                <a class="dropdown-item" href="<?php echo e(url('/estimates/view/'.$bill->bill_uniqueid.'?action=preview')); ?>"
                    target="_blank"><i class="sl-icon-cursor display-inline-block p-r-5"></i><?php echo e(cleanLang(__('lang.estimate_url'))); ?></a>

                <!--change status-->
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    data-modal-title="<?php echo e(cleanLang(__('lang.change_status'))); ?>"
                    data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/change-status')); ?>"
                    data-action-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/change-status')); ?>"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    <i class="sl-icon-flag display-inline-block p-r-5"></i><?php echo e(cleanLang(__('lang.change_status'))); ?></a>

                <!--attach project-->
                <a class="dropdown-item confirm-action-danger <?php echo e(runtimeVisibility('dettach-estimate', $bill->bill_projectid)); ?>"
                    href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.detach_from_project'))); ?>"
                    id="bill-actions-dettach-project" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/detach-project')); ?>">
                    <i class="sl-icon-docs display-inline-block p-r-5"></i><?php echo e(cleanLang(__('lang.detach_from_project'))); ?></a>

                <!--deattach project-->
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form <?php echo e(runtimeVisibility('attach-estimate', $bill->bill_projectid)); ?>"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    id="bill-actions-attach-project" data-modal-title="<?php echo e(cleanLang(__('lang.attach_to_project'))); ?>"
                    data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/attach-project?client_id='.$bill->bill_clientid)); ?>"
                    data-action-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/attach-project')); ?>"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    <i class="sl-icon-doc display-inline-block p-r-5"></i><?php echo e(cleanLang(__('lang.attach_to_project'))); ?></a>

                <!--automation-->
                <a href="javascript:void(0)"
                    class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/edit-automation')); ?>"
                    data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.estimate_automation'); ?>"
                    data-action-url="<?php echo e(urlResource('/estimates/'.$bill->bill_estimateid.'/edit-automation')); ?>"
                    data-action-method="POST" data-action-ajax-loading-target="commonModalBody"><i class="sl-icon-energy display-inline-block p-r-5"></i><?php echo app('translator')->get('lang.automation'); ?>
                </a>
            </div>
        </span>

        <!--delete-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.delete_estimate'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-danger"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_estimate'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
            data-url="<?php echo e(url('/')); ?>/estimates/<?php echo e($bill->bill_estimateid); ?>?source=page"><i
                class="sl-icon-trash"></i></button>
        <?php endif; ?>

        <!--reminder-->
        <?php if(auth()->check() && auth()->user()->is_client): ?>
        <?php if(config('visibility.modules.reminders')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.reminder'))); ?>"
            id="reminders-panel-toggle-button"
            class="reminder-toggle-panel-button list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-reminder-panel ajax-request <?php echo e($bill->reminder_status); ?>"
            data-url="<?php echo e(url('reminders/start?resource_type=estimate&resource_id='.$bill->bill_estimateid)); ?>"
            data-loading-target="reminders-side-panel-body" data-progress-bar='hidden'
            data-target="reminders-side-panel" data-title="<?php echo app('translator')->get('lang.my_reminder'); ?>">
            <i class="ti-alarm-clock"></i>
        </button>
        <?php endif; ?>
        <?php endif; ?>


        <!--Download PDF-->
        <a data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.download'))); ?>" id="estimateDownloadButton"
            href="<?php echo e(url('/estimates/view/'.$bill->bill_uniqueid.'/pdf')); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark" download>
            <i class="mdi mdi-download"></i>
        </a>

    </div>
</div>

<script>
    $("#estimateDownloadButton").on('click', function(e) {
    e.preventDefault(); 

    var bodyClass = document.body.className;
    var name = bodyClass.includes('rtl') ? 'rtl' : 'ltr';

    var url = $(this).attr('href') + '?bodyClass=' + name;

    window.location.href = url;
});
</script><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bill/components/misc/estimate/actions.blade.php ENDPATH**/ ?>