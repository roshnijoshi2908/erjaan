<div class="card count-<?php echo e(@count($purchase)); ?>" id="purchases-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($purchase) > 0): ?>
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
                                data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_client">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.client'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_projects">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/purchase?action=sort&orderby=purchase_projectid&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.project'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="projects_col_supplier">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/purchase?action=sort&orderby=purchase_supplierid&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.supplier'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="projects_col_team"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.request_date'))); ?></a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.total_cost'))); ?></a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.approved_by'))); ?></a></th>
                        <th class="projects_col_team"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.paid'))); ?></a></th>

                        <th class="projects_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_status"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <!--<th class="projects_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>-->
                    </tr>
                </thead>
                <tbody id="purchases-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.purchase.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--/ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--/load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($purchase) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/table/table.blade.php ENDPATH**/ ?>