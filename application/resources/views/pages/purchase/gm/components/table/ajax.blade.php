@foreach($purchase as $purchases)
<!--each row-->
<tr id="purchase_{{ $purchases->purchase_id }}">

    <!--doc_id-->
    <td class="col_doc_id">
        <a href="{{ url('/purchase/'.$purchases->purchase_id) }}">{{ $purchases->purchase_id }}</a>
    </td>

    <!--client name-->
    <td class="col_client">
       {{ str_limit($purchases->client_company_name ?? '---', 12) }}
    </td>

    <!--project-->
    <td class="col_project">
        <a href="/projects/{{ $purchases->purchase_projectid }}">{{ str_limit($purchases->project_title ?? '---', 25) }}</a>
    </td>
    
    <!--supplier-->
    <td class="col_client">
        {{ str_limit($purchases->supplier_name ?? '---', 25) }}
    </td>

    <!--doc_title-->
    <td class="col_doc_title">
        {{ runtimeDate($purchases->purchase_request_date ?? '---') }}
    </td>

    <!--value-->
    <td class="col_value">
        {{ runtimeMoneyFormat($purchases->total_cost) }}
    </td>
    
    <!--approvedby-->
    <td class="col_value">
        {{ $purchases->approver_first_name ?? '---' }}
    </td>
    
    <!--doc_date_end-->
    <td class="col_doc_date_start">
        {{ $purchases->paid == 1 ? 'Yes' : 'No' }}
    </td>

    <!--status-->
    <td class="col_foo">
        <span
            class="label {{ runtimePurchaseStatusColors($purchases->purchase_status, 'label') }}">{{ runtimeLang($purchases->purchase_status) }}</span>
    </td>


    <td class="proposals_col_action actions_column" id="proposals_col_action_{{ $purchases->doc_id }}">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->

            <!--<button type="button" title="{{ cleanLang(__('lang.delete')) }}"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"-->
            <!--    data-confirm-title="{{ cleanLang(__('lang.delete_product')) }}"-->
            <!--    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"-->
            <!--    data-url="{{ url('/') }}/purchase/{{ $purchases->doc_id }}">-->
            <!--    <i class="sl-icon-trash"></i>-->
            <!--</button>-->

            <!--edit-->

            <!--<a type="button" title="{{ cleanLang(__('lang.edit')) }}"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"-->
            <!--    href="{{ url('/purchase/'.$purchases->doc_id.'/edit') }}">-->
            <!--    <i class="sl-icon-note"></i>-->
            <!--</a>-->


            <!--view-->
            <!--<a href="{{ _url('/purchase/'.$purchases->doc_id) }}" title="{{ cleanLang(__('lang.view_invoice')) }}"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">-->
            <!--    <i class="ti-new-window"></i>-->
            <!--</a>-->
            
             <a href="javascript:void(0)" title="{{ cleanLang(__('lang.view_invoice')) }}"
                data-modal-title="{{ cleanLang(__('lang.invoice')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm show-modal-button js-ajax-ux-request"
                data-toggle="modal" data-url="{{ urlResource('/gm-approvals/'.$purchases->purchase_projectid.'/show-invoice') }} "
                data-target="#plainModal" data-loading-target="plainModalBody" data-modal-title="">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
          <!--more button (purchase)-->
        <span class="list-table-action dropdown  font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="{{ cleanLang(__('lang.more')) }}" title="{{ cleanLang(__('lang.more')) }}"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <!--actions button - change category-->
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
                    data-url="{{ urlResource('/gm-approvals/'.$purchases->purchase_id.'/change-status') }}"
                    data-action-url="{{ urlResource('/gm-approvals/'.$purchases->purchase_id.'/change-status') }}"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    {{ cleanLang(__('lang.change_status')) }}</a>
            </div>
        </span>
        <!--more button-->
    </td>
    
</tr>
@endforeach
<!--each row-->