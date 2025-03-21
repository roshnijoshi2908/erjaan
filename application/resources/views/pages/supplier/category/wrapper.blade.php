@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        @include('pages.supplier.category.components.misc.list-page-actions')
        <!-- action buttons -->

    </div>
    <!--page heading-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--proposals table-->
            @include('pages.supplier.category.components.table.wrapper')
            <!--proposals table-->
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
@endsection