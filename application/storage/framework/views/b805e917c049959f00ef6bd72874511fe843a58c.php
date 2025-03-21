<div id="bill-form-container">
    <div class="card card-body invoice-wrapper box-shadow" id="invoice-wrapper">
        <div class="row">
            <!--ADDRESSES-->
            <table width="100%" cellpadding="0" cellspacing="0" align="center" style="text-align: left;font-family: 'Poppins', sans-serif;>
                <tr>
                    <td width="100%" valign="top">
                        <table width="1000" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                            <tr style="border-bottom: 1px solid #b9c1ef;">
                                <td colspan="2" style="text-align: center;">
                                <?php if(optional($invoicecolor)->logo == null): ?>
                                    <img src="http://erjaan.erjaan.com/storage/logos/app/kgjvRTJz37JLvL61712734616.png?v=1712734634" style="height: 80px;padding: 10px 10px 10px 10px;">
                                <?php else: ?>
                                    <img src="<?php echo e(url('storage/invoice-logo/'.optional($invoicecolor)->logo)); ?>" style="height: 80px;padding: 10px 10px 10px 10px;">
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <h1 style="font-family:'Poppins', sans-serif;font-size: 30px;color: #000; letter-spacing: 2px;font-weight: 900;padding-bottom: 10px; margin: 0;padding-top: 20px;">
                                        <?php if($bill->bill_type =='invoice'): ?>
                                        <?php echo e(cleanLang(__('lang.invoice'))); ?>

                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('draft', $bill->bill_status)); ?>" id="invoice-status-draft">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors('draft', 'text')); ?> muted"><?php echo e(cleanLang(__('lang.draft'))); ?></span>
                                        </span>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('due', $bill->bill_status)); ?>" id="invoice-status-due">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors('due', 'text')); ?>"><?php echo e(cleanLang(__('lang.due'))); ?></span>
                                        </span>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('overdue', $bill->bill_status)); ?>" id="invoice-status-overdue">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors('overdue', 'text')); ?>"><?php echo e(cleanLang(__('lang.overdue'))); ?></span>
                                        </span>
                                        <span class="js-invoice-statuses <?php echo e(runtimeInvoiceStatus('paid', $bill->bill_status)); ?>" id="invoice-status-paid">
                                            | <span class="<?php echo e(runtimeInvoiceStatusColors('paid', 'text')); ?>"><?php echo e(cleanLang(__('lang.paid'))); ?></span>
                                        </span>
                                        <?php endif; ?>
                                        <!--ESTIMATE HEADER-->
                                        <?php if($bill->bill_type =='estimate'): ?> 
                                        <?php echo e(cleanLang(__('lang.estimate'))); ?> 
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('draft', $bill->bill_status)); ?>" id="estimate-status-draft">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('draft', 'text')); ?> muted"><?php echo e(cleanLang(__('lang.draft'))); ?></span>
                                        </span>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('new', $bill->bill_status)); ?>" id="estimate-status-new">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('new', 'text')); ?>"><?php echo e(cleanLang(__('lang.new'))); ?></span>
                                        </span>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('accepted', $bill->bill_status)); ?>" id="estimate-status-accpeted">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('accepted', 'text')); ?>"><?php echo e(cleanLang(__('lang.accepted'))); ?></span>
                                        </span>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('declined', $bill->bill_status)); ?>" id="estimate-status-declined">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('declined', 'text')); ?>"><?php echo e(cleanLang(__('lang.declined'))); ?></h1>
                                        </span>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('revised', $bill->bill_status)); ?>" id="estimate-status-revised">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('revised', 'text')); ?>"><?php echo e(cleanLang(__('lang.revised'))); ?></span>
                                        </span>
                                        <span class="js-estimate-statuses <?php echo e(runtimeEstimateStatus('expired', $bill->bill_status)); ?>" id="estimate-status-expired">
                                            | <span class="text-uppercase <?php echo e(runtimeEstimateStatusColors('expired', 'text')); ?>"><?php echo e(cleanLang(__('lang.expired'))); ?></span>
                                        </span>
                                        <?php endif; ?>
                                    </h1>
                                    <p style="color: #000; margin: 0;padding-bottom: 30px;">
                                        <?php if(config('system.settings_estimates_show_view_status') == 'yes' && (auth()->check() && auth()->user()->is_team) &&
                                            $bill->bill_status != 'draft' && $bill->bill_status != 'paid'): ?>
                                            <?php if($bill->bill_viewed_by_client == 'no'): ?>
                                            <span class="label label-light-inverse text-lc font-normal"><?php echo app('translator')->get('lang.client_has_not_opened'); ?></span>
                                            <?php endif; ?>
                                            <?php if($bill->bill_viewed_by_client == 'yes'): ?>
                                            <span class="label label label-lighter-info text-lc font-normal"><?php echo app('translator')->get('lang.client_has_opened'); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%; margin:0px;padding:0 30px 0 30px;">
                                    <p style="margin: 0px;color: #000000;font-size: 15px;">
                                        <span style="font-weight: 600; color: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>;"><?php echo e($bill->client_company_name); ?></span> <br> 
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
                                <td style="width: 100%; margin:0px;padding:0 30px 0 30px;" class="text-right">
                                    <p style="margin: 0px;color: #000000;font-size: 15px;">
                                        <span style="font-weight: 600; color: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>"><?php echo e(config('system.settings_company_name')); ?></span> <br> 
                                        <?php if(config('system.settings_company_address_line_1')): ?>
                                        <?php echo e(config('system.settings_company_address_line_1')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_city')): ?>
                                        <br /> <?php echo e(config('system.settings_company_city')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_state')): ?>
                                        <br /><?php echo e(config('system.settings_company_state')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_zipcode')): ?>
                                        <br /> <?php echo e(config('system.settings_company_zipcode')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_country')): ?>
                                        <br /> <?php echo e(config('system.settings_company_country')); ?>

                                        <?php endif; ?>
            
                                        <!--custom company fields-->
                                        <?php if(config('system.settings_company_customfield_1') != ''): ?>
                                        <br /> <?php echo e(config('system.settings_company_customfield_1')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_customfield_2') != ''): ?>
                                        <br /> <?php echo e(config('system.settings_company_customfield_2')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_customfield_3') != ''): ?>
                                        <br /> <?php echo e(config('system.settings_company_customfield_3')); ?>

                                        <?php endif; ?>
                                        <?php if(config('system.settings_company_customfield_4') != ''): ?>
                                        <br /> <?php echo e(config('system.settings_company_customfield_4')); ?>

                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr><td colspan="2" style="height: 30px;"></td></tr>
                            <tr>
                                <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 0 30px;">
                                    <?php if($bill->bill_type == 'invoice'): ?>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;"><?php echo app('translator')->get('lang.invoice_no'); ?> : #<?php echo e($bill->formatted_bill_invoiceid); ?></p>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.invoice_date'); ?> : 
                                                    <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                                        <input type="text" class="form-control form-control-xs pickadate w-auto" name="bill_date" autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_date)); ?>">
                                                        <input class="mysql-date w-auto" type="hidden" name="bill_date" id="bill_date" value="<?php echo e($bill->bill_date); ?>">
                                                    <?php else: ?>
                                                        <?php echo e(runtimeDate($bill->bill_date)); ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.due_date'); ?> : 
                                                    <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                                        <input type="text" class="form-control form-control-xs pickadate w-auto" name="bill_due_date" autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_due_date)); ?>">
                                                        <input class="mysql-date w-auto" type="hidden" name="bill_due_date" id="bill_due_date" value="<?php echo e($bill->bill_due_date); ?>">
                                                    <?php else: ?>
                                                        <?php echo e(runtimeDate($bill->bill_due_date)); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </td>
                                            <td style="vertical-align: bottom;">
                                                <p style="margin: 0px;text-align: end; color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.payments'); ?> : 
                                                    <?php if($bill->sum_payments > 0): ?>
                                                        <a href="javascript:void(0)" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                                                            data-toggle="modal" data-target="#commonModal" data-footer-visibility="hidden"
                                                            data-url="<?php echo e(urlResource('/payments?action=invoice-payments-modal&paymentresource_type=invoice&paymentresource_id='.$bill->bill_invoiceid)); ?>"
                                                            data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.payments'))); ?>"
                                                            data-modal-size="modal-lg">
                                                                <span><?php echo _clean(runtimeMoneyFormatPDF($bill->sum_payments)); ?></span>
                                                        </a>
                                                    <?php else: ?>
                                                       <?php echo _clean(runtimeMoneyFormatPDF(0.00)); ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p style="margin: 0px;text-align: end; color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.balance_due'); ?> : 
                                                    <?php if($bill->invoice_balance > 0): ?>
                                                        <label class="mb-0" id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                                                    <?php else: ?>
                                                        <label class="mb-0" id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                                                    <?php endif; ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php endif; ?>
                                    <?php if($bill->bill_type == 'estimate'): ?>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;"><?php echo app('translator')->get('lang.estimate_no'); ?> : #<?php echo e($bill->formatted_bill_estimateid); ?></p>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.estimate_date'); ?> : 
                                                   <?php if($data['bill_mode'] == 'editing'): ?>
                                                        <input type="text" class="form-control form-control-xs pickadate w-auto" name="bill_date" autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_date)); ?>">
                                                        <input class="mysql-date w-auto" type="hidden" name="bill_date" id="bill_date" value="<?php echo e($bill->bill_date); ?>">
                                                    <?php else: ?>
                                                        <?php echo e(runtimeDate($bill->bill_date)); ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p style="margin: 0px;color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.expiry_date'); ?> : 
                                                    <?php if($data['bill_mode'] == 'editing'): ?>
                                                        <input type="text" class="form-control form-control-xs pickadate w-auto" name="bill_expiry_date" autocomplete="off" value="<?php echo e(runtimeDate($bill->bill_expiry_date)); ?>">
                                                        <input class="mysql-date w-auto" type="hidden" name="bill_expiry_date" id="bill_expiry_date" value="<?php echo e($bill->bill_expiry_date); ?>">
                                                    <?php else: ?>
                                                        <?php echo e(runtimeDate($bill->bill_expiry_date)); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </td>
                                            <td style="vertical-align: bottom;">
                                                <p style="margin: 0px;text-align: end; color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.payments'); ?> : 
                                                    <?php if($bill->sum_payments > 0): ?>
                                                        <a href="javascript:void(0)" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                                                            data-toggle="modal" data-target="#commonModal" data-footer-visibility="hidden"
                                                            data-url="<?php echo e(urlResource('/payments?action=invoice-payments-modal&paymentresource_type=invoice&paymentresource_id='.$bill->bill_invoiceid)); ?>"
                                                            data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.payments'))); ?>"
                                                            data-modal-size="modal-lg">
                                                                <span><?php echo _clean(runtimeMoneyFormatPDF($bill->sum_payments)); ?></span>
                                                        </a>
                                                    <?php else: ?>
                                                       <?php echo _clean(runtimeMoneyFormatPDF(0.00)); ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p style="margin: 0px;text-align: end; color: #000000;font-size: 15px;font-weight: 400; padding-bottom:5px;">
                                                    <?php echo app('translator')->get('lang.balance_due'); ?> : 
                                                    <?php if($bill->invoice_balance > 0): ?>
                                                        <label class="mb-0" id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                                                    <?php else: ?>
                                                        <label class="mb-0" id="billing-details-amount-due"><?php echo _clean(runtimeMoneyFormatPDF($bill->invoice_balance)); ?></label>
                                                    <?php endif; ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr><td colspan="2" style="height: 30px;"></td></tr>
                            <tr>
                                <td colspan="2" style="width: 100%;">
                                    <table style="width: 100%;" class="<?php echo e(config('css.bill_mode')); ?>">
                                        <thead>
                                            <tr style="background: <?php echo e(optional($invoicecolor)->color_code ?? '#000'); ?>;">
                                                <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                                <td style="padding:10px;vertical-align: middle;">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"></p>
                                                </td>
                                                <?php endif; ?>
                                                <td style="padding:10px;vertical-align: middle;">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.description'))); ?></p>
                                                </td>
                                                <td style="padding:10px;vertical-align: middle;">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.qty'))); ?></p>
                                                </td>
                                                <td style="padding:10px;vertical-align: middle;">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.unit'))); ?></p>
                                                </td>
                                                <td style="padding:10px;vertical-align: middle;">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.rate'))); ?></p>
                                                </td>
                                                <td style="padding:10px;vertical-align: middle;" class="<?php echo e(runtimeVisibility('invoice-column-inline-tax', $bill->bill_tax_type)); ?>">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.tax'))); ?></p>
                                                </td>
                                                <td style="padding:10px;vertical-align: middle;text-align: end;" id="bill_col_total">
                                                    <p style="margin: 0px;color: <?php echo e(optional($invoicecolor)->text_color_code ?? '#fff'); ?>;font-size: 14px;line-height: 23px;"><?php echo e(cleanLang(__('lang.total'))); ?></p>
                                                </td>
                                            </tr>
                                        </thead>
                                        <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                            <tbody id="billing-items-container" class="billing-items-container-editing">
                                                <?php $__currentLoopData = $lineitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lineitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <!--plain line-->
                                                <?php if($lineitem->lineitem_type == 'plain'): ?>
                                                <?php echo $__env->make('pages.bill.components.elements.line-plain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                
                                                <!--estimation notes-->
                                                <?php if($lineitem->item_notes_estimatation != ''): ?>
                                                <?php echo $__env->make('pages.bill.components.elements.line-estimation-notes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                
                                                <!--time line-->
                                                <?php if($lineitem->lineitem_type == 'time'): ?>
                                                <?php echo $__env->make('pages.bill.components.elements.line-time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                
                                                <!--dimensions line-->
                                                <?php if($lineitem->lineitem_type == 'dimensions'): ?>
                                                <?php echo $__env->make('pages.bill.components.elements.line-dimensions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        <?php else: ?>
                                            <tbody id="billing-items-container">
                                                <?php echo $__env->make('pages.bill.components.elements.lineitems', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                     <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                        <?php echo $__env->make('pages.bill.components.misc.add-line-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                    
                                    <!-- TOTAL & SUMMARY -->
                                    <div style="padding: 0 20px">
                                        <?php echo $__env->make('pages.bill.components.elements.totals-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                        
                                    <!-- TAXES & DISCOUNTS -->
                                    <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                    <?php echo $__env->make('pages.bill.components.elements.taxes-discounts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                            <tr><td colspan="2" style="height: 50px;"></td></tr>
                            <tr>
                                <td colspan="2" style="width: 50%; margin:0px;padding:0 30px 20px 30px;">
                                    <!--[VIEWING] INVOICE TERMS & MAKE PAYMENT BUTTON-->
                                    <?php if(config('visibility.bill_mode') == 'viewing'): ?>
                                    <div class="billing-mode-only-item">
                                        <!--invoice terms-->
                                        <div class="text-left">
                                            <?php if($bill->bill_type == 'invoice'): ?>
                                            <h4><?php echo e(cleanLang(__('lang.invoice_terms'))); ?></h4>
                                            <?php else: ?>
                                            <h4><?php echo e(cleanLang(__('lang.estimate_terms'))); ?></h4>
                                            <?php endif; ?>
                                            <div id="invoice-terms"><?php echo clean($bill->bill_terms); ?></div>
                                        </div>
                                        <!--client - make a payment button-->
                                        <?php if((auth()->check() && auth()->user()->is_client) || config('visibility.public_bill_viewing')): ?>
                                        <hr>
                                        <div class="p-t-25 invoice-pay" id="invoice-buttons-container">
                                            <div class="text-right">
                                                <!--[invoice] download pdf-->
                                                <span>
                                                    <?php if($bill->bill_type == 'invoice'): ?>
                                                    <a class="btn btn-secondary btn-outline"
                                                        href="<?php echo e(url('/invoices/'.$bill->bill_invoiceid.'/pdf')); ?>" download>
                                                        <span><i class="mdi mdi-download"></i> <?php echo e(cleanLang(__('lang.download'))); ?></span> </a>
                                                    <?php else: ?>
                                                    <!--[estimate] download pdf-->
                                                    <a class="btn btn-secondary btn-outline"
                                                        href="<?php echo e(url('/estimates/view/'.$bill->bill_uniqueid.'/pdf')); ?>">
                                                        <span><i class="mdi mdi-download"></i> <?php echo e(cleanLang(__('lang.download'))); ?></span> </a>
                                                    <?php endif; ?>
                                                </span>
                        
                                                <!--[invoice] - make payment-->
                                                <?php if($bill->bill_type == 'invoice' && $bill->invoice_balance > 0): ?>
                                                <button class="btn btn-danger" id="invoice-make-payment-button">
                                                    <?php echo e(cleanLang(__('lang.make_a_payment'))); ?> </button>
                                                <?php endif; ?>
                        
                                                <!--accept or decline-->
                                                <?php if(in_array($bill->bill_status, ['new', 'revised'])): ?>
                                                <!--decline-->
                                                <button class="buttons-accept-decline btn btn-danger confirm-action-danger"
                                                    data-confirm-title="<?php echo e(cleanLang(__('lang.decline_estimate'))); ?>"
                                                    data-confirm-text="<?php echo e(cleanLang(__('lang.decline_estimate_confirm'))); ?>"
                                                    data-ajax-type="GET"
                                                    data-url="<?php echo e(url('/')); ?>/estimates/<?php echo e($bill->bill_uniqueid); ?>/decline">
                                                    <?php echo e(cleanLang(__('lang.decline_estimate'))); ?> </button>
                                                <!--accept-->
                                                <button class="buttons-accept-decline btn btn-success confirm-action-success"
                                                    data-confirm-title="<?php echo e(cleanLang(__('lang.accept_estimate'))); ?>"
                                                    data-confirm-text="<?php echo e(cleanLang(__('lang.accept_estimate_confirm'))); ?>" data-ajax-type="GET"
                                                    data-url="<?php echo e(url('/')); ?>/estimates/<?php echo e($bill->bill_uniqueid); ?>/accept">
                                                    <?php echo e(cleanLang(__('lang.accept_estimate'))); ?> </button>
                                                <?php endif; ?>
                        
                        
                                            </div>
                                            <?php endif; ?>
                        
                                        </div>
                                        <!--payment buttons-->
                                        <?php echo $__env->make('pages.pay.buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                        
                                            <!--[EDITING] INVOICE TERMS & MAKE PAYMENT BUTTON-->
                                            <?php if(config('visibility.bill_mode') == 'editing'): ?>
                                            <div>
                                                <!--invoice terms-->
                                                <div class="text-left billing-mode-only-item">
                                                    <?php if($bill->bill_type == 'invoice'): ?>
                                                    <h4><?php echo e(cleanLang(__('lang.invoice_terms'))); ?></h4>
                                                    <?php else: ?>
                                                    <h4><?php echo e(cleanLang(__('lang.estimate_terms'))); ?></h4>
                                                    <?php endif; ?>
                                                    <textarea class="form-control form-control-sm tinymce-textarea" rows="3" name="bill_terms"
                                                        id="bill_terms"><?php echo clean($bill->bill_terms); ?></textarea>
                                                </div>
                                                <!--client - make a payment button-->
                                                <div class="text-right p-t-25">
                                                    <?php if($bill->bill_type == 'invoice'): ?>
                                                    <!--cancel-->
                                                    <a class="btn btn-secondary btn-sm"
                                                        href="<?php echo e(url('/invoices/'.$bill->bill_invoiceid)); ?>"><?php echo app('translator')->get('lang.exit_editing_mode'); ?></a>
                                                    <!--save changes-->
                                                    <button class="btn btn-danger btn-sm"
                                                        data-url="<?php echo e(url('/invoices/'.$bill->bill_invoiceid.'/edit-invoice')); ?>" data-type="form"
                                                        data-form-id="bill-form-container" data-ajax-type="post" id="billing-save-button">
                                                        <?php echo app('translator')->get('lang.save_changes'); ?>
                                                    </button>
                                                    <?php else: ?>
                                                    <a class="btn btn-secondary btn-sm billing-mode-only-item"
                                                        href="<?php echo e(url('/estimates/'.$bill->bill_estimateid)); ?>"><?php echo app('translator')->get('lang.exit_editing_mode'); ?></a>
                                                    <!--save changes-->
                                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);"
                                                        data-url="<?php echo e(url('/estimates/'.$bill->bill_estimateid.'/edit-estimate?estimate_mode='.request('estimate_mode'))); ?>"
                                                        data-type="form" data-form-id="bill-form-container" data-ajax-type="post"
                                                        data-loading-target="documents-side-panel-billing-content" data-loading-class="loading"
                                                        id="billing-save-button">
                                                        <?php echo app('translator')->get('lang.save_changes'); ?>
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

        <!--ADMIN ONLY NOTES-->
        <?php if((auth()->check() && auth()->user()->is_team) && !config('visibility.public_bill_viewing')): ?>
        <?php if(config('visibility.bill_mode') == 'viewing'): ?>
        <div class="card card-body invoice-wrapper box-shadow billing-mode-only-item billing-mode-only-item"
            id="invoice-wrapper">
            <h4 class=""><?php echo e(cleanLang(__('lang.notes'))); ?> <span class="align-middle text-themecontrast font-16"
                    data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.not_visisble_to_client'))); ?>"
                    data-placement="top"><i class="ti-info-alt"></i></span></h4>
            <div><?php echo clean($bill->bill_notes); ?></div>
        </div>
        <?php endif; ?>
        <?php if(config('visibility.bill_mode') == 'editing'): ?>
        <div class="card card-body invoice-wrapper box-shadow billing-mode-only-item" id="invoice-wrapper">
            <h4 class=""><?php echo e(cleanLang(__('lang.notes'))); ?> <span class="align-middle text-themecontrast font-16"
                    data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.not_visisble_to_client'))); ?>"
                    data-placement="top"><i class="ti-info-alt"></i></span></h4>
            <div><textarea class="form-control form-control-sm tinymce-textarea" rows="3" name="bill_notes"
                    id="bill_notes"><?php echo clean($bill->bill_notes); ?></textarea></div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!--INVOICE LOGIC-->
        <?php if(config('visibility.bill_mode') == 'editing'): ?>
        <?php echo $__env->make('pages.bill.components.elements.logic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>

    <!--ELEMENTS (invoice line item)-->
    <?php if(config('visibility.bill_mode') == 'editing'): ?>
    <table class="hidden" id="billing-line-template-plain">
        <?php echo $__env->make('pages.bill.components.elements.line-plain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </table>
    <table class="hidden" id="billing-estimation-notes-template">
        <?php echo $__env->make('pages.bill.components.elements.line-estimation-notes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </table>
    <table class="hidden" id="billing-line-template-time">
        <?php echo $__env->make('pages.bill.components.elements.line-time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </table>
    <table class="hidden" id="billing-line-template-dimensions">
        <?php echo $__env->make('pages.bill.components.elements.line-dimensions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </table>

    <!--MODALS-->
    <?php echo $__env->make('pages.bill.components.modals.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.bill.components.modals.category-items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.bill.components.modals.expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.bill.components.timebilling.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--[DYNAMIC INLINE SCRIPT] - Get lavarel objects and convert to javascript onject-->
    <script>
        $(document).ready(function () {
            NXINVOICE.DATA.INVOICE = $.parseJSON('<?php echo $bill->json; ?>');
            NXINVOICE.DOM.domState();
        });
    </script>
    <?php endif; ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/bill/bill-web.blade.php ENDPATH**/ ?>