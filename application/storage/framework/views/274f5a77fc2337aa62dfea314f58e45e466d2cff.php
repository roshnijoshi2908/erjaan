<?php $__currentLoopData = $supplierCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="supplier-category_<?php echo e($template->supplier_category_id); ?>">

    <!--title-->
    <td class="col_proposal_template_title">
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(urlResource('/supplier/category/'.$template->supplier_category_id.'/edit')); ?>"
            data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit_category'); ?>"
            data-action-url="<?php echo e(urlResource('/supplier/category/'.$template->supplier_category_id)); ?>"
            data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
            data-action-ajax-loading-target="supplier-category-td-container"><?php echo e(str_limit($template->category_name ?? '---', 80)); ?></a>
    </td>

    <!--proposal_template_created-->
    <!--<td class="col_proposal_template_created">-->
    <!--    <?php echo e(runtimeDate($template->proposal_template_created)); ?>-->
    <!--</td>-->

    <!--created by-->
    <td class="col_created_by">
        <img src="<?php echo e(getUsersAvatar($template->avatar_directory, $template->avatar_filename, $template->category_creatorid)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($template->first_name, $template->category_creatorid)); ?>

    </td>


    <!--actions-->
    <td class="col_supplier_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="<?php echo app('translator')->get('lang.delete'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete_category'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(urlResource('supplier/category/'.$template->supplier_category_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="<?php echo app('translator')->get('lang.edit'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/supplier/category/'.$template->supplier_category_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit_category'); ?>"
                data-action-url="<?php echo e(urlResource('/supplier/category/'.$template->supplier_category_id)); ?>"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
                data-action-ajax-loading-target="supplier-category-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/category/components/table/ajax.blade.php ENDPATH**/ ?>