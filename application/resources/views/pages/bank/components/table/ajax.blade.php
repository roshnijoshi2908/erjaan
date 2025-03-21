@foreach($banks as $bank)
<!--each row-->
<tr id="bank_{{ $bank->id }}">
    
    <!--id by-->
    <td class="col_id">
        {{ $bank->id  }}
    </td>

    <!--title-->
    <td class="col_bank_name">
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="{{ urlResource('/bank/'.$bank->id.'/edit') }}"
            data-modal-size="modal-sm"
            data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit')"
            data-action-url="{{ urlResource('/bank/'.$bank->id) }}"
            data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-xxl"
            data-action-ajax-loading-target="bank-td-container">{{ str_limit($bank->name ?? '---', 80) }}</a>
    </td>

    <!--created by-->
    <td class="col_created_by">
        <img src="{{ getUsersAvatar($bank->avatar_directory, $bank->avatar_filename, $bank->creator_id) }}"
            alt="user" class="img-circle avatar-xsmall">
        {{ checkUsersName($bank->first_name, $bank->creator_id)  }}
    </td>


    <!--actions-->
    <td class="col_generalexpence_category_actions actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="@lang('lang.delete')"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="@lang('lang.delete')" data-confirm-text="@lang('lang.are_you_sure')"
                data-ajax-type="DELETE" data-url="{{ urlResource('bank/'.$bank->id) }}">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <button type="button" title="@lang('lang.edit')"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/bank/'.$bank->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit')"
                data-action-url="{{ urlResource('/bank/'.$bank->id) }}"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request" data-modal-size="modal-sm"
                data-action-ajax-loading-target="bank-td-container">
                <i class="sl-icon-note"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
@endforeach
<!--each row-->