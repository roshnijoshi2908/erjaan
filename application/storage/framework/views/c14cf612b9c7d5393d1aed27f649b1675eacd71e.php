
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form" id="settingsFormGeneral">
    <!--product purchase code-->
    <?php if(config('system.settings_type') == 'standalone'): ?>
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.purchase_code'))); ?>

            <span class="align-middle" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.product_purchase_code'))); ?>"
                data-placement="top"><i class="ti-info-alt text-themecontrast"></i></span></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_purchase_code"
                name="settings_purchase_code" value="">
        </div>
    </div>
    <?php endif; ?>

    <!--timezone-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.timezone'))); ?></label>
        <div class="col-12">
            <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="false"
                id="settings_system_timezone" name="settings_system_timezone">

            </select>

        </div>
    </div>

    <!--date format-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.date_format'))); ?></label>
       
    </div>
    <!--date pickerformat-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.date_picker_format'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_datepicker_format"
                name="settings_system_datepicker_format">
                <option value="dd-mm-yyyy"
                    <?php echo e(runtimePreselected('dd-mm-yyyy', )); ?>>
                    dd-mm-yyyy</option>
                <option value="mm-dd-yyyy"
                    <?php echo e(runtimePreselected('mm-dd-yyyy', )); ?>>
                    mm-dd-yyyy</option>
                <option value="yyyy-mm-dd"
                    <?php echo e(runtimePreselected('yyyy-mm-dd', )); ?>>
                    yyyy-mm-dd</option>
            </select>
        </div>
    </div>

    <!--left menu - default position-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.left_menu_position'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_default_leftmenu"
                name="settings_system_default_leftmenu">
                <option value="collapsed"
                    <?php echo e(runtimePreselected('collapsed', )); ?>>
                    <?php echo e(cleanLang(__('lang.collapsed'))); ?></option>
                <option value="open"
                    <?php echo e(runtimePreselected('open', )); ?>>
                    <?php echo e(cleanLang(__('lang.open'))); ?></option>
            </select>
        </div>
    </div>


    <!--stats panel - default position-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.stats_panel_default'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_default_statspanel"
                name="settings_system_default_statspanel">
                <option value="collapsed"
                    <?php echo e(runtimePreselected('collapsed', )); ?>>
                    <?php echo e(cleanLang(__('lang.collapsed'))); ?></option>
                <option value="open"
                    <?php echo e(runtimePreselected('open', )); ?>>
                    <?php echo e(cleanLang(__('lang.open'))); ?></option>
            </select>
        </div>
    </div>

    <!--pagination - limits-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.table_pagination_limits'))); ?></label>
        <div class="col-12">
            <input type="number" class="form-control form-control-sm" id="settings_system_pagination_limits"
                name="settings_system_pagination_limits" value="">
        </div>
    </div>

    <!--pagination - limits-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.kanban_pagination_limits'))); ?></label>
        <div class="col-12">
            <input type="number" class="form-control form-control-sm" id="settings_system_kanban_pagination_limits"
                name="settings_system_kanban_pagination_limits"
                value="">
        </div>
    </div>

    <!--close modal onbocy click-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.close_modal_windows_on_page_click'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_close_modals_body_click"
                name="settings_system_close_modals_body_click">
                <option value="yes"
                    <?php echo e(runtimePreselected('yes', )); ?>>
                    <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                <option value="no"
                    <?php echo e(runtimePreselected('no', )); ?>>
                    <?php echo e(cleanLang(__('lang.no'))); ?></option>
            </select>
        </div>
    </div>

    <!--close modal onbocy click-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.session_timeout_popup'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_session_login_popup"
                name="settings_system_session_login_popup">
                <option value="enabled"
                    <?php echo e(runtimePreselected('enabled', )); ?>>
                    <?php echo e(cleanLang(__('lang.enabled'))); ?></option>
                <option value="disabled"
                    <?php echo e(runtimePreselected('disabled', )); ?>>
                    <?php echo e(cleanLang(__('lang.disabled'))); ?></option>
            </select>
        </div>
    </div>


    <!--system language-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.default_language'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_language_default"
                name="settings_system_language_default">
                
                <option value=""
                    </option>
                
            </select>
        </div>
    </div>

    <!--alow users to change language-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.allow_users_to_change_language'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm"
                id="settings_system_language_allow_users_to_change"
                name="settings_system_language_allow_users_to_change">
                <option value="yes"
                    <?php echo e(runtimePreselected('yes', )); ?>>
                    <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                <option value="no"
                    <?php echo e(runtimePreselected('no', )); ?>>
                    <?php echo e(cleanLang(__('lang.no'))); ?></option>
            </select>
        </div>
    </div>


    <!--exporting html content-->
    <div class="form-group row">
        <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo app('translator')->get('lang.exporting_content'); ?> -
            (<?php echo app('translator')->get('lang.strip_html'); ?>)</label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_system_exporting_strip_html"
                name="settings_system_exporting_strip_html">
                <option value="yes"
                    <?php echo e(runtimePreselected('yes', )); ?>>
                    <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                <option value="no"
                    <?php echo e(runtimePreselected('no', )); ?>>
                    <?php echo e(cleanLang(__('lang.no'))); ?></option>
            </select>
        </div>
    </div>

    <?php if(config('system.settings_type') == 'standalone'): ?>
    <!--[standalone] - settings documentation help-->
    <div>
        <a href="https://growcrm.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
                class="ti-info-alt"></i>
            <?php echo e(cleanLang(__('lang.help_documentation'))); ?></a>
    </div>
    <?php endif; ?>

    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left"
            data-url="/settings/general" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/supplier/supplier.blade.php ENDPATH**/ ?>