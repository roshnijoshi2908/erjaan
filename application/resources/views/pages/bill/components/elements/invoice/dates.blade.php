    <!--dates-->
    <div class="pull-left invoice-dates">
        <table>
            <tr>
                <td class="x-date-lang" id="fx-invoice-date-lang">{{ $data['invoice_date'] }} </td>
                @if($data['bill_mode'] == 'editing')
                <td class="add-padding-row"><input type="text" class="form-control form-control-xs pickadate" name="bill_date"
                        autocomplete="off" value="{{ runtimeDate($bill->bill_date) }}">
                    <input class="mysql-date" type="hidden" name="bill_date" id="bill_date"
                        value="{{ $bill->bill_date }}">
                </td>
                @else
                <td class="x-date add-padding-row" > <span>{{ runtimeDate($bill->bill_date) }}</span></td>
                @endif
            </tr>
            <tr>
                <td class="x-date-due-lang" >{{ $data['due_date'] }} </td>
                @if($data['bill_mode'] == 'editing')
                <td class="add-padding-row"><input type="text" class="form-control form-control-xs pickadate" name="bill_due_date"
                        autocomplete="off" value="{{ runtimeDate($bill->bill_due_date) }}">
                    <input class="mysql-date" type="hidden" name="bill_due_date" id="bill_due_date"
                        value="{{ $bill->bill_due_date }}">
                </td>
                @else
                <td class="x-date-due add-padding-row"> <span>{{ runtimeDate($bill->bill_due_date) }}</span></td>
                @endif
            </tr>
        </table>
    </div>