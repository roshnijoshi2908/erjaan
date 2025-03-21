<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="supplier_<?php echo e($template->supplier_id); ?>">

    <!--title-->
    <td class="col_supplier_title">
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(urlResource('/supplier/'.$template->supplier_id.'/edit')); ?>"
            data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit_supplier'); ?>"
            data-action-url="<?php echo e(urlResource('/supplier/'.$template->supplier_id)); ?>"
            data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
            data-action-ajax-loading-target="proposals-td-container"><?php echo e(str_limit($template->supplier_name ?? '---', 80)); ?></a>
    </td>

    <td class="col_supplier_created">
        <?php echo e($template->category_name, $template->supplier_categoryid); ?>

    </td>
    
    <td class="col_supplier_created">
        <?php echo e($template->total_purchases, $template->total_purchases); ?>

    </td>
    
    <td class="col_supplier_created">
        <?php echo e($template->total_purchase_amount, $template->total_purchase_amount); ?>

    </td>
    
    <td class="col_supplier_created">
        <?php echo e($template->total_paid_amount, $template->total_paid_amount); ?>

    </td>
    
        <td class="col_supplier_created">
        <?php echo e($template->unpaid_amount, $template->unpaid_amount); ?>

    </td>

    <!--actions-->
    <td class="col_proposals_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--edit-->
            <button type="button" title="<?php echo app('translator')->get('lang.edit'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/supplier/'.$template->supplier_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit_supplier'); ?>"
                data-action-url="<?php echo e(urlResource('/supplier/'.$template->supplier_id)); ?>"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
                data-action-ajax-loading-target="supplier-td-container">
                <i class="sl-icon-note"></i>
            </button>
            
            <!--view-->
               <a href="javascript:void(0)" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm show-modal-button js-ajax-ux-request"
                data-toggle="modal" data-url="<?php echo e(url( '/')); ?>/supplier/<?php echo e($template->supplier_id); ?> "
                data-target="#plainModal" data-loading-target="plainModalBody" data-modal-title="">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/supplier/components/table/ajax.blade.php ENDPATH**/ ?>