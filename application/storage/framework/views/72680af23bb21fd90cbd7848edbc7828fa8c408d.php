<div class="row">
    <style>
        .loading:after{
            display:none;
        }
    </style>
    <div class="col-lg-12">
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
                            <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="purchase_request_date"
                                value="" style="width: 100%;">
                            <input class="mysql-date" type="hidden" name="purchase_request_date" id="purchase_request_date"
                                value="">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.purchase_items_list'))); ?> 
                            <button type="button" class="btn btn-outline-primary btn-circle btn-sm ml-2" id="addRow"><i class="ti-plus"></i></button>
                        </label> 
                   
                        <div class="col-12">
                            <table class="table table-bordered" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th><?php echo e(cleanLang(__('lang.description'))); ?></th>
                                        <th><?php echo e(cleanLang(__('lang.qty'))); ?></th>
                                        <th><?php echo e(cleanLang(__('lang.unit_price'))); ?>e</th>
                                        <th><?php echo e(cleanLang(__('lang.total'))); ?></th>
                                        <th><?php echo e(cleanLang(__('lang.action'))); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseTableBody">
                                    <tr id="0">
                                        <td><input type="text" name="description[0]" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="quantity[0]" class="form-control form-control-sm qty" min="1" value="1"></td>
                                        <td><input type="number" name="unit_price[0]" class="form-control form-control-sm unit-price" min="0" step="0.01"></td>
                                        <td><input type="text" class="form-control form-control-sm total" readonly></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.total_cost'))); ?></label>
                        <div class="col-12">
                            <input type="text" class="form-control form-control-sm" id="grandTotal" readonly>
                        </div>
                    </div>
                        
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.paid'))); ?></label>-->
                    <!--    <div class="col-12">-->
                    <!--        <select class="select2 form-control form-control-sm" data-allow-clear="false" id="paid" name="paid">-->
                    <!--            <option value="1">Yes</option>-->
                    <!--            <option value="0">No</option>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.selected_the_bank'))); ?></label>-->
                    <!--    <div class="col-12">-->
                    <!--        <select id="selected_the_bank" name="selected_the_bank" class="select2-basic form-control form-control-sm">-->
                    <!--            <?php $__currentLoopData = config('system.gateways'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                    <!--                <option value="<?php echo e($gateway); ?>"><?php echo e($gateway); ?></option>-->
                    <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                </form>
            </div>
    
        </div>
    </div>
</div>

<script>
$( document ).ready(function() {
    let rowCounter = 1; 

    function calculateTotals() {
        let grandTotal = 0;

        $('#purchaseTableBody tr').each(function() {
            const qty = parseFloat($(this).find('.qty').val()) || 0;
            const unitPrice = parseFloat($(this).find('.unit-price').val()) || 0;
            const total = qty * unitPrice;

            $(this).find('.total').val(total.toFixed(2));
            grandTotal += total;
        });

        $('#grandTotal').val(grandTotal.toFixed(2));
    }

    $('#addRow').click(function() {
        const newRow = `
            <tr rowid="${rowCounter}"> 
                <td><input type="text" name="description[${rowCounter}]" class="form-control form-control-sm"></td>
                <td><input type="number" name="quantity[${rowCounter}]" class="form-control form-control-sm qty" min="1" value="1"></td>
                <td><input type="number" name="unit_price[${rowCounter}]" class="form-control form-control-sm unit-price" min="0" step="0.01"></td>
                <td><input type="text" class="form-control form-control-sm total" readonly></td>
                <td><button type="button" class="btn btn-outline-danger  btn-sm remove-row"><i class="sl-icon-trash"></i></button></td>
            </tr>
        `;
        $('#purchaseTableBody').append(newRow);
        rowCounter++; 
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    $(document).on('input', '.qty, .unit-price', function() {
        calculateTotals();
    });
})
</script>


<?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>