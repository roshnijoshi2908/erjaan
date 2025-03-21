    <!-- Column -->
    <!--<div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-30 no-block">
                    <h5 class="card-title m-b-0 align-self-center"><?php echo e(cleanLang(__('lang.leads'))); ?></h5>
                    <div class="ml-auto">
                        <?php echo e(cleanLang(__('lang.this_year'))); ?>

                    </div>
                </div>
                <div id="leadsWidget"></div>
                <ul class="list-inline m-t-30 text-center font-12">
                    <?php $__currentLoopData = config('home.lead_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="p-b-10"><span class="label <?php echo e($lead_status['label']); ?> label-rounded"><i class="fa fa-circle <?php echo e($lead_status['color']); ?>"></i> <?php echo e($lead_status['title']); ?></span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>-->
    
    <!--[DYNAMIC INLINE SCRIPT]  Backend Variables to Javascript Variables-->
    <!--<script>
        NX.admin_home_c3_leads_data = JSON.parse('<?php echo _clean($payload["leads_stats"]); ?>', true);
        NX.admin_home_c3_leads_colors = JSON.parse('<?php echo _clean($payload["leads_key_colors"]); ?>', true);
        NX.admin_home_c3_leads_title = "<?php echo e($payload['leads_chart_center_title']); ?>";
    </script>-->
    <div class="col-lg-4 col-md-12">
         <div class="card bg-white">
                <div class="card-body text-center">
                    <form action="" id="filter_form">
                        <div class="row align-items-center" style="row-gap: 10px;">
                            <div class="col-lg-2 mr-auto">
                                <!--<h3 class="mb-0 text-left" style="font-weight: 400;"><?php echo app('translator')->get('lang.filter'); ?></h3>-->
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <select class="form-control text-left" name="filter" data-allow-clear="false" id="date_filter">
                                        <!--<option value="current-month"><?php echo app('translator')->get('lang.this_month'); ?></option>
                                        <option value="last-month" ><?php echo app('translator')->get('lang.last_month'); ?></option>
                                        <option value="this-year"><?php echo app('translator')->get('lang.this_year'); ?></option>
                                        <option value="last-year"><?php echo app('translator')->get('lang.last_year'); ?></option>
                                        <option value="custom"><?php echo app('translator')->get('lang.custom_date'); ?></option>-->

                                        <option value="current-month" <?php echo e(request()->get('filter') && request()->get('filter') == 'current-month' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.this_month'); ?></option>
                                        <option value="last-month" <?php echo e(request()->get('filter') == 'last-month' ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.last_month'); ?></option>
                                        <option value="this-year" <?php echo e(request()->get('filter') == 'this-year' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.this_year'); ?></option>
                                        <option value="last-year" <?php echo e(request()->get('filter') == 'last-year' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.last_year'); ?></option>
                                        <option value="custom" <?php echo e(request()->get('filter') == 'custom' ? 'selected' : ''); ?>><?php echo app('translator')->get('lang.custom_date'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" style="display: none;" id="date_range_div">
                                <div class="form-group mb-0">
                                    <input type="text" name="" id="daterange" value="" class="form-control date-range-picker text-center"/>
                                </div>
                            </div>
                            <?php if(request()->get('filter')): ?>
                            <div class="col-lg-2 col-md-4" id="clear_filter_div">
                                <div class="form-group mb-0">
                                    <button type="button" id="clear_filter_button" class="btn btn-sm btn-primary"><!--<?php echo app('translator')->get('lang.clear_filter'); ?>-->X</button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="start_date" id="start_date">
                        <input type="hidden" name="end_date" id="end_date">
                    </form>
                </div>
            </div>
            
            <div class="card bg-white card-new-design" id="category-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;"><?php echo app('translator')->get('lang.categories'); ?> (<?php echo e($payload['payload']['year'] ?? date('Y')); ?>)</h3>
                    
                    <div id="dashboardCategoryBarChart"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script>
        
 NX.admin_home_c3_category_data = JSON.parse('<?php echo _clean($payload["categoryData"]); ?>', true);
        NX.admin_home_c3_category_value = JSON.parse('<?php echo _clean($payload["categoryValue"]); ?>', true);
        
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
        </script><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/home/admin/widgets/second-row/leads.blade.php ENDPATH**/ ?>