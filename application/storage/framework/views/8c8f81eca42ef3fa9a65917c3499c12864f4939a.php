<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo e($data['companyName']); ?></title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">

    <!--
        web preview example
        http://example.com/invoices/29/pdf?view=preview
        <?php echo e(BASE_DIR.'/'); ?>

    -->

    <!--<?php if(request('view') == 'preview'): ?>-->
    <base href="<?php echo e($data['url']); ?>" target="_self">
    <link href="public/vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--<?php else: ?>-->
    <!--<base href="" target="_self">-->
    <!--<link href="<?php echo e(BASE_DIR); ?>/public/vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">-->
    <!--<?php endif; ?>-->

    <!-- [DYNAMIC] style sets dynamic paths to font files-->
    <style>
        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: normal;
            src: url('<?php echo e(storage_path("app/DejaVuSans.ttf")); ?>') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: 400;
            src: url('<?php echo e(storage_path("app/DejaVuSans.ttf")); ?>') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: bold;
            src: url('<?php echo e(storage_path("app/DejaVuSans-Bold.ttf")); ?>') format("truetype");
        }

        @font-face {
            font-family: 'DejaVuSans';
            font-style: normal;
            font-weight: 600;
            src: url('<?php echo e(storage_path("app/DejaVuSans-Bold.ttf")); ?>') format("truetype");
        }
        
        body {font-family: DejaVuSans !important; font-size: 20px !important;}

        @media  only screen and (max-width: 640px)  {
            .deviceWidth {width:440px!important; padding:0;}
        }
        @media  only screen and (max-width: 479px) {
            .deviceWidth {width:280px!important; padding:0;}
        }
        .text-left {text-align: right;}
        .pl-30 {padding-left: 30px;}
        .rtl .text-right {text-align: right;}
        .rtl .text-left {text-align: left !important;}
        .rtl .pl-30 {padding-left: 0; padding-right: 30px;}
    </style>



<!--<?php if(request('view') == 'preview'): ?>-->
<link href="<?php echo e($data['themecss']); ?>" rel="stylesheet">
<!--<?php else: ?>-->
<!--<link href="<?php echo e(BASE_DIR); ?>/<?php echo e(config('theme.selected_theme_pdf_css')); ?>" rel="stylesheet">-->
<!--<?php endif; ?>-->

<!--custom CSS file (DB) -->
<?php echo customDPFCSS($data['pdfCss']); ?>


</head>

<body>
    <div class="<?php echo e($bodyClass); ?>  <?php echo e($data['css']); ?> <?php echo e($page['bill_mode'] ?? ''); ?>">
        <table width="100%" cellpadding="0" cellspacing="0" align="center" style="text-align: left;font-family: 'Poppins', sans-serif;" class="<?php echo e($bodyClass); ?>">
            <tr>
                <td width="100%" valign="top" bgcolor="#fff">
                    <table width="1000" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                        <tr>
                            <td colspan="2" style="background:#fff; text-align: center;">
                                <?php if(optional($invoicecolor)->logo == null): ?>
                                    <img src="http://erjaan.erjaan.com/storage/logos/app/kgjvRTJz37JLvL61712734616.png?v=1712734634" style="height: 80px;padding: 10px 10px 10px 10px;">
                                <?php else: ?>
                                    <img src="<?php echo e(url('storage/invoice-logo/'.optional($invoicecolor)->logo)); ?>" style="height: 80px;padding: 10px 10px 10px 10px;">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 20px;"></td></tr>
                        <tr><td colspan="2" style="height: 1px; background-color: #b9c1ef;"></td></tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td style="text-align: center;">
                                <h1 style="font-family:'Poppins', sans-serif;font-size: 40px;color: #000; letter-spacing: 2px;font-weight: 900; margin: 0;">
                                    <b>
                                        <?php if($bill->bill_type == 'invoice'): ?>
                                        <?php echo e($data['invoice']); ?>

                                        <?php if($bill->bill_status == 'draft'): ?>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('draft', $bill->bill_status)); ?>" id="invoice-status-draft">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors($bill->bill_status, 'text')); ?> muted" style="color: #67757c"><?php echo e($data['draft']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status == 'due'): ?>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('due', $bill->bill_status)); ?>" id="invoice-status-due">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors($bill->bill_status, 'text')); ?>"><?php echo e($data['due']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status == 'overdue'): ?>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('overdue', $bill->bill_status)); ?>" id="invoice-status-overdue">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors($bill->bill_status, 'text')); ?>" style="color: #ff5c6c"><?php echo e($data['overdue']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status == 'paid'): ?>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('paid', $bill->bill_status)); ?>" id="invoice-status-paid">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors($bill->bill_status, 'text')); ?>" style="color: #24d2b5"><?php echo e($data['paid']); ?></span>
                                        </span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <!--ESTIMATE HEADER-->
                                        <?php if($bill->bill_type =='estimate'): ?> 
                                        <?php echo e($data['estimate']); ?> 
                                        <?php if($bill->bill_status = 'draft'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('draft', $bill->bill_status)); ?>" id="estimate-status-draft">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?> muted" style="color: #67757c"><?php echo e($data['draft']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status = 'new'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('new', $bill->bill_status)); ?>" id="estimate-status-new">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?>"><?php echo e($data['new']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status = 'accepted'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('accepted', $bill->bill_status)); ?>" id="estimate-status-accpeted">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?>" style="color: #24d2b5"><?php echo e($data['accepted']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status = 'decline'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('declined', $bill->bill_status)); ?>" id="estimate-status-declined">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?>" style="color: #ff5c6c"><?php echo e($data['declined']); ?></h1>
                                        </span>
                                        <?php elseif($bill->bill_status = 'revised'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('revised', $bill->bill_status)); ?>" id="estimate-status-revised">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?>" style="color: #6772e5"><?php echo e($data['revised']); ?></span>
                                        </span>
                                        <?php elseif($bill->bill_status = 'expired'): ?>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('expired', $bill->bill_status)); ?>" id="estimate-status-expired">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors($bill->bill_status, 'text')); ?>" style="color: #ff9041"><?php echo e($data['expired']); ?></span>
                                        </span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </b>
                                </h1>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 100%; margin:0px;padding:0 30px 0 30px;" class="text-right">
                                <p style="margin: 0px;color: #000000;font-size: 20px;">
                                    <b style="color: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>;"><?php echo e($bill->client_company_name); ?></b> <br> 
                                    <?php if($bill->client_billing_street): ?>
                                    <?php echo e($bill->client_billing_street); ?>

                                    <?php endif; ?>
                                    <?php if($bill->client_billing_city): ?>
                                    <br /> <?php echo e($bill->client_billing_city); ?>

                                    <?php endif; ?>
                                    <?php if($bill->client_billing_state): ?>
                                    <br /> <?php echo e($bill->client_billing_state); ?>

                                    <?php endif; ?>
                                    <?php if($bill->client_billing_zip): ?>
                                    <br /> <?php echo e($bill->client_billing_zip); ?>

                                    <?php endif; ?>
                                    <?php if($bill->client_billing_country): ?>
                                    <br /> <?php echo e($bill->client_billing_country); ?>

                                    <?php endif; ?>
        
                                    <!--custom fields-->
                                    <?php $__currentLoopData = $customfields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($field->customfields_show_invoice == 'yes' && $field->customfields_status == 'enabled'): ?>
                                    <?php $key = $field->customfields_name; ?>
                                    <?php $customfield = $bill[$key] ?? ''; ?>
                                    <?php if($customfield != ''): ?>
                                    <br /><?php echo e($field->customfields_title); ?>:
                                    <?php echo e(runtimeCustomFieldsFormat($customfield, $field->customfields_datatype)); ?>

                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 0 30px;">
                                <table width="100%" class="text-right">
                                    <tr>
                                        <?php if($bill->bill_type =='invoice'): ?>
                                        <td colspan="2">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo e($data['invoice']); ?> : <?php echo e($bill->formatted_bill_invoiceid); ?></p>
                                        </td>
                                        <?php endif; ?>
                                        <!--ESTIMATE HEADER-->
                                        <?php if($bill->bill_type =='estimate'): ?>
                                        <td colspan="2">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo e($data['estimate']); ?> : #<?php echo e($bill->formatted_bill_estimateid); ?></p>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if($bill->bill_type =='invoice'): ?>
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.invoice_date'); ?> : <?php echo e(runtimeDate($bill->bill_date)); ?></p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left">
                                            <p style="margin: 0px;text-align: right; color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.payments'); ?> : <?php echo _clean(runtimeMoneyFormatPDF($bill->sum_payments)); ?></p>
                                        </td>
                                        <?php endif; ?>
                                        <?php if($bill->bill_type =='estimate'): ?>
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.estimate_date'); ?> : <?php echo e(runtimeDate($bill->bill_date)); ?></p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if($bill->bill_type =='invoice'): ?>
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.due_date'); ?> : <?php echo e(runtimeDate($bill->bill_due_date)); ?></p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left">
                                            <p style="margin: 0px;text-align: right; color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.balance_due'); ?> : <?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></p>
                                        </td>
                                        <?php endif; ?>
                                        <?php if($bill->bill_type =='estimate'): ?>
                                        <td style="padding:10px 0 0 0;">
                                            <p style="margin: 0px;color: #000000;font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.expiry_date'); ?> : <?php echo e(runtimeDate($bill->bill_expiry_date)); ?></p>
                                        </td>
                                        <td style="vertical-align: bottom; padding:10px 0 0 0;" class="text-left"></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 30px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table style="width: 100%; border-collapse: collapse;" cellpadding="15px" class="text-right">
                                    <thead>
                                        <tr style="background: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>;">
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.description'))); ?></p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.qty'))); ?></p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.unit'))); ?></p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.rate'))); ?></p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.tax'))); ?></p>
                                            </td>
                                            <td style="padding:10px;vertical-align: middle;">
                                                <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 20px;line-height: 23px;"><?php echo e(cleanLang(__('lang.total'))); ?></p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="billing-items-container">
                                        <?php echo $__env->make('pages.bill.components.elements.lineitems', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </tbody>
                                </table>
                                <table style="width: 100%;">
                                    <tr style="vertical-align: top;">
                                        <td style="width:60%">
                                        <td style="padding:20px 0 0 30px; margin-right: auto;" class="text-left">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b><?php echo e(cleanLang(__('lang.subtotal'))); ?></b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b><?php echo runtimeMoneyFormatPDF($bill->bill_subtotal); ?></b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b><?php echo e(cleanLang(__('lang.discount'))); ?>

                                                                <?php if($bill->bill_discount_type == 'percentage'): ?>
                                                                <span class="x-small" id="dom-billing-discount-type">(<?php echo e($bill->bill_discount_percentage); ?>%)</span>
                                                                <?php else: ?>
                                                                <span class="x-small" id="dom-billing-discount-type">(<?php echo e(cleanLang(__('lang.fixed'))); ?>)</span>
                                                                <?php endif; ?>
                                                            </b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            - <b><?php echo runtimeMoneyFormatPDF($bill->bill_discount_amount); ?></b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:10px 0 0 0;">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b><?php echo e(cleanLang(__('lang.total'))); ?></b>
                                                        </p>
                                                    </td>
                                                    <td style="padding-top:10px;" class="pl-30">
                                                        <p style="margin: 0px;color: #000;font-size: 20px;line-height: 30px;font-weight:600;">
                                                            <b><?php echo runtimeMoneyFormatPDF($bill->bill_final_amount); ?></b>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 50px;"></td></tr>
                        <tr>
                            <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 0 30px;">
                                <table>
                                    <tr>
                                        <td class="text-right">
                                            <h4 style="margin-bottom: 5px; padding: 0 0 10px 0;"><b><?php echo e($data['terms']); ?></b></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="paddint-top: 10px;" class="text-right">
                                            <p style="margin: 5px 0;"><?php echo clean($bill->bill_terms); ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="height: 50px;"></td></tr>
                        <tr>
                            <td style="width: 100%;padding: 20px; background: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>; text-align: center;">
                                <table>
                                    <tr>
                                        <td>
                                            <p style="margin: 0px;text-align: center; color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>; font-size: 20px;font-weight: 400;"><?php echo app('translator')->get('lang.if_you_have_any_questions'); ?> info@example.com</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <p style="margin: 0;text-align: center; color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>; font-size: 20px;font-weight: 500;"><?php echo app('translator')->get('lang.thank_you_for_your_business'); ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bill/bill-pdf.blade.php ENDPATH**/ ?>