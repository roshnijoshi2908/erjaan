
<div class="card count-{{ is_countable($banks) ? count($banks) : 0 }}" id="bank-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            @if (@count($banks) > 0)
            <table id="bank-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                 <thead>
                     
                    <!--title-->
                    <th class="col_name"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_id" href="javascript:void(0)"
                            data-url="{{ urlResource('/bank?action=sort&orderby=id&sortorder=asc') }}">@lang('lang.id')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--title-->
                    <th class="col_name"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_name" href="javascript:void(0)"
                            data-url="{{ urlResource('/bank?action=sort&orderby=name&sortorder=asc') }}">@lang('lang.name')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                   

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)">@lang('lang.created_by')</a></th>

                    <!--actions-->
                    <th class="col_bank_actions w-px-120"><a href="javascript:void(0)">@lang('lang.actions')</a>
                    </th>
                </thead>
                <tbody id="bank-td-container">
                    <!--ajax content here-->
                    @include('pages.bank.components.table.ajax')
                    <!--/ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--/load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif @if (count($banks) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>