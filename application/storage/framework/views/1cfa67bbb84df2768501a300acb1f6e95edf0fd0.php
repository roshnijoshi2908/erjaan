 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <form class="form" id="settingsFormGeneral" action="<?php echo e(route('purchase.store')); ?>" method="post">
    <!--product purchase code-->
<?php echo csrf_field(); ?>
   <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.client'))); ?></label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_clientid" name="purchase_clientid">
                <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($clients->client_id); ?>">
                    <?php echo e($clients->client_company_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>


   <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.projects'))); ?></label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_projectid" name="purchase_projectid">
                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($projects->project_id); ?>">
                    <?php echo e($projects->project_title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.supplier'))); ?></label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="purchase_supplierid" name="purchase_supplierid">
                <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($suppliers->supplier_id); ?>">
                    <?php echo e($suppliers->supplier_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.request_date'))); ?></label>
        <div class="col-12">
            <input type="date" class="form-control form-control-sm" id="purchase_request_date"
                name="purchase_request_date" value="">
        </div>
    </div>

    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.purchase_items_list'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="purchase_items_list"
                name="purchase_items_list" value="">
        </div>
    </div>


     <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.costs_for_each_item'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="costs_for_each_item"
                name="costs_for_each_item" value="">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.total_cost'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="total_cost"
                name="total_cost" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.status'))); ?></label>
        <div class="col-12">
            <select class="select2 form-control form-control-sm" data-allow-clear="false" id="purchase_status" name="purchase_status">
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>            
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.pending_with'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="pending_with"
                name="pending_with" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.approved_by'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="approved_by"
                name="approved_by" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.paid'))); ?></label>
        <div class="col-12">
            <select class="select2 form-control form-control-sm" data-allow-clear="false" id="paid" name="paid">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.selected_the_bank'))); ?></label>
        <div class="col-12">
            <select id="selected_the_bank" name="selected_the_bank" class="select2-basic form-control form-control-sm">
                <?php $__currentLoopData = config('system.gateways'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($gateway); ?>"><?php echo e($gateway); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    
    <div class="text-right">
        <button type="submit" class="btn btn-rounded-x btn-danger waves-effect text-left"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
        <!--<button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left"-->
            <!--data-url="/supplier" data-loading-target="" data-ajax-type="PUT" data-type="form"-->
            <!--data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>-->
    </div>
</form>
       
            <!--proposals table-->
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/purchaseCreate.blade.php ENDPATH**/ ?>