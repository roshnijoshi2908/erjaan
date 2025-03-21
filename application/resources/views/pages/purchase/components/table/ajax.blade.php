@foreach($purchase as $purchases)
<!--each row-->
<tr id="purchase_{{ $purchases->purchase_id  }}">
    @if($purchases->purchase_status == strtolower('approved'))

    <td class="purchases_col_checkbox checkproposal p-l-0" id="purchases_col_checkbox_{{ $purchases->purchase_id }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-purchases-{{ $purchases->purchase_id  }}"
                name="ids[{{ $purchases->purchase_id  }}]"
                class="listcheckbox listcheckbox-purchases filled-in chk-col-light-blue purchases-checkbox"
                data-actions-container-class="purchases-checkbox-actions-container"
                data-proposal-id="{{ $purchases->purchase_id }}">
            <label for="listcheckbox-purchases-{{ $purchases->purchase_id  }}"></label>
        </span>
    </td>
    @else 
    <td></td>
    
    @endif

    <!--doc_id-->
    <td class="col_doc_id">
        {{ $purchases->purchase_id }}
    </td>

    <!--client name-->
    <td class="col_client">
        {{ str_limit($purchases->client_company_name ?? '---', 12) }}
    </td>

    <!--project-->
    <td class="col_client">
       {{ str_limit($purchases->project_title ?? '---', 25) }}
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


    <td class="proposals_col_action actions_column" id="proposals_col_action_{{ $purchases->purchase_id }}">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--edit-->

           

            <!--edit-->
             @if($purchases->purchase_status == strtolower('approved'))
                <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                
                    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm confirm-action-success"
                    data-url="{{ url('/purchases/return?action=bulkreturn&purchase_id=' . $purchases->purchase_id) }}"
                    data-confirm-title="{{ cleanLang(__('lang.return_selected_items')) }}" 
                    data-ajax-type="POST" 
                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}">
                    <i class="sl-icon-note"></i> 
                </button>
            @endif



            <!--view-->
            <!--<a href="{{ _url('/purchase/'.$purchases->doc_id) }}" title="{{ cleanLang(__('lang.view')) }}"-->
            <!--    class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">-->
            <!--    <i class="ti-new-window"></i>-->
            <!--</a>-->

            <!--more button (team)-->



            <!--more button-->

        </span>
        <!--action button-->
       
    </td>
    
</tr>
@endforeach
<!--each row-->