<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-settings-invoice">
    <form enctype="multipart/form-data">
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="sl-icon-settings"></i>Invoice Setting
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-settings-invoice"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">
                <div class="filter-block">
                    <div class="title">
                        Upload Logo
                    </div>
                    <div class="fields mt-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dropzone dz-clickable text-center file-upload-box" id="fileupload_logo">
                                    <div class="dz-default dz-message">
                                        <div>
                                            <h4>{{ cleanLang(__('lang.drag_drop_file')) }}</h4>
                                        </div>
                                        <div class="p-t-10"><small>{{ cleanLang(__('lang.allowed_file_types')) }}: (jpg)</small></div>
                                        <div class=""><small>{{ cleanLang(__('lang.minimum_size')) }}: (80 x 80) -
                                                {{ cleanLang(__('lang.maximum_size')) }}: (500 x 500)</small></div>
                                    </div>
                                </div>
                                <input type="hidden" name="logo_1" class="w-100 mb-1" value="{{$invoice['logo'] ?? ''}}"style="border: 1px solid #767676; padding: 3px; border-radius: 3px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-block">
                    <div class="title">
                        Background Colour
                    </div>
                    <div class="fields mt-2">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="color" name="color_code" class="w-100 mb-1" value="{{$invoice['color_code']?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-block">
                    <div class="title">
                        Text Colour
                    </div>
                    <div class="fields my-2">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="color" name="text_color_code" class="w-100 mb-1" value="{{$invoice['text_color_code'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <small class="text-warning">Note: Settings will be applied on all invoices and estimates.</small>
                </div>
                <div class="buttons-block">
                    <button type="button" name="foo1" class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel">{{ cleanLang(__('lang.reset')) }}</button>
                    <button type="button" class="btn btn-rounded-x btn-danger apply-setting-invoice" data-url="{{urlResource('/invoices/invoice-settings')}}" data-type="form" data-ajax-type="POST">{{ cleanLang(__('lang.apply')) }}</button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar-->