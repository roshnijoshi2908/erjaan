<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Paid</label>
    <div class="col-sm-12">
        <select id="paid" name="paid" class="form-control form-control-sm" >
            <option value="">-- Select Paid Status --</option>
            <option value="1" {{ $purchase->paid == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $purchase->paid == '0' ? 'selected' : '' }}>No</option>

        </select>
        <!--<input type="text" class="form-control form-control-sm" id="paid" name="paid"-->
        <!--    value="{{ $purchase->paid ?? '' }}">-->
    </div>
</div>

<!--proposal_template_body-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Select Bank</label>
    <div class="col-sm-12">
        <select  name="selected_the_bank" id="selected_the_bank" class="form-control form-control-sm">
            <option value="">-- Select Bank --</option>
           
                <!-- @foreach(config('system.gateways') as $gateway)-->
                <!--    <option value="{{ $gateway }}" {{ $purchase->selected_the_bank == $gateway ? 'selected' : '' }}>{{ $gateway }}</option>-->
                <!--@endforeach-->
                
                @foreach($banks as $bank)
                    <option value="{{ $bank->id }}" {{ $purchase->selected_the_bank == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                @endforeach
        </select>
    </div>
</div>