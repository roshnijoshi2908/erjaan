<div class="card count-<?php echo e(@count($invoices ?? [])); ?>" id="invoices-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper min-h-400">
            <?php if(@count($invoices ?? []) > 0): ?>
            <table id="invoices-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10" >
                <thead>
                    <tr>
                        <?php if(config('visibility.invoices_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-invoices" name="listcheckbox-invoices"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="invoices-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-invoices">
                                <label for="listcheckbox-invoices"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <th class="invoices_col_id"><a class="js-ajax-ux-request js-list-sorting" id="sort_bill_invoiceid"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=bill_invoiceid&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="invoices_col_date"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_bill_date" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=bill_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                    </th>
                        <?php if(config('visibility.invoices_col_client')): ?>
                        <th class="invoices_col_company"><a class="js-ajax-ux-request js-list-sorting" id="sort_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.company_name'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>
                        <?php if(config('visibility.invoices_col_project')): ?>
                        <th class="invoices_col_project"><a class="js-ajax-ux-request js-list-sorting" id="sort_project"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=project&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.project'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <th class="invoices_col_amount"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_final_amount" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=bill_final_amount&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.amount'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.invoices_col_payments')): ?>
                        <th class="invoices_col_payments"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payments" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=payments&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.payments'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <th class="invoices_col_balance hidden"><a class="js-ajax-ux-request js-list-sorting" id="sort_balance"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=balance&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.balance'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="invoices_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/invoices?action=sort&orderby=bill_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="invoices_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="invoices-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.invoices.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($invoices ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/invoices/components/table/table.blade.php ENDPATH**/ ?>