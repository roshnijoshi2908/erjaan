<?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="bank_<?php echo e($bank->id); ?>">
    
    <!--id by-->
    <td class="col_id">
        <?php echo e($bank->id); ?>

    </td>

    <!--title-->
    <td class="col_bank_name">
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(urlResource('/bank/'.$bank->id.'/edit')); ?>"
            data-modal-size="modal-sm"
            data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit'); ?>"
            data-action-url="<?php echo e(urlResource('/bank/'.$bank->id)); ?>"
            data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
            data-action-ajax-loading-target="bank-td-container"><?php echo e(str_limit($bank->name ?? '---', 80)); ?></a>
    </td>

    <!--created by-->
    <td class="col_created_by">
        <img src="<?php echo e(getUsersAvatar($bank->avatar_directory, $bank->avatar_filename, $bank->creator_id)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($bank->first_name, $bank->creator_id)); ?>

    </td>


    <!--actions-->
    <td class="col_generalexpence_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="<?php echo app('translator')->get('lang.delete'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(urlResource('bank/'.$bank->id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="<?php echo app('translator')->get('lang.edit'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/bank/'.$bank->id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.edit'); ?>"
                data-action-url="<?php echo e(urlResource('/bank/'.$bank->id)); ?>"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                data-action-ajax-loading-target="bank-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bank/components/table/ajax.blade.php ENDPATH**/ ?>