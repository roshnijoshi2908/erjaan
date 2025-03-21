<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-purchase">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-purchase"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--client-->
                <?php if(config('visibility.filter_panel_client_project')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <select name="filter_project_clientid" id="filter_project_clientid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!--client-->

                <!--assigned-->
                <?php if(config('visibility.filter_panel_assigned')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.assigned'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_assigned" id="filter_assigned"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <!--users list-->
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!--/#users list-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                

                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.status'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_purchase_status" id="filter_purchase_status"
                                    class="form-control form-control-sm select2-basic"
                                    tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status-->


                <!--supplier-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.supplier'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm"
                                    id="filter_purchase_supplier" name="filter_purchase_supplier">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($suppliers->supplier_id); ?>">
                                        <?php echo e($suppliers->supplier_name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--supplier -->
                
                 <!--projects-->
                    <div class="filter-block">
                        <div class="title">
                            <?php echo e(cleanLang(__('lang.project'))); ?>

                        </div>
                        <div class="fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2-basic form-control form-control-sm"
                                        id="filter_purchase_project" name="filter_purchase_project">
                                        <option value=""></option>
                                           <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($projects->project_id); ?>">
                                                <?php echo e($projects->project_title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--projects -->
                
                <!--clients-->
                    <div class="filter-block">
                        <div class="title">
                            <?php echo e(cleanLang(__('lang.clients'))); ?>

                        </div>
                        <div class="fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="select2-basic form-control form-control-sm"
                                        id="filter_purchase_client" name="filter_purchase_client">
                                        <option value=""></option>
                                            <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($clients->client_id); ?>">
                                                <?php echo e($clients->client_company_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--clients -->
                
                
                <!--custom fields-->
               

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel"><?php echo e(cleanLang(__('lang.reset'))); ?></button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/purchase/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/purchase/components/misc/filter-purchase.blade.php ENDPATH**/ ?>