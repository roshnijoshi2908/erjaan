<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">

        <!--ADD NEW ITEM-->
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" 
            data-target="#commonModal"
            data-url="<?php echo e(url('supplier/category/create?supplier_category_id=' . request('supplier_category_id'))); ?>"
            data-loading-target="commonModalBody" 
            data-modal-title="<?php echo app('translator')->get('lang.add_category'); ?>"
            data-action-url="<?php echo e(url('supplier/category?supplier_category_id=' . request('supplier_category_id'))); ?>"
            data-action-method="POST" 
            data-modal-size="modal-xxl" 
            data-action-ajax-loading-target="commonModalBody">
            <i class="ti-plus"></i>
        </button>

    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/category/components/misc/list-page-actions.blade.php ENDPATH**/ ?>