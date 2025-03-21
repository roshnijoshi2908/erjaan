
<div class="card count-{{ is_countable($generalexpencecat) ? count($generalexpencecat) : 0 }}" id="expencecat-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            @if (@count($generalexpencecat) > 0)
            <table id="expencecat-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                 <thead>
                     
                     <th class="col_catgeory_id"><a class="js-ajax-ux-request js-list-sorting"
                        id="sort_subcategory_name" href="javascript:void(0)"
                        data-url="{{ urlResource('/general-expense/category?action=sort&orderby=id&sortorder=asc') }}">@lang('lang.id')<span
                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--title-->
                    <th class="col_catgeory_name"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_proposal_template_title" href="javascript:void(0)"
                            data-url="{{ urlResource('/general-expense/category?action=sort&orderby=category_name&sortorder=asc') }}">@lang('lang.name')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                   

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)">@lang('lang.created_by')</a></th>

                    <!--actions-->
                    <th class="col_generalexpence_category_actions w-px-120"><a href="javascript:void(0)">@lang('lang.actions')</a>
                    </th>
                </thead>
                <tbody id="expencecat-td-container">
                    <!--ajax content here-->
                    @include('pages.generalexpence.generalexpencecategory.components.table.ajax')
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
            @endif @if (@count($generalexpencecat) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>