
<?php $__env->startSection('settings_content'); ?>

<div id="pages-form">
    <!--page_title-->
    <div class="form-group row">
        <label class="col-lg-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.title'); ?></label>
        <div class="col-lg-12">
            <input type="text" class="form-control form-control-sm" id="pages_page_title" name="page_title"
                data-mode="<?php echo e($page['mode'] ?? ''); ?>" value="<?php echo e($content->page_title ?? ''); ?>">
        </div>
    </div>

    <!--page_content-->
    <div class="form-group row" id="landlord_pages_editor">
        <div class="col-lg-12">
            <textarea class="form-control form-control-sm tinymce-textarea-extended" name="html_page_content"
                id="page_title"><?php echo $content->page_content ?? ''; ?></textarea>
        </div>
    </div>

    <div class="modal-selector m-l-0 m-r-0 m-t-20 m-b-20 p-b-30">


        <!--page_permanent_link-->
        <div class="input-group m-b-20">
            <label
                class="col-lg-12 p-l-0 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.permanent_link'); ?></label>
            <span class="input-group-addon"
                id="page_permanent_link_label">https://<?php echo e(config('system.settings_frontend_domain')); ?>/page/</span>
            <input type="text" class="form-control form-control-sm " id="page_permanent_link" name="page_permanent_link"
                aria-describedby="page_permanent_link_label" value="<?php echo e($content->page_permanent_link ?? ''); ?>">
        </div>


        <!--page_status-->
        <div class="form-group row">
            <label class="col-lg-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.status'); ?></label>
            <div class="col-lg-12">
                <select class="select2-basic form-control form-control-sm select2-preselected" id="page_status"
                    name="page_status" data-preselected="<?php echo e($content->page_status ?? 'draft'); ?>">
                    <option></option>
                    <option value="draft"><?php echo app('translator')->get('lang.draft'); ?></option>
                    <option value="published"><?php echo app('translator')->get('lang.published'); ?></option>
                </select>
            </div>
        </div>

        <!--more information - toggle-->
        <div class="spacer row m-t-40">
            <div class="col-sm-12 col-lg-8">
                <span class="title font-weight-500"><?php echo app('translator')->get('lang.page_settings'); ?></span>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="edit_page_advanced" id="edit_page_advanced"
                            class="js-switch-toggle-hidden-content" data-target="toogle_edit_page_advanced">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <!--more information-->
        <div class="hidden p-t-30" id="toogle_edit_page_advanced">


            <!--page_show_title-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="page_show_title" name="page_show_title"
                        class="filled-in chk-col-light-blue"
                        <?php echo e(editPageShowTitle($page['mode'] ?? '', $content->page_show_title ?? '')); ?>>
                    <label class="p-l-30" for="page_show_title"><?php echo app('translator')->get('lang.show_page_title'); ?></label>
                </div>
            </div>

            <!--page_meta_title-->
            <div class="form-group row">
                <label class="col-lg-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.meta_title'); ?></label>
                <div class="col-lg-12">
                    <input type="text" class="form-control form-control-sm" id="page_meta_title" name="page_meta_title"
                        value="<?php echo e($content->page_meta_title ?? ''); ?>">
                </div>
            </div>


            <!--page_meta_description-->
            <div class="form-group row">
                <label class="col-lg-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.meta_description'); ?></label>
                <div class="col-lg-12">
                    <textarea class="form-control form-control-sm" rows="5" name="page_meta_description"
                        id="page_meta_description"><?php echo e($content->page_meta_description ?? ''); ?></textarea>

                </div>
            </div>


        </div>

    </div>


    <!--buttons-->
    <div class="text-right p-t-30">

        <!--exit-->
        <a type="button" class="btn btn-default btn-sm waves-effect text-left" id="pages-buttons-save-exit"
            href="<?php echo e(url('app-admin/frontend/pages')); ?>"
            data-dismiss="modal"><?php echo app('translator')->get('lang.exit'); ?></a>

        <!--preview-->
        <a type="button" class="btn btn-info btn-sm waves-effect text-left  <?php echo e($page['visibility_edit_page_preview_button'] ?? ''); ?>" id="pages-buttons-save-preview"
            href="<?php echo e($content->page_preview_link ?? 'javascript:void(0);'); ?>" target="_blank"
            data-dismiss="modal"><?php echo app('translator')->get('lang.view_page'); ?></a>

        <!--save changes-->
        <?php if($page['mode'] == 'create'): ?>
        <button type="submit" id="pages-buttons-save-changes"
            class="btn btn-danger btn-sm waves-effect text-left ajax-request disable-on-click"
            data-url="<?php echo e(url('/app-admin/frontend/pages')); ?>" data-form-id="pages-form" data-ajax-type="POST"
            data-on-start-submit-button="disable"><?php echo app('translator')->get('lang.save_changes'); ?></button>
        <?php else: ?>
        <button type="submit" id="pages-buttons-save-changes"
            class="btn btn-danger btn-sm waves-effect text-left ajax-request disable-on-click"
            data-url="<?php echo e(url('/app-admin/frontend/pages/'.$content->page_id)); ?>" data-form-id="pages-form"
            data-ajax-type="PUT" data-on-start-submit-button="disable"><?php echo app('translator')->get('lang.save_changes'); ?></button>
        <?php endif; ?>


    </div>
</div>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.frontend.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/pages/editing/page.blade.php ENDPATH**/ ?>