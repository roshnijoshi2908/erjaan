<?php $__currentLoopData = $generalexpence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generalexp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--each row-->
    <tr id="generalexpence_<?php echo e($generalexp->generalexpence_id); ?>">
    <?php if(config('visibility.proposals_col_checkboxes')): ?>
    <td class="proposals_col_checkbox checkproposal p-l-0" id="proposals_col_checkbox_<?php echo e($generalexp->generalexpence_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-proposals-<?php echo e($generalexp->generalexpence_id); ?>"
                name="ids[<?php echo e($generalexp->generalexpence_id); ?>]"
                class="listcheckbox listcheckbox-proposals filled-in chk-col-light-blue proposals-checkbox"
                data-actions-container-class="proposals-checkbox-actions-container"
                data-proposal-id="<?php echo e($generalexp->generalexpence_id); ?>">
            <label for="listcheckbox-proposals-<?php echo e($generalexp->generalexpence_id); ?>"></label>
        </span>
    </td>
    <?php endif; ?>

    <!--doc_id-->
    <td class="col_doc_id">
        <a href="#"><?php echo e($generalexp->generalexpence_id); ?></a>
    </td>

    <!--client name-->
    <td class="col_client">
        <a href="#"
            title="<?php echo e($generalexp->purpose ?? '---'); ?>"><?php echo e(str_limit($generalexp->purpose ?? '---', 12)); ?></a>
    </td>

    <!--project-->
    <td class="col_client">
        <a href="#"
            title="<?php echo e($generalexp->comments ?? '---'); ?>"><?php echo e(str_limit($generalexp->comments ?? '---', 25)); ?></a>
    </td>
    
    <!--supplier-->
    <td class="col_client">
        <a href="#"
            title="<?php echo e($generalexp->approver_first_name ?? '---'); ?>"><?php echo e(str_limit($generalexp->approver_first_name ?? '---', 25)); ?></a>
    </td>
    <!--value-->
    <td class="col_value">
        <?php echo e(runtimeMoneyFormat($generalexp->amount)); ?>

    </td>
    
    <!--supplier-->
    <td class="col_client">
        <a href="#"
            title="<?php echo e($generalexp->category_name ?? '---'); ?>"><?php echo e(str_limit($generalexp->category_name ?? '---', 25)); ?></a>
    </td>
    
    <!--supplier-->
    <td class="col_client">
        <a href="#"
            title="<?php echo e($generalexp->expense_subcategory_name ?? '---'); ?>"><?php echo e(str_limit($generalexp->expense_subcategory_name ?? '---', 25)); ?></a>
    </td>
    
    <!--status-->
    <td class="col_foo">
        <span
            class="label <?php echo e(runtimePurchaseStatusColors($generalexp->status, 'label')); ?>"><?php echo e(runtimeLang($generalexp->status)); ?></span>
    </td>
    
    
    <!--doc_date_end-->
    <td class="col_doc_date_start">
       <?php echo e(($generalexp->paid == '') ? '---' : ($generalexp->paid == "1" ? 'Yes' : 'No')); ?>

    </td>

    <td class="col_doc_date_start">
        <?php echo e($generalexp->bank_name ?? '---'); ?>

    </td>
    
    <?php if($change_status): ?>
        <td class="col_generalexpence_category_actions actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                <!--chnage status-->
                <button type="button" title="<?php echo app('translator')->get('lang.change_status'); ?>"
                    class="edit-add-modal-button data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm  js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(urlResource('/general-expense/gm-approvals/'.$generalexp->generalexpence_id.'/change-status/')); ?>"
                    data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.change_status'))); ?>"
                    data-action-url="<?php echo e(urlResource('/general-expense/gm-approvals/'.$generalexp->generalexpence_id.'/change-status/')); ?>"
                    data-action-type="form"
                    data-action-method="POST" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                    data-action-ajax-loading-target="generalexpence-td-container">
                    <i class="sl-icon-note"></i>
                </button>
            </span>
            <!--action button-->
        </td>
    <?php endif; ?>
    
    <?php if($accountant): ?>
        <td class="col_generalexpence_category_actions actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                <!--edit-->
               <button type="button" title="<?php echo e(__('lang.edit')); ?>"
                class="edit-add-modal-button data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/general-expense/accountant/'.$generalexp->generalexpence_id.'/edit/')); ?>"
                data-loading-target="commonModalBody"
                data-modal-title="<?php echo e(cleanLang(__('lang.edit'))); ?> <?php echo e(cleanLang(__('lang.general_expence_request'))); ?>"
                data-action-url="<?php echo e(urlResource('/general-expense/accountant/'.$generalexp->generalexpence_id.'/update/')); ?>"
                data-action-type="form"
                data-action-method="POST" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                data-action-ajax-loading-target="generalexpence-td-container">
                <i class="sl-icon-note"></i>
            </button>

            </span>
            <!--action button-->
        </td>
    <?php endif; ?>
</tr>
    <!--each row-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/components/table/ajax.blade.php ENDPATH**/ ?>