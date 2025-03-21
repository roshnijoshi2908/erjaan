<div class="row" id="js-projects-modal-add-edit" data-section="<?php echo e($page['section']); ?>"
    data-project-progress="<?php echo e($project['project_progress'] ?? 0); ?>">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <div class="modal-meta-data">
            <small><strong><?php echo e(cleanLang(__('lang.created_by'))); ?>:</strong>
                <?php echo e($project->first_name ?? runtimeUnkownUser()); ?> |
                <?php echo e(runtimeDate($project->project_created)); ?></small>
        </div>
        <?php endif; ?>

        <!--client<>-->
        <?php if(config('visibility.project_modal_client_fields')): ?>
        <div class="client-selector">

            <!--existing client-->
            <div class="client-selector-container" id="client-existing-container">
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.client'))); ?>*</label>
                    <div class="col-sm-12 col-lg-9">
                        <!--select2 basic search-->
                        <select name="project_clientid" id="project_clientid"
                            class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                            data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                        <!--select2 basic search-->
                        </select>
                    </div>
                </div>
            </div>

            <!--new client-->
            <div class="client-selector-container hidden" id="client-new-container">
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.company_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="client_company_name"
                            name="client_company_name">
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.first_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.last_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="last_name" name="last_name"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.email_address'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="">
                    </div>
                </div>
            </div>

            <!--option buttons-->
            <div class="client-selector-links">
                <a href="javascript:void(0)" class="client-type-selector" data-type="new"
                    data-target-container="client-new-container"><?php echo app('translator')->get('lang.new_client'); ?></a> |
                <a href="javascript:void(0)" class="client-type-selector active" data-type="existing"
                    data-target-container="client-existing-container"><?php echo app('translator')->get('lang.existing_client'); ?></a>
            </div>

            <!--client type indicator-->
            <input type="hidden" name="client-selection-type" id="client-selection-type" value="existing">
        </div>

        <?php endif; ?>
        <!--/#client-->

        <!--SUPPLIER NAME-->
        <div class="client-selectors">
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.supplier_name'); ?></label>
                <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name"
                    placeholder="" value="<?php echo e($suppliers->supplier_name ?? ''); ?>">    
                </div>
            </div>
        </div>
        <!--/#SUPPLIER NAME-->
        
        <!--ADDRESS-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_address'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                 <input type="text" class="form-control form-control-sm" id="supplier_address" name="supplier_address"
                    placeholder="" value="<?php echo e($suppliers->supplier_address ?? ''); ?>">    
            </div>
        </div>
        <!--/#ADDRESS-->

        <!--TELEPHONE-->
                <div class="client-selectors">
                    <div class="form-group row">
                        <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_telephone'))); ?></label>
                        <div class="col-sm-6 col-lg-9">
                        <input type="text" class="form-control form-control-sm" id="supplier_telephone" name="supplier_telephone"
                            placeholder="" value="<?php echo e($suppliers->supplier_telephone ?? ''); ?>">    
                        </div>
                    </div>
                </div>
        <!--/#TELEPHONE-->

        <!--CATEGORY-->
        <div class="form-group row">
            <label for="example-month-input"
                class="col-sm-12 col-lg-3 col-form-label text-left required"><?php echo e(cleanLang(__('lang.supplier_category'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="supplier_categoryid" name="supplier_categoryid">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->category_id); ?>"
                        <?php echo e(runtimePreselected($supplier->supplier_categoryid ?? '', $category->category_id)); ?>><?php echo e(runtimeLang($category->category_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <!--/#CATEGORY-->

        <!--CONTACTPERSONNAME-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_contact_person_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                 <input type="text" class="form-control form-control-sm" id="supplier_contact_person_name" name="supplier_contact_person_name"
                    placeholder="" value="<?php echo e($suppliers->supplier_contact_person_name ?? ''); ?>">    
            </div>
        </div>
        <!--/#CONTACTPERSONNAME-->
        
        <!--CONTACTPERSONMOBILE-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_contact_person_mobile'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                 <input type="text" class="form-control form-control-sm" id="supplier_contact_person_mobile" name="supplier_contact_person_mobile"
                    placeholder="" value="<?php echo e($suppliers->supplier_contact_person_mobile ?? ''); ?>">    
            </div>
        </div>
        <!--/#CONTACTPERSONMOBILE-->
        
        <!--CREATEDBY-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_created_by'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                 <input type="text" class="form-control form-control-sm" id="supplier_created_by" name="supplier_created_by"
                    placeholder="" value="<?php echo e($suppliers->supplier_created_by ?? ''); ?>">    
            </div>
        </div>
        <!--/#CREATEDBY-->
        

        <!--START DATE-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.supplier_created_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="supplier_created_date"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($suppliers->supplier_created_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="supplier_created_date" id="supplier_created_date"
                    value="<?php echo e($suppliers->supplier_created_date ?? ''); ?>">
            </div>
        </div>
        <!--/#START DATE-->

    </div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/suppliers/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>