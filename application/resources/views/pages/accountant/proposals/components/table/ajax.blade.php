    @foreach ($templates as $template)
        <!--each row-->
        <tr id='{{ "template_".$template->purchase_id }}'>
            @if (config('visibility.proposals_col_checkboxes'))
                <td class="proposals_col_checkbox checkproposal p-l-0"
                    id="proposals_col_checkbox_{{ $template->purchase_id }}">
                    <!--list checkbox-->
                    <span class="list-checkboxes display-inline-block w-px-20">
                        <input type="checkbox" id="listcheckbox-proposals-{{ $template->purchase_id }}"
                            name="ids[{{ $template->purchase_id }}]"
                            class="listcheckbox listcheckbox-proposals filled-in chk-col-light-blue proposals-checkbox"
                            data-actions-container-class="proposals-checkbox-actions-container"
                            data-proposal-id="{{ $template->purchase_id }}">
                        <label for="listcheckbox-proposals-{{ $template->purchase_id }}"></label>
                    </span>
                </td>
            @endif
            <!--title-->
            <td class="col_proposal_template_title">
                <a href="javascript:void(0);"
                    class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form">{{ str_limit($template->purchase_id ?? '---', 80) }}</a>
            </td>

            <!--proposal_template_created-->
            <td class="col_proposal_template_created">
                {{ str_limit($template->client_company_name) }}
            </td>

            <!--created by-->
            <td class="col_created_by">

                {{ str_limit($template->project_title) }}
            </td>
            <!--supplier-->
            <td class="col_client">
                <a href="{{ url('/purchase/' . $template->purchase_supplierid) }}"
                    title="{{ $template->supplier_name ?? '---' }}">{{ str_limit($template->supplier_name ?? '---', 25) }}</a>
            </td>
            <!--doc_title-->
            <td class="col_doc_title">
                {{ runtimeDate($template->purchase_request_date ?? '---') }}
            </td>

            <!--value-->
            <td class="col_value">
                {{ runtimeMoneyFormat($template->total_cost) }}
            </td>

            <!--approvedby-->
            <td class="col_value">
                {{ $template->approved_by ?? '---' }}
            </td>
            
            
            <!--doc_date_end-->
            <td class="col_doc_date_start">
                @if(isset($template->paid) && $template->paid == 1)
                    Yes
                @elseif(isset($template->paid) && $template->paid == 0)
                    No
                @else
                    --
                @endif
            </td>
            <!--Bank-->
            <td class="col_value">
                {{ $template->name ?? '---' }}
            </td>
            <!--status-->
            <td class="col_foo">
                <span
                    class="label {{ runtimePurchaseStatusColors($template->purchase_status, 'label') }}">{{ runtimeLang($template->purchase_status) }}</span>
            </td>


            <td class="proposals_col_action actions_column" id="proposals_col_action_{{ $template->purchase_id }}">
                <!--action button-->
                <span class="list-table-action dropdown font-size-inherit">
                    <!--delete-->

                    <!--<button type="button" title="{{ cleanLang(__('lang.delete')) }}"-->
                    <!--    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"-->
                    <!--    data-confirm-title="{{ cleanLang(__('lang.delete_product')) }}"-->
                    <!--    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"-->
                    <!--    data-url="{{ url('/') }}/purchase/{{ $template->doc_id }}">-->
                    <!--    <i class="sl-icon-trash"></i>-->
                    <!--</button>-->

                    <!--edit-->

                    <!--<a type="button" title="{{ cleanLang(__('lang.edit')) }}"-->
                    <!--    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"-->
                    <!--    href="{{ url('/purchase/' . $template->doc_id . '/edit') }}">-->
                    <!--    <i class="sl-icon-note"></i>-->
                    </a>
                    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/accountant/'.$template->purchase_id.'/edit') }}" data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('Edit Purchase Request')) }}" data-action-url="{{ urlResource('/accountant/'.$template->purchase_id) }}"
                        data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request"
                        data-action-ajax-loading-target="templates-td-container">
                        <i class="sl-icon-note"></i>
                    </button>


                    <!--view-->
                    <!--<a href="{{ _url('/purchase/' . $template->doc_id) }}" title="{{ cleanLang(__('lang.view')) }}"-->
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
