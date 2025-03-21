@foreach($generalexpencecat as $generalexp)
<!--each row-->
<tr id="generalexpence-category_{{ $generalexp->expense_category_id }}">
    
     <!--id-->
    <td class="col_category_id">
        {{ $generalexp->expense_category_id ?? '---' }}
    </td>

    <!--title-->
    <td class="col_category_name">
        {{ str_limit($generalexp->category_name ?? '---', 80) }}
    </td>

    <!--created by-->
    <td class="col_created_by">
        <img src="{{ getUsersAvatar($generalexp->avatar_directory, $generalexp->avatar_filename, $generalexp->category_creatorid) }}"
            alt="user" class="img-circle avatar-xsmall">
        {{ checkUsersName($generalexp->first_name, $generalexp->category_creatorid)  }}
    </td>


    <!--actions-->
    <td class="col_generalexpence_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="@lang('lang.delete')"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="@lang('lang.delete_category')" data-confirm-text="@lang('lang.are_you_sure')"
                data-ajax-type="DELETE" data-url="{{ urlResource('general-expense/category/'.$generalexp->expense_category_id) }}">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="@lang('lang.edit')"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/general-expense/category/'.$generalexp->expense_category_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit_category')"
                data-action-url="{{ urlResource('/general-expense/category/'.$generalexp->expense_category_id) }}"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                data-action-ajax-loading-target="generalexpence-category-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
@endforeach
<!--each row-->