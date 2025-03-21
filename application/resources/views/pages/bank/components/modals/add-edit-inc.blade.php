<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.bank_name')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="name" name="name"
            value="{{ $banks->name ?? '' }}">
    </div>
</div>