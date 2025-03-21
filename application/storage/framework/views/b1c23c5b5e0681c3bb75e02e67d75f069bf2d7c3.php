<div class="row">
    <div class="col-lg-12">
        <div class="p-b-30">

            <table class="table table-bordered payment-details">
                <tbody>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_id'))); ?></td>
                        <td>#<?php echo e($supplier->supplier_id); ?></td>
                    </tr>
                    <tr class="font-16 font-weight-600">
                            <td><?php echo e(cleanLang(__('lang.supplier_name'))); ?></td>
                            <td>
                                <?php echo e($supplier->supplier_name); ?></td>
                            </td>
                        </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_address'))); ?></td>
                        <td> <?php echo e($supplier->supplier_address); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_telephone'))); ?></td>
                        <td><?php echo e($supplier->supplier_telephone); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_category'))); ?></td>
                        <td><?php echo e($categories->firstWhere('supplier_category_id', $supplier->supplier_categoryid)->category_name ?? __('lang.not_found')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_contact_person_name'))); ?></td>
                        <td><?php echo e($supplier->supplier_contact_person_name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_contact_person_mobile'))); ?></td>
                        <td><?php echo e($supplier->supplier_contact_person_mobile); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.supplier_created_date'))); ?></td>
                        <td><?php echo e($supplier->supplier_created_date); ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/supplier/components/modals/show-supplier.blade.php ENDPATH**/ ?>