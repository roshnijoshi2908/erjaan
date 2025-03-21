<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="status" name="status">
            <option value="approved" {{ $generalExpence->status === 'approved' ? 'selected' : '' }}>
                {{ cleanLang(__('lang.approved')) }}
            </option>
            <option value="rejected" {{ $generalExpence->status === 'rejected' ? 'selected' : '' }}>
                {{ cleanLang(__('lang.rejected')) }}
            </option>
        </select>
    </div>
</div>