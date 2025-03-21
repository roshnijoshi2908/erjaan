<div class="card count-{{ @count($purchase) }}" id="purchases-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($purchase) > 0)
            <table id="purchases-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                       
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <!--<span class="list-checkboxes display-inline-block w-px-20">-->
                            <!--    <input type="checkbox" id="listcheckbox-projects" name="listcheckbox-projects"-->
                            <!--        class="listcheckbox-all filled-in chk-col-light-blue"-->
                            <!--        data-actions-container-class="projects-checkbox-actions-container"-->
                            <!--        data-children-checkbox-class="listcheckbox-projects">-->
                            <!--    <label for="listcheckbox-projects"></label>-->
                            <!--</span>-->
                        </th>
                       
                        <th class="projects_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/projects?action=sort&orderby=project_id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_client">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/projects?action=sort&orderby=project_client&sortorder=asc') }}">{{ cleanLang(__('lang.client')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_projects">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/purchase?action=sort&orderby=purchase_projectid&sortorder=asc') }}">{{ cleanLang(__('lang.project')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_supplier">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/purchase?action=sort&orderby=purchase_supplierid&sortorder=asc') }}">{{ cleanLang(__('lang.supplier')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="projects_col_team"><a href="javascript:void(0)">{{ cleanLang(__('lang.request_date')) }}</a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)">{{ cleanLang(__('lang.total_cost')) }}</a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)">{{ cleanLang(__('lang.approved_by')) }}</a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)">{{ cleanLang(__('lang.paid')) }}</a></th>

                        <th class="projects_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/projects?action=sort&orderby=project_status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <!--<th class="projects_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>-->
                    </tr>
                </thead>
                <tbody id="purchases-td-container">
                    <!--ajax content here-->
                    @include('pages.purchase.components.table.ajax')
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
            @endif @if (@count($purchase) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>