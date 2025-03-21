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
            <form class="form" id="settingsFormGeneral" action="{{route('supplier.store')}}" method="post">
    <!--product purchase code-->
@csrf
   <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.supplier_name')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="supplier_name"
                name="supplier_name" value="">
        </div>
    </div>


   <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier_address')) }}</label>
        <div class="col-12">
             <textarea class="form-control form-control-sm" rows="10" name="supplier_address"
                id="supplier_address"></textarea>
            <!--<input type="text" class="form-control form-control-sm" id="supplier_address"-->
            <!--    name="supplier_address" value="">-->
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier_telephone')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="supplier_telephone"
                name="supplier_telephone" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier_category')) }}</label>
        <div class="col-12">
             <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="supplier_categoryid" name="supplier_categoryid">
                @foreach($categories as $key => $category)
                <option value="{{ $category->supplier_category_id }}">
                    {{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier_contact_person_name')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="supplier_contact_person_name"
                name="supplier_contact_person_name" value="">
        </div>
    </div>


     <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left">{{ cleanLang(__('lang.supplier_contact_person_mobile')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="supplier_contact_person_mobile"
                name="supplier_contact_person_mobile" value="">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.supplier_created_date')) }}</label>
        <div class="col-12">
            <input type="date" class="form-control form-control-sm" id="supplier_created_date"
                name="supplier_created_date"
                value="">
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