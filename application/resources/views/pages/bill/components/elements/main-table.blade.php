<div class="col-12">
    <div class="table-responsive m-t-40 invoice-table-wrapper {{ $data['css_bill_mode'] }} clear-both">
        <table class="table table-hover invoice-table {{ $data['css_bill_mode'] }}">
            <thead>
                <tr>
                    <!--action-->
                    @if($data['bill_mode'] == 'editing')
                    <th class="text-left x-action bill_col_action {{$bodyClass}}"></th>
                    @endif
                    <!--description-->
                    <th class="text-left x-description bill_col_description {{$bodyClass}}">{{ $data['description'] }}
                    </th>
                    <!--quantity-->
                    <th class="text-left x-quantity bill_col_quantity {{$bodyClass}}">{{ $data['qty'] }}</th>
                    <!--unit price-->
                    <th class="text-left x-unit bill_col_unit {{$bodyClass}}">{{ $data['unit'] }}</th>
                    <!--rate-->
                    <th class="text-left x-rate bill_col_rate {{$bodyClass}}">{{ $data['rate'] }}</th>
                    <!--tax-->
                    <th
                        class="text-left x-tax bill_col_tax {{$bodyClass}} {{ runtimeVisibility('invoice-column-inline-tax', $bill->bill_tax_type) }}">
                        {{ $data['tax'] }}</th>
                    <!--total-->
                    <th class="text-right x-total bill_col_total {{$bodyClass}}" id="bill_col_total">{{ $data['total'] }}
                    </th>
                </tr>
            </thead>
            @if($data['bill_mode'] == 'editing')
            <tbody id="billing-items-container" class="billing-items-container-editing">
                @foreach($lineitems as $lineitem)
                <!--plain line-->
                @if($lineitem->lineitem_type == 'plain')
                @include('pages.bill.components.elements.line-plain')
                @endif

                <!--estimation notes-->
                @if($lineitem->item_notes_estimatation != '')
                @include('pages.bill.components.elements.line-estimation-notes')
                @endif

                <!--time line-->
                @if($lineitem->lineitem_type == 'time')
                @include('pages.bill.components.elements.line-time')
                @endif

                <!--dimensions line-->
                @if($lineitem->lineitem_type == 'dimensions')
                @include('pages.bill.components.elements.line-dimensions')
                @endif

                @endforeach
            </tbody>
            @else
            <tbody id="billing-items-container">
                @include('pages.bill.components.elements.lineitems')
            </tbody>
            @endif
        </table>
    </div>
</div>