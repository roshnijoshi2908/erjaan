<!--table-->
<?php if(@count($timesheets ?? []) > 0): ?>
<div class="table-responsive report-results-table-container" id="report-results-container">
    <table class="table table-hover no-wrap" id="report-results-table">
        <thead>
            <tr>

                <!--timesheet_client-->
                <th class="col_project_id"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.client'); ?><span
                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>


                <!--sum_not_invoiced-->
                <th class="col_count_projects_completed"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.not_invoiced'); ?><span class="sorting-icons"><i
                        class="ti-arrows-vertical"></i></span></a></th>

                        
                <!--sum_invoiced-->
                <th class="col_count_projects_completed"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.invoiced'); ?><span class="sorting-icons"><i
                        class="ti-arrows-vertical"></i></span></a></th>

                <!--sum_hours-->
                <th class="col_count_projects_completed"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.total'); ?> <span
                            class="text-info font-16" data-toggle="tooltip"
                            title="<?php echo app('translator')->get('lang.hours'); ?> : <?php echo app('translator')->get('lang.minutes'); ?>" data-placement="top"><i
                                class="ti-info-alt"></i></span><span class="sorting-icons"><i
                                class="ti-arrows-vertical"></i></span></a></th>

            </tr>
        </thead>
        <tbody id="report-results-ajax-container">
            <!--rows-->
            <?php echo $__env->make('pages.reports.timesheets.client.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tbody>
        <tfoot>
            <!--rows-->
            <?php echo $__env->make('pages.reports.timesheets.client.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tfoot>
    </table>

</div>
<?php else: ?>
<div id="report-results-container">
    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/reports/timesheets/client/table.blade.php ENDPATH**/ ?>