@foreach($supplierCategory as $template)
<!--each row-->
<tr id="supplier-category_{{ $template->supplier_category_id }}">

    <!--title-->
    <td class="col_proposal_template_title">
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="{{ urlResource('/supplier/category/'.$template->supplier_category_id.'/edit') }}"
            data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit_category')"
            data-action-url="{{ urlResource('/supplier/category/'.$template->supplier_category_id) }}"
            data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
            data-action-ajax-loading-target="supplier-category-td-container">{{ str_limit($template->category_name ?? '---', 80) }}</a>
    </td>

    <!--proposal_template_created-->
    <!--<td class="col_proposal_template_created">-->
    <!--    {{ runtimeDate($template->proposal_template_created) }}-->
    <!--</td>-->

    <!--created by-->
    <td class="col_created_by">
        <img src="{{ getUsersAvatar($template->avatar_directory, $template->avatar_filename, $template->category_creatorid) }}"
            alt="user" class="img-circle avatar-xsmall">
        {{ checkUsersName($template->first_name, $template->category_creatorid)  }}
    </td>


    <!--actions-->
    <td class="col_supplier_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="@lang('lang.delete')"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="@lang('lang.delete_category')" data-confirm-text="@lang('lang.are_you_sure')"
                data-ajax-type="DELETE" data-url="{{ urlResource('supplier/category/'.$template->supplier_category_id) }}">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="@lang('lang.edit')"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/supplier/category/'.$template->supplier_category_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit_category')"
                data-action-url="{{ urlResource('/supplier/category/'.$template->supplier_category_id) }}"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
                data-action-ajax-loading-target="supplier-category-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
@endforeach
<!--each row-->