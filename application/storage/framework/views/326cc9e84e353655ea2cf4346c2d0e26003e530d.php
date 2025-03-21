<?php $__currentLoopData = $generalexpencecat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generalexp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="generalexpence-category_<?php echo e($generalexp->expense_category_id); ?>">
    
     <!--id-->
    <td class="col_category_id">
        <?php echo e($generalexp->expense_category_id ?? '---'); ?>

    </td>

    <!--title-->
    <td class="col_category_name">
        <?php echo e(str_limit($generalexp->category_name ?? '---', 80)); ?>

    </td>

    <!--created by-->
    <td class="col_created_by">
        <img src="<?php echo e(getUsersAvatar($generalexp->avatar_directory, $generalexp->avatar_filename, $generalexp->category_creatorid)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($generalexp->first_name, $generalexp->category_creatorid)); ?>

    </td>


    <!--actions-->
    <td class="col_generalexpence_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="<?php echo app('translator')->get('lang.delete'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete_category'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(urlResource('general-expense/category/'.$generalexp->expense_category_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="<?php echo app('translator')->get('lang.edit'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/general-expense/category/'.$generalexp->expense_category_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit_category'); ?>"
                data-action-url="<?php echo e(urlResource('/general-expense/category/'.$generalexp->expense_category_id)); ?>"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                data-action-ajax-loading-target="generalexpence-category-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/generalexpencecategory/components/table/ajax.blade.php ENDPATH**/ ?>