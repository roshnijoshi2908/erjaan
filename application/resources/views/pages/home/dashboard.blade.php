@extends('layout.wrapper') @section('content')
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
                                <h3 class="mb-0 text-left" style="font-weight: 500;">@lang('lang.filter')</h3>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group mb-0">
                                    <select class="form-control text-left" name="filter" data-allow-clear="false" id="date_filter">
                                        <option value="current-month" {{ request()->get('filter') && request()->get('filter') == 'current-month' ? 'selected' : '' }}>@lang('lang.this_month')</option>
                                        <option value="last-month" {{ request()->get('filter') == 'last-month' ? 'selected' : '' }} >@lang('lang.last_month')</option>
                                        <option value="this-year" {{ request()->get('filter') == 'this-year' ? 'selected' : '' }}>@lang('lang.this_year')</option>
                                        <option value="last-year" {{ request()->get('filter') == 'last-year' ? 'selected' : '' }}>@lang('lang.last_year')</option>
                                        <option value="custom" {{ request()->get('filter') == 'custom' ? 'selected' : '' }}>@lang('lang.custom_date')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" style="display: {{ request()->get('filter') == 'custom' ? 'block' : 'none' }};" id="date_range_div">
                                <div class="form-group mb-0">
                                    <input type="text" name="" id="daterange" value="" class="form-control date-range-picker text-center"/>
                                </div>
                            </div>
                            @if(request()->get('filter'))
                            <div class="col-lg-2 col-md-4" id="clear_filter_div">
                                <div class="form-group mb-0">
                                    <button type="button" id="clear_filter_button" class="btn btn-sm btn-primary">@lang('lang.clear_filter')</button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <input type="hidden" name="start_date" id="start_date">
                        <input type="hidden" name="end_date" id="end_date">
                    </form>
                </div>
            </div>
        </div>
        @foreach($statuses as $status)
        <div class="col-3">
            <div class="card bg-white top-card-design {{ runtimeKanbanBoardColors($status->leadstatus_color) }}" id="contracts-table-wrapper">
                <div class="card-body text-center">
                    <h4 class="font-bold">{{$statusCount[$status->leadstatus_id] ?? 0 }}</h4>
                    <p class="mb-0">{{ $status->leadstatus_title }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card bg-white card-new-design">
                <div class="card-body">
                    <h3 class="mb-4" style="font-weight: 500;">@lang('lang.top_in_new_leads')</h3>
                    <div class="d-flex align-items-center" style="flex-wrap: wrap; gap: 25px 50px;">
                        @foreach($leadTop3 as $key => $topLead)
                        <div class="person-card">
                            <span>{{ $key + 1 }}</span>
                            <div class="person mx-auto">
                                <img src="{{ $topLead->creator?->avatar }}" alt="img">
                            </div>
                            <h3 class="mb-0">{{ $topLead->lead_count }}</h3>
                            <p class="mb-0">{{ $topLead->creator?->first_name .' '. $topLead->creator?->last_name }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-white card-new-design">
                <div class="card-body">
                    <h3 class="mb-4" style="font-weight: 500;">@lang('lang.top_in_revenue')</h3>
                    <div class="d-flex align-items-center" style="flex-wrap: wrap; gap: 25px 50px;">
                        @foreach($top3Revenues as $key => $topLead)
                        <div class="person-card">
                            <span>{{ $key + 1 }}</span>
                            <div class="person mx-auto">
                                <img src="{{ $topLead->creator?->avatar }}" alt="img">
                            </div>
                            <h3 class="mb-0">${{ $topLead->total_lead_value }}</h3>
                            <p class="mb-0">{{ $topLead->creator?->first_name .' '. $topLead->creator?->last_name }}</p>
                        </div>
                        @endforeach
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
                    <h3 class="mb-3" style="font-weight: 500;">@lang('lang.all_activities')</h3>
                    <div class="table-responsive list-table-wrapper new-table-design">
                        <table id="contracts-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contract-list all-activities"
                            data-page-size="10">
                            <thead>
                                <tr>
                                    <!--doc_id-->
                                    <th class="col_doc_id"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_id"
                                        href="javascript:void(0)"
                                        >@lang('lang.id')<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>
            
                                    <!--doc_title-->
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_title"
                                        href="javascript:void(0)"
                                       >@lang('lang.title')<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>
                                    <!--doc_title-->
                                    <!--<th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_title"
                                        href="javascript:void(0)"
                                       >Sales Person Name<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                                    </th>-->
                                    @foreach($statuses as $status)
                                    <th class="col_client"><a class="js-ajax-ux-request js-list-sorting" 
                                        data-url="{{ urlResource('/contracts?action=sort&orderby=client&sortorder=asc') }}">{{ $status['leadstatus_title'] }}
                                        </a>
                                    </th>
                                    @endforeach
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_leads"
                                        href="javascript:void(0)"
                                       >@lang('lang.total_number_leads')</a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_number_converted_leads"
                                        href="javascript:void(0)"
                                       >@lang('lang.total_number_of_leads_converted')</a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_conversion_ratio"
                                        href="javascript:void(0)"
                                       >@lang('lang.conversion_ratio')</a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_total_amount_of_revenue"
                                        href="javascript:void(0)"
                                       >@lang('lang.total_amount_of_revenue')</a>
                                    </th>
                                    <th class="col_doc_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_doc_target_revenue"
                                        href="javascript:void(0)"
                                       >@lang('lang.target_revenue')</a>
                                    </th>
                                </tr>
                            </thead>
                            <!--<tbody>
                                @foreach($leads as $lead)
                                @php
                                $totalLeads = 0;
                                $totalConvertedLeads = 0;
                                $totalRevenue = 0;
                                @endphp
                                    <tr>
                                        <td>{{$lead->lead_id}}</td>
                                        <td>{{ str_limit($lead->full_name, 15) }}</td>
                                        
                                        @foreach($statuses as $status)
                                            <td>
                                                @if($lead->lead_status == $status->leadstatus_id)
                                                @php
                                                $totalLeads += $statusCount[$status->leadstatus_id] ?? 0;
                                                if($status->leadstatus_title === 'Converted') {
                                                    $totalConvertedLeads += $statusCount[$status->leadstatus_id] ?? 0;
                                                }
                                                @endphp
                                                     {{$statusCount[$status->leadstatus_id] ?? 0 }} 
                                                @else
                                                0
                                                @endif
                                            </td>
                                        @endforeach
                                        <td>
                                            {{ $totalLeads }}
                                        </td>
                                        <td>
                                            {{ $totalConvertedLeads }}
                                        </td>
                                        <td>
                                            {{ number_format(($totalConvertedLeads / $leads->count()) * 100, 2) }} %
                                        </td>
                                        <td>
                                            {{ $lead->lead_value }} 
                                        </td>
                                        <td>
                                            {{ $lead->creator?->target_revenue ?? 0 }} 
                                        </td>
                                    </tr>
                                
                                @endforeach
                            </tbody>-->
                            
                            <tbody>
                                @foreach($payload['salesPersons'] as $salesPerson)
                                @php
                               
                               
                                $totalLeads = $salesPerson->assignedLeads->count();
                                $totalRevenue = 0;
                                $totalLeadValue = $salesPerson->assignedLeads->where('lead_converted', 'yes')->sum('lead_value');
                                $totalConvertedLeads = $salesPerson->assignedLeads->where('lead_converted', 'yes')->count();
                                @endphp
                                    <tr>
                                        <td>{{$salesPerson->id}}</td>
                                        <td>
                                            
                                            
                                            <img src="{{ getUsersAvatar($salesPerson->avatar_directory, $salesPerson->avatar_filename) }}" alt="user"
                                                class="img-circle avatar-xsmall">
                                            <span>{{ str_limit($salesPerson->first_name . ' ' . $salesPerson->last_name, 15) }}</span>
                                        </td>

                                        @foreach($statuses as $status)
                                            <td>
                                                @php
                                                $count = 0 ;
                                                $count = $salesPerson->assignedLeads
                                                    ->where('lead_status', $status->leadstatus_id)->count();
                                                @endphp
                                                     {{$count ?? 0 }} 
                                            </td>
                                        @endforeach
                                        <td>
                                            {{ $totalLeads }}
                                        </td>
                                        <td>
                                            {{ $totalConvertedLeads }}
                                        </td>
                                        <td>
                                            {{ ($totalLeads != 0) ? number_format(($totalConvertedLeads / $totalLeads) * 100, 2) : 0.00 }} %
                                        </td>
                                        <td>
                                            {{ $totalLeadValue }} 
                                        </td>
                                        <td>
                                            {{ $salesPerson->target_revenue ?? 0 }} 
                                        </td>
                                    </tr>
                                @endforeach
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
                    <h3 class="mb-3" style="font-weight: 500;">@lang('lang.leads')</h3>
                    <div id="dashboardWidget"></div>
                    <ul class="list-inline m-t-30 text-center font-12">
                     @foreach($statuses as $status)
                     <li class="p-b-10"><span class="label label-{{ $status['leadstatus_color'] }} label-rounded"><i class="fa fa-circle {{ $status['leadstatus_color'] }}"></i> {{ $status['leadstatus_title'] }} {{$statusCount[$status->leadstatus_id] ?? 0 }}
                                </span></li>
                    @endforeach
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
                        <span class="label label-info">@lang('lang.new_to_convert_ratio')</span>
                    </div>
                </div>
            </div>
            <div class="card bg-white card-new-design" id="contracts-table-wrapper">
                <div class="card-body">
                    <!--<h3 class="mb-3" style="font-weight: 500;">Leads</h3>-->
                    <div id=gaugeWidget1></div>
                    <div class="mt-4 text-center">
                        <span class="label label-info">@lang('lang.qualified_to_convert_ratio')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="category-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;">@lang('lang.categories') ({{$payload['payload']['year'] ?? date('Y') }})</h3>
                    <div id="dashboardCategoryBarChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white card-new-design" id="lead-source-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;">@lang('lang.lead_sources') ({{$payload['payload']['year'] ?? date('Y') }})</h3>
                    <div id="dashboardLeadSourceBarChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card bg-white card-new-design" id="lead-source-bar-div">
                <div class="card-body">
                    <h3 class="mb-3" style="font-weight: 500;">@lang('lang.leads_converted') ({{$payload['payload']['year'] ?? date('Y') }})</h3>
                    <div id="dashboardLeadsConvertedBarChart"></div>
                </div>
            </div>
        </div>
    
    </div>
         <!--[DYNAMIC INLINE SCRIPT]  Backend Variables to Javascript Variables-->
    <script>
        NX.admin_home_c3_leads_data = JSON.parse('{!! _clean($payload['payload']["leads_stats"]) !!}', true);
        NX.admin_home_c3_leads_colors = JSON.parse('{!! _clean($payload['payload']["leads_key_colors"]) !!}', true);
        NX.admin_home_c3_leads_title = "{{ $payload['payload']['leads_chart_center_title'] }}";
        
        // category data
        NX.admin_home_c3_category_data = JSON.parse('{!! _clean($categoryData) !!}', true);
        NX.admin_home_c3_category_value = JSON.parse('{!! _clean($categoryValue) !!}', true);
        
        // lead source data
        NX.admin_home_c3_lead_source_data = JSON.parse('{!! _clean($leadSourceData) !!}', true);
        NX.admin_home_c3_lead_source_value = JSON.parse('{!! _clean($leadSourceValue) !!}', true);
        
        // leads converted data
        NX.admin_home_c3_leads_converted_data = JSON.parse('{!! _clean($leadsData) !!}', true);
        NX.admin_home_c3_leads_converted_value = JSON.parse('{!! _clean($leadsValue) !!}', true);
        
        NX.admin_home_c3_gauge_ratio = {{$conversionRatio}};
        NX.admin_home_c3_gauge_qulified_ratio = {{$convertedQualifiedRatio}};
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
@endsection
