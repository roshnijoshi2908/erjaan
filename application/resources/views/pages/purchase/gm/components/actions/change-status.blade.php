
<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="purchase_status" name="purchase_status">
    <option value="approved" {{ $purchase->purchase_status === 'approved' ? 'selected' : '' }}>
        {{ cleanLang(__('lang.approved')) }}
    </option>
    <option value="rejected" {{ $purchase->purchase_status === 'rejected' ? 'selected' : '' }}>
        {{ cleanLang(__('lang.rejected')) }}
    </option>
</select>
    </div>
</div>