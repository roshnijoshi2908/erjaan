<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-purchase">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i>{{ cleanLang(__('lang.filter')) }}
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-purchase"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--client-->
                @if(config('visibility.filter_panel_client_project'))
                <div class="filter-block">
                    <div class="title">
                        {{ cleanLang(__('lang.client_name')) }}
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <select name="filter_project_clientid" id="filter_project_clientid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="{{ url('/') }}/feed/company_names"></select>
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!--client-->

                <!--assigned-->
                @if(config('visibility.filter_panel_assigned'))
                <div class="filter-block">
                    <div class="title">
                        {{ cleanLang(__('lang.assigned')) }}
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_assigned" id="filter_assigned"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <!--users list-->
                                    @foreach(config('system.team_members') as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                    <!--/#users list-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                

                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        {{ cleanLang(__('lang.status')) }}
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_purchase_status" id="filter_purchase_status"
                                    class="form-control form-control-sm select2-basic"
                                    tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status-->


                <!--supplier-->
                <div class="filter-block">
                    <div class="title">
                        {{ cleanLang(__('lang.supplier')) }}
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm"
                                    id="filter_purchase_supplier" name="filter_purchase_supplier">
                                    <option value=""></option>
                                    @foreach($supplier as $key => $suppliers)
                                        <option value="{{ $suppliers->supplier_id }}">
                                        {{ $suppliers->supplier_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--supplier -->
                
                 <!--projects-->
                    <div class="filter-block">
                        <div class="title">
                            {{ cleanLang(__('lang.project')) }}
                        </div>
                        <div class="fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2-basic form-control form-control-sm"
                                        id="filter_purchase_project" name="filter_purchase_project">
                                        <option value=""></option>
                                           @foreach($project as $key => $projects)
                                                <option value="{{ $projects->project_id }}">
                                                {{ $projects->project_title }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--projects -->
                
                <!--clients-->
                    <div class="filter-block">
                        <div class="title">
                            {{ cleanLang(__('lang.clients')) }}
                        </div>
                        <div class="fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2-basic form-control form-control-sm"
                                        id="filter_purchase_client" name="filter_purchase_client">
                                        <option value=""></option>
                                            @foreach($client as $key => $clients)
                                                <option value="{{ $clients->client_id }}">
                                                {{ $clients->client_company_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--clients -->
                
                
                <!--custom fields-->
               

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel">{{ cleanLang(__('lang.reset')) }}</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="{{ $page['source_for_filter_panels'] ?? '' }}">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="{{ urlResource('/purchase/search') }}" data-type="form"
                        data-ajax-type="GET">{{ cleanLang(__('lang.apply_filter')) }}</button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar-->