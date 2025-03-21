    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!--each row-->
        <tr id='<?php echo e("template_".$template->purchase_id); ?>'>
            <?php if(config('visibility.proposals_col_checkboxes')): ?>
                <td class="proposals_col_checkbox checkproposal p-l-0"
                    id="proposals_col_checkbox_<?php echo e($template->purchase_id); ?>">
                    <!--list checkbox-->
                    <span class="list-checkboxes display-inline-block w-px-20">
                        <input type="checkbox" id="listcheckbox-proposals-<?php echo e($template->purchase_id); ?>"
                            name="ids[<?php echo e($template->purchase_id); ?>]"
                            class="listcheckbox listcheckbox-proposals filled-in chk-col-light-blue proposals-checkbox"
                            data-actions-container-class="proposals-checkbox-actions-container"
                            data-proposal-id="<?php echo e($template->purchase_id); ?>">
                        <label for="listcheckbox-proposals-<?php echo e($template->purchase_id); ?>"></label>
                    </span>
                </td>
            <?php endif; ?>
            <!--title-->
            <td class="col_proposal_template_title">
                <a href="javascript:void(0);"
                    class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"><?php echo e(str_limit($template->purchase_id ?? '---', 80)); ?></a>
            </td>

            <!--proposal_template_created-->
            <td class="col_proposal_template_created">
                <?php echo e(str_limit($template->client_company_name)); ?>

            </td>

            <!--created by-->
            <td class="col_created_by">

                <?php echo e(str_limit($template->project_title)); ?>

            </td>
            <!--supplier-->
            <td class="col_client">
                <a href="<?php echo e(url('/purchase/' . $template->purchase_supplierid)); ?>"
                    title="<?php echo e($template->supplier_name ?? '---'); ?>"><?php echo e(str_limit($template->supplier_name ?? '---', 25)); ?></a>
            </td>
            <!--doc_title-->
            <td class="col_doc_title">
                <?php echo e(runtimeDate($template->purchase_request_date ?? '---')); ?>

            </td>

            <!--value-->
            <td class="col_value">
                <?php echo e(runtimeMoneyFormat($template->total_cost)); ?>

            </td>

            <!--approvedby-->
            <td class="col_value">
                <?php echo e($template->approved_by ?? '---'); ?>

            </td>
            
            
            <!--doc_date_end-->
            <td class="col_doc_date_start">
                <?php if(isset($template->paid) && $template->paid == 1): ?>
                    Yes
                <?php elseif(isset($template->paid) && $template->paid == 0): ?>
                    No
                <?php else: ?>
                    --
                <?php endif; ?>
            </td>
            <!--Bank-->
            <td class="col_value">
                <?php echo e($template->name ?? '---'); ?>

            </td>
            <!--status-->
            <td class="col_foo">
                <span
                    class="label <?php echo e(runtimePurchaseStatusColors($template->purchase_status, 'label')); ?>"><?php echo e(runtimeLang($template->purchase_status)); ?></span>
            </td>


            <td class="proposals_col_action actions_column" id="proposals_col_action_<?php echo e($template->purchase_id); ?>">
                <!--action button-->
                <span class="list-table-action dropdown font-size-inherit">
                    <!--delete-->

                    <!--<button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"-->
                    <!--    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"-->
                    <!--    data-confirm-title="<?php echo e(cleanLang(__('lang.delete_product'))); ?>"-->
                    <!--    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"-->
                    <!--    data-url="<?php echo e(url('/')); ?>/purchase/<?php echo e($template->doc_id); ?>">-->
                    <!--    <i class="sl-icon-trash"></i>-->
                    <!--</button>-->

                    <!--edit-->

                    <!--<a type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"-->
                    <!--    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"-->
                    <!--    href="<?php echo e(url('/purchase/' . $template->doc_id . '/edit')); ?>">-->
                    <!--    <i class="sl-icon-note"></i>-->
                    </a>
                    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="<?php echo e(urlResource('/accountant/'.$template->purchase_id.'/edit')); ?>" data-loading-target="commonModalBody"
                        data-modal-title="<?php echo e(cleanLang(__('Edit Purchase Request'))); ?>" data-action-url="<?php echo e(urlResource('/accountant/'.$template->purchase_id)); ?>"
                        data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request"
                        data-action-ajax-loading-target="templates-td-container">
                        <i class="sl-icon-note"></i>
                    </button>


                    <!--view-->
                    <!--<a href="<?php echo e(_url('/purchase/' . $template->doc_id)); ?>" title="<?php echo e(cleanLang(__('lang.view'))); ?>"-->
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
    <!--each row-->
<?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/accountant/proposals/components/table/ajax.blade.php ENDPATH**/ ?>