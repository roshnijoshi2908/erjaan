<?php $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchases): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="purchase_<?php echo e($purchases->purchase_id); ?>">

    <!--doc_id-->
    <td class="col_doc_id">
        <a href="<?php echo e(url('/purchase/'.$purchases->purchase_id)); ?>"><?php echo e($purchases->purchase_id); ?></a>
    </td>

    <!--client name-->
    <td class="col_client">
       <?php echo e(str_limit($purchases->client_company_name ?? '---', 12)); ?>

    </td>

    <!--project-->
    <td class="col_project">
        <a href="/projects/<?php echo e($purchases->purchase_projectid); ?>"><?php echo e(str_limit($purchases->project_title ?? '---', 25)); ?></a>
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


    <td class="proposals_col_action actions_column" id="proposals_col_action_<?php echo e($purchases->doc_id); ?>">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->

            <!--<button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"-->
            <!--    data-confirm-title="<?php echo e(cleanLang(__('lang.delete_product'))); ?>"-->
            <!--    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"-->
            <!--    data-url="<?php echo e(url('/')); ?>/purchase/<?php echo e($purchases->doc_id); ?>">-->
            <!--    <i class="sl-icon-trash"></i>-->
            <!--</button>-->

            <!--edit-->

            <!--<a type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"-->
            <!--    href="<?php echo e(url('/purchase/'.$purchases->doc_id.'/edit')); ?>">-->
            <!--    <i class="sl-icon-note"></i>-->
            <!--</a>-->


            <!--view-->
            <!--<a href="<?php echo e(_url('/purchase/'.$purchases->doc_id)); ?>" title="<?php echo e(cleanLang(__('lang.view_invoice'))); ?>"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">-->
            <!--    <i class="ti-new-window"></i>-->
            <!--</a>-->
            
             <a href="javascript:void(0)" title="<?php echo e(cleanLang(__('lang.view_invoice'))); ?>"
                data-modal-title="<?php echo e(cleanLang(__('lang.invoice'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm show-modal-button js-ajax-ux-request"
                data-toggle="modal" data-url="<?php echo e(urlResource('/gm-approvals/'.$purchases->purchase_projectid.'/show-invoice')); ?> "
                data-target="#plainModal" data-loading-target="plainModalBody" data-modal-title="">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
          <!--more button (purchase)-->
        <span class="list-table-action dropdown  font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="<?php echo e(cleanLang(__('lang.more'))); ?>" title="<?php echo e(cleanLang(__('lang.more'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <!--actions button - change category-->
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    data-modal-title="<?php echo e(cleanLang(__('lang.change_status'))); ?>"
                    data-url="<?php echo e(urlResource('/gm-approvals/'.$purchases->purchase_id.'/change-status')); ?>"
                    data-action-url="<?php echo e(urlResource('/gm-approvals/'.$purchases->purchase_id.'/change-status')); ?>"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    <?php echo e(cleanLang(__('lang.change_status'))); ?></a>
            </div>
        </span>
        <!--more button-->
    </td>
    
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/gm/components/table/ajax.blade.php ENDPATH**/ ?>