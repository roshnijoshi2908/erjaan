@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <!--include('pages.supplier.supplier.components.misc.list-page-actions')-->
        <!-- action buttons -->

    </div>
    <!--page heading-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--proposals table-->
            <form class="form" id="settingsFormGeneral" action="{{route('purchase.store')}}" method="post">
    <!--product purchase code-->
@csrf
   <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.client')) }}</label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_clientid" name="purchase_clientid">
                @foreach($client as $key => $clients)
                <option value="{{ $clients->client_id }}">
                    {{ $clients->client_company_name }}</option>
                @endforeach
            </select>
        </div>
    </div>


   <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.projects')) }}</label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_projectid" name="purchase_projectid">
                @foreach($project as $key => $projects)
                <option value="{{ $projects->project_id }}">
                    {{ $projects->project_title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier')) }}</label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_supplierid" name="purchase_supplierid">
                @foreach($supplier as $key => $suppliers)
                <option value="{{ $suppliers->supplier_id }}">
                    {{ $suppliers->supplier_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.request_date')) }}</label>
        <div class="col-12">
            <input type="date" class="form-control form-control-sm" id="purchase_request_date"
                name="purchase_request_date" value="">
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.purchase_items_list')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="purchase_items_list"
                name="purchase_items_list" value="">
        </div>
    </div>


     <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.costs_for_each_item')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="costs_for_each_item"
                name="costs_for_each_item" value="">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.total_cost')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="total_cost"
                name="total_cost" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.status')) }}</label>
        <div class="col-12">
            <select class="select2 form-control form-control-sm" data-allow-clear="false" id="purchase_status" name="purchase_status">
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>            
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.pending_with')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="pending_with"
                name="pending_with" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.approved_by')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="approved_by"
                name="approved_by" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.paid')) }}</label>
        <div class="col-12">
            <select class="select2 form-control form-control-sm" data-allow-clear="false" id="paid" name="paid">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.selected_the_bank')) }}</label>
        <div class="col-12">
            <select id="selected_the_bank" name="selected_the_bank" class="select2-basic form-control form-control-sm">
                @foreach(config('system.gateways') as $gateway)
                    <option value="{{ $gateway }}">{{ $gateway }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="text-right">
        <button type="submit" class="btn btn-rounded-x btn-danger waves-effect text-left">{{ cleanLang(__('lang.save_changes')) }}</button>
        <!--<button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left"-->
            <!--data-url="/supplier" data-loading-target="" data-ajax-type="PUT" data-type="form"-->
            <!--data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>-->
    </div>
</form>
       
            <!--proposals table-->
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
@endsection