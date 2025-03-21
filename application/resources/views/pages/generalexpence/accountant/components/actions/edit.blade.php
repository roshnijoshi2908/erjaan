<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Paid</label>
    <div class="col-sm-12">
        <select id="paid" name="paid" class="form-control form-control-sm" >
            <option value="">-- Select Paid Status --</option>
            <option value="1" {{ $generalExpence->paid == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $generalExpence->paid == '0' ? 'selected' : '' }}>No</option>

        </select>
    </div>
</div>

<!--proposal_template_body-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">Select Bank</label>
    <div class="col-sm-12">
        <select  name="bank" id="bank" class="form-control form-control-sm">
            <option value="">-- Select Bank --</option>
           
                 @foreach($banks as $bank)
                    <option value="{{ $bank->id }}" {{ $generalExpence->bank == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                @endforeach
        </select>
    </div>
</div>