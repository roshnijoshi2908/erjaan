    <!--balances-->
    <div class="pull-right invoice-dues">
        <table>
            <tr>
                <td class="x-payments-lang" id="fx-payments-date-lang">{{ $data['payments'] }}</td>
                @if($bill->sum_payments > 0)
                <td class="x-payments add-padding-row"> <a href="javascript:void(0)" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal" data-footer-visibility="hidden"
                        data-url="{{ urlResource('/payments?action=invoice-payments-modal&paymentresource_type=invoice&paymentresource_id='.$bill->bill_invoiceid) }}"
                        data-loading-target="commonModalBody" data-modal-title="{{ $data['payments'] }}"
                        data-modal-size="modal-lg"><span
                            class="p-l-20">{!! _clean(runtimeMoneyFormatPDF($bill->sum_payments)) !!}</span></a>
                </td>
                @else

                <td class="x-payments add-padding-row"> <span class="p-l-20">{!! _clean(runtimeMoneyFormatPDF(0.00)) !!}</span> </td>
                @endif
            </tr>
            <tr>
                <td class="x-balance-due-lang">{{ $data['balance_due'] }} </td>
                <td class="x-balance-due add-padding-row"> <span class="x-due-amount-label">
                        @if($bill->invoice_balance > 0)
                        <label class="label label-rounded label-danger"
                            id="billing-details-amount-due">{!! _clean(runtimeMoneyFormatPDF($bill->invoice_balance)) !!}</label>
                        @else
                        <label class="label label-rounded label-success"
                            id="billing-details-amount-due">{!! _clean(runtimeMoneyFormatPDF($bill->invoice_balance)) !!}</label>
                        @endif
                    </span>
                    <!--pdf-->
                    <span class="x-due-amount-plain hidden">{!! _clean(runtimeMoneyFormatPDF($bill->invoice_balance)) !!}</span>
                </td>
            </tr>
        </table>
    </div>