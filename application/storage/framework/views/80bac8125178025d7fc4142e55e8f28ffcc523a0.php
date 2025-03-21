<?php if(config('visibility.page_rendering') =='view'): ?>
<div class="col-12">
    <div class="docs-heading-wrapper">

        <div class="row">
            <div class="col-4">
                <div class="logo">
                    <img src="<?php echo e(runtimeLogoLarge()); ?>" alt="homepage" />
                </div>
            </div>
            <div class="col-8">
                <div class="actions">
                    <!--print-->
                    <a class="btn btn-secondary btn-outline btn-sm"
                        href="<?php echo e(url('proposals/view/'.$document->doc_unique_id.'?render=print')); ?>" target="_blank">
                        <span><i class="sl-icon-printer"></i> <?php echo app('translator')->get('lang.print_proposal'); ?></span> </a>

                    <?php if(config('visibility.proposal_accept_decline_buttons')): ?>
                    <!--decline-->
                    <button class="buttons-accept-decline btn btn-danger confirm-action-danger btn-sm"
                        data-confirm-title="<?php echo app('translator')->get('lang.decline_proposal'); ?>"
                        data-confirm-text="<?php echo app('translator')->get('lang.confirm_decline_proposal'); ?>" data-ajax-type="GET"
                        data-url="<?php echo e(url('proposals/'.$document->doc_unique_id.'/decline')); ?>">
                        <?php echo app('translator')->get('lang.decline_proposal'); ?> </button>

                    <!--accept-->
                    <button type="button"
                        class="buttons-accept-decline btn btn-success btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" 
                        data-target="#commonModal" 
                        data-progress-bar="hidden"
                        data-url="<?php echo e(url('proposals/'.$document->doc_unique_id.'/sign')); ?>"
                        data-loading-target="commonModalBody" 
                        data-modal-title="<?php echo app('translator')->get('lang.accept_proposal'); ?>"
                        data-action-form-id=""
                        data-modal-size="modal-lg"
                        data-action-url="<?php echo e(url('proposals/'.$document->doc_unique_id.'/accept')); ?>"
                        data-action-method="POST" 
                        data-action-ajax-class="js-ajax-ux-request">
                        <?php echo app('translator')->get('lang.accept_proposal'); ?>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>
</div>
<?php endif; ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/documents/components/proposal/actions-public.blade.php ENDPATH**/ ?>