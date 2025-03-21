<?php $__currentLoopData = $knowledgebase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="knowledgebase_<?php echo e($kb->knowledgebase_id); ?>">
    <td class="knowledgebase_col_title"><a
            href="<?php echo e(url('/')); ?>/kb/article/<?php echo e($kb->knowledgebase_slug); ?>"><?php echo e($kb->knowledgebase_title); ?></a></td>

    <?php if(auth()->user()->role->role_knowledgebase >= 2): ?>
    <td class="knowledgebase_col_action actions_column w-px-80">
        <span class="list-table-action dropdown font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <!--edit-->
                <?php if(config('visibility.action_buttons_edit')): ?>
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(url('/kb/'.$kb->knowledgebase_id.'/edit?source='.request('source'))); ?>"
                    data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_article'))); ?>"
                    data-action-url="<?php echo e(url('/kb/'.$kb->knowledgebase_id)); ?>" data-action-method="PUT"
                    data-action-ajax-class=""
                    data-action-ajax-loading-target="knowledgebase-td-container">
                    <?php echo e(cleanLang(__('lang.edit'))); ?>

                </a>
                <?php endif; ?>
                <!--delete-->
                <?php if(config('visibility.action_buttons_delete')): ?>
                <a class="dropdown-item actions-modal-button  confirm-action-danger"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-ajax-type="DELETE" data-url="<?php echo e(url('/')); ?>/kb/<?php echo e($kb->knowledgebase_id); ?>">
                    <?php echo e(cleanLang(__('lang.delete'))); ?>

                </a>
                <?php endif; ?>
            </div>
        </span>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/knowledgebase/components/table/ajax.blade.php ENDPATH**/ ?>