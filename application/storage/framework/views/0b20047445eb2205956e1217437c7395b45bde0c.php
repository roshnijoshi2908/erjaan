<div class="payment-gateways" id="gateway-tap">
    <!--TAP BUTTONS-->
    <div class="x-button">
        <button class="btn btn-danger disable-on-click-loading"
            data-payload-publishable-key="<?php echo e(config('system.settings2_tap_publishable_key')); ?>"
            data-payload-language="<?php echo e(config('system.settings2_tap_language')); ?>"
            data-payload-first-name="<?php echo e($tap['first_name']); ?>"
            data-payload-last-name="<?php echo e($tap['last_name']); ?>"
            data-payload-email="<?php echo e($tap['email']); ?>"
            data-payload-phone-code="<?php echo e($tap['country_code']); ?>"
            data-payload-phone-number="<?php echo e($tap['phone']); ?>"
            data-payload-amount="<?php echo e($tap['amount']); ?>"
            data-payload-currency="<?php echo e($tap['currency']); ?>"
            data-payload-title="<?php echo e($tap['item_name']); ?>"
            data-payload-description="<?php echo e($tap['item_name']); ?>"
            data-payload-invoice-id="<?php echo e($tap['invoice_id']); ?>"
            data-payload-session-id="<?php echo e($tap['session_id']); ?>"
            data-payload-redirect-url="<?php echo e($tap['thank_you_url']); ?>"
            id="gateway-button-tap">
            <?php echo e(cleanLang(__('lang.pay_now'))); ?> -
            <?php echo e(config('system.settings2_tap_display_name')); ?></button>
    </div>
</div>

<!--tap config-->
<div id="tap-payment-container"></div>
<script src="public/js/dynamic/tap.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/pay/tap.blade.php ENDPATH**/ ?>