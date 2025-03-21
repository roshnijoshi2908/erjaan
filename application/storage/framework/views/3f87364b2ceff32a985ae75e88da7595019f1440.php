<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="purchases-checkbox-actions-container">
   
    <div class="x-buttons">
     
       <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" 
                data-type="form"
                data-ajax-type="POST" 
                data-form-id="purchases-list-table" 
                data-url="<?php echo e(url('/purchases/return?action=bulkreturn')); ?>"
                data-confirm-title="<?php echo e(cleanLang(__('lang.return_selected_items'))); ?>" 
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                id="checkbox-actions-return-purchases">
               <?php echo e(cleanLang(__('lang.return_items'))); ?>

        </button>
    </div>
</div>




<!--<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="purchases-checkbox-actions-container">-->
<!--    <div class="x-buttons">-->
<!--        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" -->
<!--                id="checkbox-actions-return-purchases"-->
<!--                data-confirm-title="<?php echo e(cleanLang(__('lang.return_selected_items'))); ?>" -->
<!--                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>">-->
<!--            <?php echo e(cleanLang(__('lang.return_items'))); ?>-->
<!--        </button>-->
<!--    </div>-->
<!--</div>--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>