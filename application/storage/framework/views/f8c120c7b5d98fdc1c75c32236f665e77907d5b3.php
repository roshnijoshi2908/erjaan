
<div class="card count-<?php echo e((count($generalexpence) != null) ? @count($generalexpence) : 0); ?>" id="expence-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            <?php if(@count($generalexpence) > 0): ?>
            <table id="projects-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.projects_col_checkboxes')): ?>
                        
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-projects" name="listcheckbox-projects"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="projects-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-projects">
                                <label for="listcheckbox-projects"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        
                     <?php if($change_status): ?> 
                        <?php
                            $url = "general-expense/gm-approvals";
                        ?>
                    <?php elseif($accountant): ?>
                        <?php
                            $url = "general-expense/accountant";
                        ?>
                    <?php else: ?>
                        <?php
                            $url = "general-expense";
                        ?>
                    <?php endif; ?>
                        
                        
                        <th class="generalexpence_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_generalexpence_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=generalexpence_id&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="generalexpence_col_client">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_purpose"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=purpose&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.purpose'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_projects">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_comments"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=comments&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.comments'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_projects">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_approved_by"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=approved_by&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.approved_by'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_team">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_amount"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=amount&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.amount'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_team">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=category&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.category'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_team">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_subcategory"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=subcategory&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.subcategory'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=status&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_team">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_paid"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=paid&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.paid'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="projects_col_team">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bank"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource($url.'?action=sort&orderby=bank&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.bank'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                                                
                        <?php if($change_status || $accountant): ?>
                            <th class="projects_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="expence-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.generalexpence.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($generalexpence) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/components/table/table.blade.php ENDPATH**/ ?>