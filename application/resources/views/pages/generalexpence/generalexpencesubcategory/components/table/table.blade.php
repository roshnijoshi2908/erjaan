
<div class="card count-{{ is_countable($generalexpencesubcat) ? count($generalexpencesubcat) : 0 }}" id="expencesubcat-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            @if (@count($generalexpencesubcat) > 0)
            <table id="expencecat-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                 <thead>
                     
                     <!--subcategory-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_subcategory_name" href="javascript:void(0)"
                            data-url="{{ urlResource('/general-expense/subcategory?action=sort&orderby=id&sortorder=asc') }}">@lang('lang.id')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--subcategory-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_subcategory_name" href="javascript:void(0)"
                            data-url="{{ urlResource('/general-expense/subcategory?action=sort&orderby=subcategory_name&sortorder=asc') }}">@lang('lang.name')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                                
                    <!--category-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_category_name" href="javascript:void(0)"
                            data-url="{{ urlResource('/general-expense/subcategory?action=sort&orderby=category_name&sortorder=asc') }}">@lang('lang.category')<span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                   

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)">@lang('lang.created_by')</a></th>

                    <!--actions-->
                    <th class="col_generalexpence_category_actions w-px-120"><a href="javascript:void(0)">@lang('lang.actions')</a>
                    </th>
                </thead>
                <tbody id="expencesubCat-td-container">
                    <!--ajax content here-->
                    @include('pages.generalexpence.generalexpencesubcategory.components.table.ajax')
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
            @endif @if (@count($generalexpencesubcat) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>