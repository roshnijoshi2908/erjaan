<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="payment_<?php echo e($payment->proof_id); ?>">
    <!--proof_date-->
    <td class="col_proof_date">
        <?php echo e(runtimeDate($payment->proof_date)); ?>

    </td>

    <!--tenant_name-->
    <td class="col_tenant_name">
        <a href="<?php echo e(url('app-admin/customers/'.$payment->proof_tenant_id)); ?>"><?php echo e($payment->tenant_name); ?></a>
    </td>

    <!--tenant_domain-->
    <td class="col_tenant_domain">
        <a href="https://<?php echo e($payment->domain); ?>"><?php echo e($payment->domain); ?></a>
    </td>

    <!--proof_amount-->
    <td class="col_proof_amount">
        <?php echo e(runtimeMoneyFormat($payment->proof_amount)); ?>

    </td>
    <!--proof_filename-->
    <td class="col_proof_filename">
        <a href="storage/files/<?php echo e($payment->proof_directory); ?>/<?php echo e($payment->proof_filename); ?>" target="_blank"
            download><?php echo e(str_limit($payment->proof_filename ?? '---', 20)); ?></a>
    </td>
    <!--actions-->
    <td class="payments_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete_payment'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(url('/app-admin/offline-payments/'.$payment->proof_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/offlinepayments/table/ajax.blade.php ENDPATH**/ ?>