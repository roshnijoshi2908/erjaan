<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-6 align-self-center text-right parent-page-actions p-b-9"
    id="list-page-actions-container-proposals">
    <div id="list-page-actions">


        <!--reminder-->
        <?php if(config('visibility.modules.reminders')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.reminder'))); ?>"
            id="reminders-panel-toggle-button"
            class="reminder-toggle-panel-button list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-reminder-panel ajax-request <?php echo e($document->reminder_status); ?>"
            data-url="<?php echo e(url('reminders/start?resource_type='.$document->doc_type.'&resource_id='.$document->doc_id)); ?>"
            data-loading-target="reminders-side-panel-body" data-progress-bar='hidden'
            data-target="reminders-side-panel" data-title="<?php echo app('translator')->get('lang.my_reminder'); ?>">
            <i class="ti-alarm-clock"></i>
        </button>
        <?php endif; ?>

        <?php if(config('visibility.document_options_buttons')): ?>
        <!--publish-->
        <?php if($document->doc_status == 'draft'): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.publish_document'); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="<?php echo app('translator')->get('lang.publish_document'); ?>"
            data-confirm-text="<?php echo app('translator')->get('lang.documeny_publish_confirm'); ?>"
            data-url="<?php echo e(urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/publish')); ?>"
            id="document-action-publish"><i class="sl-icon-share-alt"></i></button>
        <?php endif; ?>
        <!--email invoice-->
        <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.send_email'); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="<?php echo app('translator')->get('lang.send_email'); ?>"
            data-confirm-text="<?php echo app('translator')->get('lang.confirm'); ?>"
            data-url="<?php echo e(urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/resend')); ?>"
            id="document-action-email"><i class="ti-email"></i></button>

        <?php if(config('visibility.document_edit_button')): ?>
        <!--edit button-->
        <a data-toggle="tooltip" title="<?php echo app('translator')->get('lang.edit'); ?>"
            href="<?php echo e(urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/edit')); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-note"></i>
        </a>

        <!--settings-->
        <span class="dropdown">
            <button type="button" data-toggle="dropdown" title="<?php echo e(cleanLang(__('lang.edit'))); ?>" aria-haspopup="true"
                aria-expanded="false"
                class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark">
                <i class="sl-icon-wrench"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <a class="dropdown-item" href="<?php echo e(url('/proposals/view/'.$document->doc_unique_id.'?action=preview')); ?>"
                    target="_blank"><i class="ti-new-window display-inline-block p-r-5"></i>
                    <?php echo app('translator')->get('lang.proposal_url'); ?></a>

                <!--Mark As Accepted-->
                <a class="dropdown-item confirm-action-info <?php echo e(runtimeVisibility('document-status', 'accepted', $document->doc_status)); ?>"
                    href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.mark_as_accepted'))); ?>"
                    id="bill-actions-dettach-project" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-url="<?php echo e(url('/proposals/'.$document->doc_id.'/change-status?status=accepted')); ?>">
                    <i class="sl-icon-check display-inline-block p-r-5"></i> <?php echo app('translator')->get('lang.mark_as_accepted'); ?></a>

                <!--Mark As Declined-->
                <a class="dropdown-item confirm-action-danger <?php echo e(runtimeVisibility('document-status', 'declined', $document->doc_status)); ?>"
                    href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.mark_as_accepted'))); ?>"
                    id="bill-actions-dettach-project" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-url="<?php echo e(url('/proposals/'.$document->doc_id.'/change-status?status=declined')); ?>">
                    <i class="sl-icon-close display-inline-block p-r-5"></i> <?php echo app('translator')->get('lang.mark_as_declined'); ?></a>

                <!--Mark As Revised-->
                <a class="dropdown-item confirm-action-danger <?php echo e(runtimeVisibility('document-status', 'revised', $document->doc_status)); ?>"
                    href="javascript:void(0)" data-confirm-title="<?php echo e(cleanLang(__('lang.mark_as_revised'))); ?>"
                    id="bill-actions-dettach-project" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-url="<?php echo e(url('/proposals/'.$document->doc_id.'/change-status?status=revised')); ?>">
                    <i class="sl-icon-close display-inline-block p-r-5"></i> <?php echo app('translator')->get('lang.mark_as_revised'); ?></a>

            </div>
        </span>
        <?php endif; ?>

        <!--print-->
        <a data-toggle="tooltip" title="<?php echo app('translator')->get('lang.print'); ?>"
            href="<?php echo e(url('proposals/'.$document->doc_id.'?render=print')); ?>" target="_blank"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-printer"></i>
        </a>

        <!--edit cost estimate-->
        <?php if(config('visibility.document_edit_estimate_button')): ?>
        <button type="button"
            class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            id="js-document-billing"
            data-url="<?php echo e(url('estimates/'.$estimate->bill_estimateid.'/edit-estimate?estimate_mode=document')); ?>"
            data-progress-bar="hidden" data-loading-target="documents-side-panel-billing-content"
            data-target="documents-side-panel-billing">
            <?php echo app('translator')->get('lang.edit_billing'); ?>
        </button>
        <?php endif; ?>

        <!--show variables-->
        <?php if(config('visibility.document_edit_variables_button')): ?>
        <button type="button"
            class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="documents-side-panel-variables">
            <?php echo app('translator')->get('lang.variables'); ?>
        </button>
        <?php endif; ?>

        <!--exit buton-->
        <?php if(config('visibility.document_edit_variables_button')): ?>
        <a data-toggle="tooltip" title="<?php echo app('translator')->get('lang.exit_editing_mode'); ?>"
            href="<?php echo e(url('proposals/'.$document->doc_id)); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-logout"></i>
        </a>
        <?php endif; ?>
        <?php endif; ?>


        <!--delete proposal-->
        <?php if(config('visibility.delete_document_button')): ?>
        <!--delete-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.delete_proposal'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-danger"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_proposal'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
            data-url="<?php echo e(url('/proposals/'.$document->doc_id.'?source=page')); ?>"><i
                class="sl-icon-trash"></i></button>
        <?php endif; ?>
    </div>
</div>
<!-- action buttons --><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/documents/components/proposal/actions-team.blade.php ENDPATH**/ ?>