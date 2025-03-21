<!--offline payment details -->
<div id="offline_payment_details">

    <?php echo _clean($landlord_settings->settings_offline_payments_details); ?>


</div>


<div class="modal-selector m-t-40" id="proof_of_payment_container">

    <div class="m-b-30"><?php echo _clean($landlord_settings->settings_offline_proof_of_payment_message); ?></div>

    <!--fileupload-->
    <div class="form-group row">
        <div class="col-12">
            <div class="dropzone dz-clickable" id="fileupload_proof_of_payment"
            data-upload-url="<?php echo e(url('settings/account/proof-of-payment')); ?>">
                <div class="dz-default dz-message">
                    <i class="icon-Upload-toCloud"></i>
                    <span><?php echo app('translator')->get('lang.attach_proof_of_payment'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <!--fileupload-->
</div>


<div class="modal-selector m-t-40 p-t-60 p-b-60 text-center hidden" id="proof_of_payment_thankyou">

    <?php echo _clean($landlord_settings->settings_offline_proof_of_payment_thank_you); ?>


</div>

<!--GENERAL CHECKOUT JS-->
<script src="public/js/landlord/frontend/offline.js?v=<?php echo e(config('system.versioning')); ?>"></script><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/account/pay/buttons/offline.blade.php ENDPATH**/ ?>