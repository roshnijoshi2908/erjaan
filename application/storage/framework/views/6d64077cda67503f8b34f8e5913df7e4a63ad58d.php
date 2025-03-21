    <!--automation_default_status-->
    <div class="form-group row p-b-10">
        <label class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation'); ?></label>
        <div class="col-sm-12 col-lg-8">
            <select class="select2-basic form-control form-control-sm select2-preselected"
                id="estimate_automation_status" name="estimate_automation_status"
                data-preselected="<?php echo e($automation['estimate_automation_default_status']); ?>">
                <option></option>
                <option value="enabled"><?php echo app('translator')->get('lang.enabled'); ?></option>
                <option value="disabled"><?php echo app('translator')->get('lang.disabled'); ?></option>
            </select>
        </div>
    </div>



    <!--automation settings-->
    <div class="p-t-10 client-selector <?php echo e(estimateAutomationVisibility($automation['estimate_automation_default_status'])); ?>"
        id="automation-options-container">

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-25">
            <h6><?php echo app('translator')->get('lang.automation_option'); ?></h6> <?php echo app('translator')->get('lang.estimate_automation_info_1'); ?>: <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.estimate_automation_info_2'); ?>"
                data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--automation_create_project-->
        <div class="form-group form-group-checkbox row">
            <div class="col-12">
                <label class="text-left control-label col-form-label required p-r-3"><?php echo app('translator')->get('lang.automation_create_project'); ?></label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="estimate_automation_create_project"
                        name="estimate_automation_create_project" class="filled-in chk-col-light-blue"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_create_project'])); ?>>
                    <label class="display-inline" for="estimate_automation_create_project"></label>
                </span>
            </div>
        </div>

        <!--project creation options-->
        <div class="card-contrast-panel m-l-30 <?php echo e(estimateAutomationVisibility($automation['estimate_automation_create_project'])); ?>"
            id="estimate_automation_create_project_options">

            <!--automation_project_title-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo app('translator')->get('lang.project_title'); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="estimate_automation_project_title"
                        name="estimate_automation_project_title"
                        value="<?php echo e($automation['estimate_automation_project_title']); ?>">
                </div>
            </div>

            <!--automation_project_status-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_create_project_status'); ?></label>
                <div class="col-sm-12 col-lg-6">
                    <select class="select2-basic form-control form-control-sm select2-preselected"
                        id="estimate_automation_project_status" name="estimate_automation_project_status"
                        data-preselected="<?php echo e($automation['estimate_automation_project_status']); ?>">
                        <option></option>
                        <option value="not_started"><?php echo app('translator')->get('lang.not_started'); ?></option>
                        <option value="in_progress"><?php echo app('translator')->get('lang.in_progress'); ?></option>
                        <option value="on_hold"><?php echo app('translator')->get('lang.on_hold'); ?></option>
                    </select>
                </div>
            </div>

            <!--estimate_automation_assigned_users-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_assign_project'); ?></label>
                <div class="col-sm-12 col-lg-6">
                    <select name="estimate_automation_assigned_users" id="estimate_automation_assigned_users"
                        class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"
                            <?php echo e(runtimePreselectedInArray($user->id ?? '', $assigned ?? [])); ?>><?php echo e($user->full_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!--automation_create_tasks-->
            <div class="form-group form-group-checkbox row">
                <label
                    class="col-sm-12 col-lg-6 col-form-label text-left"><?php echo app('translator')->get('lang.automation_create_tasks_from_line_item'); ?></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="estimate_automation_create_tasks"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_create_tasks'] )); ?>

                        name="estimate_automation_create_tasks" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="estimate_automation_create_tasks"></label>
                </div>
            </div>

            <!--estimate_automation_copy_attachments-->
            <div class="form-group form-group-checkbox row">
                <label
                    class="col-sm-12 col-lg-6 col-form-label text-left"><?php echo app('translator')->get('lang.copy_file_attachments'); ?></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="estimate_automation_copy_attachments"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_copy_attachments'] )); ?>

                        name="estimate_automation_copy_attachments" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="estimate_automation_copy_attachments"></label>
                </div>
            </div>

            <!--automation_project_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-6 col-form-label text-left"><?php echo app('translator')->get('lang.automation_email_client'); ?>
                    <span class="align-middle text-info font-16" data-toggle="tooltip"
                        title="<?php echo app('translator')->get('lang.automation_email_client_project_info'); ?>" data-placement="top"><i class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="estimate_automation_project_email_client"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_project_email_client'] )); ?>

                        name="estimate_automation_project_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="estimate_automation_project_email_client"></label>
                </div>
            </div>


        </div>

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-50">
            <h6><?php echo app('translator')->get('lang.automation_option'); ?></h6> <?php echo app('translator')->get('lang.estimate_automation_info_1'); ?>: <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.estimate_automation_info_2'); ?>"
                data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--automation_create_invoice-->
        <div class="form-group form-group-checkbox row">
            <div class="col-12">
                <label class="text-left control-label col-form-label required p-r-3"><?php echo app('translator')->get('lang.automation_create_invoice'); ?></label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="estimate_automation_create_invoice"
                        name="estimate_automation_create_invoice" class="filled-in chk-col-light-blue"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_create_invoice'] )); ?>>
                    <label class="display-inline" for="estimate_automation_create_invoice"></label>
                </span>
            </div>
        </div>

        <!--invoice creation options-->
        <div class="card-contrast-panel m-l-30 <?php echo e(estimateAutomationVisibility($automation['estimate_automation_create_invoice'])); ?>"
            id="estimate_automation_create_invoice_options">

            <!--item-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_invoice_due_date'); ?></label>
                <div class="col-sm-12 col-lg-6">
                    <input type="text" class="form-control form-control-sm" id="estimate_automation_invoice_due_date"
                        name="estimate_automation_invoice_due_date"
                        value="<?php echo e($automation['estimate_automation_invoice_due_date']); ?>">
                </div>
            </div>

            <!--automation_invoice_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-6 col-form-label text-left"><?php echo app('translator')->get('lang.automation_email_client'); ?>
                    <span class="align-middle text-info font-16" data-toggle="tooltip"
                        title="<?php echo app('translator')->get('lang.automation_email_client_invoice_info'); ?>" data-placement="top"><i class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="estimate_automation_invoice_email_client"
                        <?php echo e(runtimePrechecked($automation['estimate_automation_invoice_email_client'] )); ?>

                        name="estimate_automation_invoice_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="estimate_automation_invoice_email_client"></label>
                </div>
            </div>

        </div>

    </div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/estimates/components/modals/automation.blade.php ENDPATH**/ ?>