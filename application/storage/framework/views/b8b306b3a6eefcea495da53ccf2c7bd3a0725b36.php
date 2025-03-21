 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">
    
  <!-- table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-body text-center">
                    <form action="" id="filter_form">
                        <div class="row align-items-center" style="row-gap: 10px;">
                            <div class="col-lg-2 mr-auto">
                                <h3 class="mb-0 text-left" style="font-weight: 500;"><?php echo app('translator')->get('lang.filter'); ?></h3>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <select class="form-control text-left" name="filter" data-allow-clear="false" id="date_filter">
                                        <option value="current-month" <?php echo e(request()->get('filter') && request()->get('filter') == 'current-month' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.this_month'); ?></option>
                                        <option value="last-month" <?php echo e(request()->get('filter') == 'last-month' ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.last_month'); ?></option>
                                        <option value="this-year" <?php echo e(request()->get('filter') == 'this-year' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.this_year'); ?></option>
                                        <option value="last-year" <?php echo e(request()->get('filter') == 'last-year' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.last_year'); ?></option>
                                        <option value="custom" <?php echo e(request()->get('filter') == 'custom' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.custom_date'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" style="display: <?php echo e(request()->get('filter') == 'custom' ? 'block' : 'none'); ?>;" id="date_range_div">
                                <div class="form-group mb-0">
                                    <input type="text" name="" id="daterange" value="" class="form-control date-range-picker text-center"/>
                                </div>
                            </div>
                            <?php if(request()->get('filter')): ?>
                            <div class="col-lg-2 col-md-4" id="clear_filter_div">
                                <div class="form-group mb-0">
                                    <button type="button" id="clear_filter_button" class="btn btn-sm btn-primary"><?php echo app('translator')->get('lang.clear_filter'); ?></button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="start_date" id="start_date">
                        <input type="hidden" name="end_date" id="end_date">
                    </form>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-3">
            <div class="card bg-white top-card-design <?php echo e(runtimeKanbanBoardColors($status->leadstatus_color)); ?>" id="contracts-table-wrapper">
                <div class="card-body text-center">
                    <h4 class="font-bold"><?php echo e($statusCount[$status->leadstatus_id] ?? 0); ?></h4>
                    <p class="mb-0"><?php echo e($status->leadstatus_title); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card bg-white card-new-design">
                <div class="card-body">
                    <h3 class="mb-4" style="font-weight: 500;"><?php echo app('translator')->get('lang.top_in_new_leads'); ?></h3>
                    <div class="d-flex align-items-center" style="flex-wrap: wrap; gap: 25px 50px;">
                        <?php $__currentLoopData = $leadTop3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topLead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="person-card">
                            <span><?php echo e($key + 1); ?></span>
                            <div class="person mx-auto">
                                <img src="<?php echo e($topLead->creator?->avatar); ?>" alt="img">
                            </div>
                            <h3 class="mb-0"><?php echo e($topLead->lead_count); ?></h3>
                            <p class="mb-0"><?php echo e($topLead->creator?->first_name .' '. $topLead->creator?->last_name); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-white card-new-design">
                <div class="card-body">
                    <h3 class="mb-4" style="font-weight: 500;"><?php echo app('translator')->get('lang.top_in_revenue'); ?></h3>
                    <div class="d-flex align-items-center" style="flex-wrap: wrap; gap: 25px 50px;">
                        <?php $__currentLoopData = $top3Revenues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topLead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="person-card">
                            <span><?php echo e($key + 1); ?></span>
                            <div class="person mx-auto">
                                <img src="<?php echo e($topLead->creator?->avatar); ?>" alt="img">
                            </div>
                            <h3 class="mb-0">$<?php echo e($topLead->total_lead_value); ?></h3>
                            <p class="mb-0"><?php echo e($topLead->creator?->first_name .' '. $topLead->creator?->last_name); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- table-->
            <div class="card bg-white card-new-design" id="contracts-table-wrapper">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.all_activities'); ?></h3>
                    <div class="table-responsive list-table-wrapper new-table-design">
                        <table id="contracts-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contract-list all-activities"
                            data-page-size="10">
                            <thead>
                                <tr>
                                    <!--doc_id-->
                                    <th class="col_doc_id"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_id"
                                        href="javascript:void(0)"
                                        ><?php echo app('translator')->get('lang.id'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>
            
                                    <!--doc_title-->
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_title"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.title'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>
                                    <!--doc_title-->
                                    <!--<th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_title"
                                        href="javascript:void(0)"
                                       >Sales Person Name<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>-->
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="col_client"><a class="js-ajax-ux-request js-list-sorting" 
                                        data-url="<?php echo e(urlResource('/contracts?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e($status['leadstatus_title']); ?>

                                        </a>
                                    </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_leads"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.total_number_leads'); ?></a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_number_converted_leads"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.total_number_of_leads_converted'); ?></a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_conversion_ratio"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.conversion_ratio'); ?></a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_amount_of_revenue"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.total_amount_of_revenue'); ?></a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_target_revenue"
                                        href="javascript:void(0)"
                                       ><?php echo app('translator')->get('lang.target_revenue'); ?></a>
                                    </th>
                                </tr>
                            </thead>
                            <!--<tbody>
                                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $totalLeads = 0;
                                $totalConvertedLeads = 0;
                                $totalRevenue = 0;
                                ?>
                                    <tr>
                                        <td><?php echo e($lead->lead_id); ?></td>
                                        <td><?php echo e(str_limit($lead->full_name, 15)); ?></td>
                                        
                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php if($lead->lead_status == $status->leadstatus_id): ?>
                                                <?php
                                                $totalLeads += $statusCount[$status->leadstatus_id] ?? 0;
                                                if($status->leadstatus_title === 'Converted') {
                                                    $totalConvertedLeads += $statusCount[$status->leadstatus_id] ?? 0;
                                                }
                                                ?>
                                                     <?php echo e($statusCount[$status->leadstatus_id] ?? 0); ?> 
                                                <?php else: ?>
                                                0
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php echo e($totalLeads); ?>

                                        </td>
                                        <td>
                                            <?php echo e($totalConvertedLeads); ?>

                                        </td>
                                        <td>
                                            <?php echo e(number_format(($totalConvertedLeads / $leads->count()) * 100, 2)); ?> %
                                        </td>
                                        <td>
                                            <?php echo e($lead->lead_value); ?> 
                                        </td>
                                        <td>
                                            <?php echo e($lead->creator?->target_revenue ?? 0); ?> 
                                        </td>
                                    </tr>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>-->
                            
                            <tbody>
                                <?php $__currentLoopData = $payload['salesPersons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesPerson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                               
                               
                                $totalLeads = $salesPerson->assignedLeads->count();
                                $totalRevenue = 0;
                                $totalLeadValue = $salesPerson->assignedLeads->where('lead_converted', 'yes')->sum('lead_value');
                                $totalConvertedLeads = $salesPerson->assignedLeads->where('lead_converted', 'yes')->count();
                                ?>
                                    <tr>
                                        <td><?php echo e($salesPerson->id); ?></td>
                                        <td>
                                            
                                            
                                            <img src="<?php echo e(getUsersAvatar($salesPerson->avatar_directory, $salesPerson->avatar_filename)); ?>" alt="user"
                                                class="img-circle avatar-xsmall">
                                            <span><?php echo e(str_limit($salesPerson->first_name . ' ' . $salesPerson->last_name, 15)); ?></span>
                                        </td>

                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php
                                                $count = 0 ;
                                                $count = $salesPerson->assignedLeads
                                                    ->where('lead_status', $status->leadstatus_id)->count();
                                                ?>
                                                     <?php echo e($count ?? 0); ?> 
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php echo e($totalLeads); ?>

                                        </td>
                                        <td>
                                            <?php echo e($totalConvertedLeads); ?>

                                        </td>
                                        <td>
                                            <?php echo e(($totalLeads != 0) ? number_format(($totalConvertedLeads / $totalLeads) * 100, 2) : 0.00); ?> %
                                        </td>
                                        <td>
                                            <?php echo e($totalLeadValue); ?> 
                                        </td>
                                        <td>
                                            <?php echo e($salesPerson->target_revenue ?? 0); ?> 
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- table-->
        </div>
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="contracts-table-wrapper">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.leads'); ?></h3>
                    <div id="dashboardWidget"></div>
                    <ul class="list-inline m-t-30 text-center font-12">
                     <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="p-b-10"><span class="label label-<?php echo e($status['leadstatus_color']); ?> label-rounded"><i class="fa fa-circle <?php echo e($status['leadstatus_color']); ?>"></i> <?php echo e($status['leadstatus_title']); ?> <?php echo e($statusCount[$status->leadstatus_id] ?? 0); ?>

                                </span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="contracts-table-wrapper">
                <div class="card-body">
                    <!--<h3 class="mb-3" style="font-weight: 500;">Leads</h3>-->
                    <div id=gaugeWidget></div>
                    <div class="mt-4 text-center">
                        <span class="label label-info"><?php echo app('translator')->get('lang.new_to_convert_ratio'); ?></span>
                    </div>
                </div>
            </div>
            <div class="card bg-white card-new-design" id="contracts-table-wrapper">
                <div class="card-body">
                    <!--<h3 class="mb-3" style="font-weight: 500;">Leads</h3>-->
                    <div id=gaugeWidget1></div>
                    <div class="mt-4 text-center">
                        <span class="label label-info"><?php echo app('translator')->get('lang.qualified_to_convert_ratio'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="category-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.categories'); ?> (<?php echo e($payload['payload']['year'] ?? date('Y')); ?>)</h3>
                    <div id="dashboardCategoryBarChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="lead-source-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.lead_sources'); ?> (<?php echo e($payload['payload']['year'] ?? date('Y')); ?>)</h3>
                    <div id="dashboardLeadSourceBarChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card bg-white card-new-design" id="lead-source-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.leads_converted'); ?> (<?php echo e($payload['payload']['year'] ?? date('Y')); ?>)</h3>
                    <div id="dashboardLeadsConvertedBarChart"></div>
                </div>
            </div>
        </div>
    
    </div>
         <!--[DYNAMIC INLINE SCRIPT]  Backend Variables to Javascript Variables-->
    <script>
        NX.admin_home_c3_leads_data = JSON.parse('<?php echo _clean($payload['payload']["leads_stats"]); ?>', true);
        NX.admin_home_c3_leads_colors = JSON.parse('<?php echo _clean($payload['payload']["leads_key_colors"]); ?>', true);
        NX.admin_home_c3_leads_title = "<?php echo e($payload['payload']['leads_chart_center_title']); ?>";
        
        // category data
        NX.admin_home_c3_category_data = JSON.parse('<?php echo _clean($categoryData); ?>', true);
        NX.admin_home_c3_category_value = JSON.parse('<?php echo _clean($categoryValue); ?>', true);
        
        // lead source data
        NX.admin_home_c3_lead_source_data = JSON.parse('<?php echo _clean($leadSourceData); ?>', true);
        NX.admin_home_c3_lead_source_value = JSON.parse('<?php echo _clean($leadSourceValue); ?>', true);
        
        // leads converted data
        NX.admin_home_c3_leads_converted_data = JSON.parse('<?php echo _clean($leadsData); ?>', true);
        NX.admin_home_c3_leads_converted_value = JSON.parse('<?php echo _clean($leadsValue); ?>', true);
        
        NX.admin_home_c3_gauge_ratio = <?php echo e($conversionRatio); ?>;
        NX.admin_home_c3_gauge_qulified_ratio = <?php echo e($convertedQualifiedRatio); ?>;
    </script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $('input[name="dates"]').daterangepicker();
        
        $(function() {
          $('input[id="daterange"]').daterangepicker({
            opens: 'left'
          }, function(start, end, label) {
            $('#start_date').val(start.format('YYYY-MM-DD'))
            $('#end_date').val(end.format('YYYY-MM-DD'))
            $('#filter_form').submit()
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          });
        });
        $(document).ready(function() {
            $('#date_filter').change(function() {
                let value = $(this).val()
                if(value == 'custom') {
                    $('#date_range_div').show();
                }else{
                    $('#daterange').val('')
                    $('#filter_form').submit()
                    $('#date_range_div').hide();
                }
            })
            $('#clear_filter_button').click(function() {
                var defaultUrl = window.location.href.replace(window.location.search,'');
                window.location.href = defaultUrl
            })
        })
    </script>
    </div>
    <!--main content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/home/dashboard.blade.php ENDPATH**/ ?>