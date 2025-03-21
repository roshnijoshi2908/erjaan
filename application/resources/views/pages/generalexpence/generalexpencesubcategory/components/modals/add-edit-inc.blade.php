
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.category_name')</label>
        <div class="col-sm-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="expence_categoryid" name="expence_categoryid">
                
                @foreach($generalExpenceCategory as $category)
                    <option value="{{ $category->expense_category_id }}" 
                        {{ isset($generalexpencesubcat) && $generalexpencesubcat->expense_category_id == $category->expense_category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach

            </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.subcategory_name')</label>
    <div class="col-sm-12">
        <input type="text" class="form-control form-control-sm" id="expense_subcategory_name" name="expense_subcategory_name"
            value="{{ $generalexpencesubcat->expense_subcategory_name ?? '' }}">
    </div>
</div>