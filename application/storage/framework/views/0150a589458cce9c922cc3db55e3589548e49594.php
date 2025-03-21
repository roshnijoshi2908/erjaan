<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-general-expense">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_projects'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-general-expense"></i>
                </span>
            </div>
            <!--title-->
            
            <!--body-->
            <div class="r-panel-body">
                <!--created date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.general_expence_request'))); ?> <?php echo e(cleanLang(__('lang.date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_start"
                                    name="filter_start_date_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_end"
                                    name="filter_start_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--start date-->
                
                <!--category-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.general_expence_category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm"
                                    id="filter_general_expence_category" name="filter_general_expence_category">
                                    <option value="">Select category</option>
                                        <?php $__currentLoopData = $generalexpencecat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->expense_category_id); ?>">
                                            <?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--category -->
                
                 <!--category-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.general_expence_subcategory'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm"
                                    id="filter_general_expence_subcategory" name="filter_general_expence_subcategory">
                                    <option value="">Select subcategory</option>
                                        <?php $__currentLoopData = $generalexpencesubcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcategory->expense_subcategory_id); ?>">
                                            <?php echo e($subcategory->expense_subcategory_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--category -->

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel"><?php echo e(cleanLang(__('lang.reset'))); ?></button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/general-expense/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/components/misc/filter-generalexpence.blade.php ENDPATH**/ ?>