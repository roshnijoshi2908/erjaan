<!--item-->
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_name')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name"
            value="{{ isset($supplier) ? $supplier->supplier_name ?? '' : '' }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_address')</label>
    <div class="col-sm-12">
        <textarea class="form-control form-control-sm" rows="10" name="supplier_address"
                id="supplier_address">{{ isset($supplier) ? $supplier->supplier_address ?? '' : '' }}
</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_telephone')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_telephone" name="supplier_telephone"
            value="{{ isset($supplier) ? $supplier->supplier_telephone ?? '' : '' }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_category')</label>
        <div class="col-sm-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="supplier_categoryid" name="supplier_categoryid">
                
                @foreach($categories as $key => $category)
                <option value="{{ $category->supplier_category_id }}" {{ isset($supplier) && $supplier->supplier_category_id == $category->supplier_category_id ? 'selected' : '' }}
>
                    {{ $category->category_name }}</option>
                @endforeach
            </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_contact_person_name')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_contact_person_name" name="supplier_contact_person_name"
            value="{{ isset($supplier) ? $supplier->supplier_contact_person_name ?? '' : '' }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_contact_person_mobile')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="supplier_contact_person_mobile" name="supplier_contact_person_mobile"
            value="{{ isset($supplier) ? $supplier->supplier_contact_person_mobile ?? '' : '' }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.supplier_created_date')</label>
    <!--<div class="col-sm-12">-->
    <!--    <input type="date" class="form-control form-control-sm" id="supplier_created_date" name="supplier_created_date"-->
    <!--        value="{{ isset($supplier) ? $supplier->supplier_created_date ?? '' : '' }}">-->
    <!--</div>-->
    
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="supplier_created_date"
            value="{{ runtimeDatepickerDate($supplier->supplier_created_date ?? '') }}">
        <input class="mysql-date" type="hidden" name="supplier_created_date" id="supplier_created_date"
            value="{{ runtimeDatepickerDate($supplier->supplier_created_date ?? '') }}">
    </div>
</div>