<?php $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchases): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="purchase_<?php echo e($purchases->purchase_id); ?>">
    <?php if($purchases->purchase_status == strtolower('approved')): ?>

    <td class="purchases_col_checkbox checkproposal p-l-0" id="purchases_col_checkbox_<?php echo e($purchases->purchase_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-purchases-<?php echo e($purchases->purchase_id); ?>"
                name="ids[<?php echo e($purchases->purchase_id); ?>]"
                class="listcheckbox listcheckbox-purchases filled-in chk-col-light-blue purchases-checkbox"
                data-actions-container-class="purchases-checkbox-actions-container"
                data-proposal-id="<?php echo e($purchases->purchase_id); ?>">
            <label for="listcheckbox-purchases-<?php echo e($purchases->purchase_id); ?>"></label>
        </span>
    </td>
    <?php else: ?> 
    <td></td>
    
    <?php endif; ?>

    <!--doc_id-->
    <td class="col_doc_id">
        <?php echo e($purchases->purchase_id); ?>

    </td>

    <!--client name-->
    <td class="col_client">
        <?php echo e(str_limit($purchases->client_company_name ?? '---', 12)); ?>

    </td>

    <!--project-->
    <td class="col_client">
       <?php echo e(str_limit($purchases->project_title ?? '---', 25)); ?>

    </td>
    
    <!--supplier-->
    <td class="col_client">
        <?php echo e(str_limit($purchases->supplier_name ?? '---', 25)); ?>

    </td>

    <!--doc_title-->
    <td class="col_doc_title">
        <?php echo e(runtimeDate($purchases->purchase_request_date ?? '---')); ?>

    </td>

    <!--value-->
    <td class="col_value">
        <?php echo e(runtimeMoneyFormat($purchases->total_cost)); ?>

    </td>
    
    <!--approvedby-->
    <td class="col_value">
        <?php echo e($purchases->approver_first_name ?? '---'); ?>

    </td>
    
    <!--doc_date_end-->
    <td class="col_doc_date_start">
        <?php echo e($purchases->paid == 1 ? 'Yes' : 'No'); ?>

    </td>

    <!--status-->
    <td class="col_foo">
        <span
            class="label <?php echo e(runtimePurchaseStatusColors($purchases->purchase_status, 'label')); ?>"><?php echo e(runtimeLang($purchases->purchase_status)); ?></span>
    </td>


    <td class="proposals_col_action actions_column" id="proposals_col_action_<?php echo e($purchases->purchase_id); ?>">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--edit-->

           

            <!--edit-->
             <?php if($purchases->purchase_status == strtolower('approved')): ?>
                <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                
                    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm confirm-action-success"
                    data-url="<?php echo e(url('/purchases/return?action=bulkreturn&purchase_id=' . $purchases->purchase_id)); ?>"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.return_selected_items'))); ?>" 
                    data-ajax-type="POST" 
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>">
                    <i class="sl-icon-note"></i> 
                </button>
            <?php endif; ?>



            <!--view-->
            <!--<a href="<?php echo e(_url('/purchase/'.$purchases->doc_id)); ?>" title="<?php echo e(cleanLang(__('lang.view'))); ?>"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">-->
            <!--    <i class="ti-new-window"></i>-->
            <!--</a>-->

            <!--more button (team)-->



            <!--more button-->

        </span>
        <!--action button-->
       
    </td>
    
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/table/ajax.blade.php ENDPATH**/ ?>