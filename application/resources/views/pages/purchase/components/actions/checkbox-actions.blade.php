<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="purchases-checkbox-actions-container">
   
    <div class="x-buttons">
     
       <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" 
                data-type="form"
                data-ajax-type="POST" 
                data-form-id="purchases-list-table" 
                data-url="{{ url('/purchases/return?action=bulkreturn') }}"
                data-confirm-title="{{ cleanLang(__('lang.return_selected_items')) }}" 
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                id="checkbox-actions-return-purchases">
               {{ cleanLang(__('lang.return_items')) }}
        </button>
    </div>
</div>




<!--<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="purchases-checkbox-actions-container">-->
<!--    <div class="x-buttons">-->
<!--        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" -->
<!--                id="checkbox-actions-return-purchases"-->
<!--                data-confirm-title="{{ cleanLang(__('lang.return_selected_items')) }}" -->
<!--                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}">-->
<!--            {{ cleanLang(__('lang.return_items')) }}-->
<!--        </button>-->
<!--    </div>-->
<!--</div>-->