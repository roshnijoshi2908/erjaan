<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-purchase">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_purchase'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-purchase"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5><?php echo app('translator')->get('lang.standard_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--purchase_id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_id]" name="standard_field[purchase_id]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[purchase_id]"><?php echo app('translator')->get('lang.id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_project-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_title]"
                                    name="standard_field[project_title]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[project_title]"><?php echo app('translator')->get('lang.project'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_supplierid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[supplier_id]"
                                    name="standard_field[supplier_id]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[supplier_id]"><?php echo app('translator')->get('lang.supplier_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_supplier-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[supplier_name]"
                                    name="standard_field[supplier_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[supplier_name]"><?php echo app('translator')->get('lang.supplier'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_clientid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_id]"
                                    name="standard_field[client_id]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[client_id]"><?php echo app('translator')->get('lang.client_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_client_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_name]"
                                    name="standard_field[client_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[client_name]"><?php echo app('translator')->get('lang.client_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_created_by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_created_by]"
                                    name="standard_field[purchase_created_by]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[purchase_created_by]"><?php echo app('translator')->get('lang.created_by'); ?></label>
                            </div>
                        </div>
                    </div>
                    
                    <!--purchase_request_date-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_request_date]"
                                    name="standard_field[purchase_request_date]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[purchase_request_date]"><?php echo app('translator')->get('lang.request_date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_items_list-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_items_list]"
                                    name="standard_field[purchase_items_list]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[purchase_items_list]"><?php echo app('translator')->get('lang.purchase_items_list'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--purchase_each_cost-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[costs_for_each_item]"
                                    name="standard_field[costs_for_each_item]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[costs_for_each_item]"><?php echo app('translator')->get('lang.costs_for_each_item'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_total_cost-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[total_cost]"
                                    name="standard_field[total_cost]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[total_cost]"><?php echo app('translator')->get('lang.total_cost'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_paid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[paid]"
                                    name="standard_field[paid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[paid]"><?php echo app('translator')->get('lang.paid'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--purchase_bank-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[selected_the_bank]"
                                    name="standard_field[selected_the_bank]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[selected_the_bank]"><?php echo app('translator')->get('lang.selected_the_bank'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_status]"
                                    name="standard_field[purchase_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[purchase_status]"><?php echo app('translator')->get('lang.status'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--purchase_approve_by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[purchase_approve_by]"
                                    name="standard_field[purchase_approve_by]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[purchase_approve_by]"><?php echo app('translator')->get('lang.approved_by'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--buttons-->
                <div class="buttons-block">

                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button" id="export-projects-button"
                        data-url="<?php echo e(urlResource('/export/purchase?')); ?>" data-type="form" data-ajax-type="POST"
                        data-button-loading-annimation="yes"><?php echo app('translator')->get('lang.export'); ?></button>
                </div>
            </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/export/purchase/export.blade.php ENDPATH**/ ?>