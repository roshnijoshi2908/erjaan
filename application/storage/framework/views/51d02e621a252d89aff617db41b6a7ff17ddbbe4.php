<!--title-->
<div class="form-group row">
    <label
        class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.category_name'))); ?></label>
    <div class="col-12">
        <input type="text" class="form-control form-control-sm" id="kbcategory_title" name="kbcategory_title"
            value="<?php echo e($category->kbcategory_title ?? ''); ?>">
    </div>
</div>

<!--category type-->
<?php if(config('visibility.select_category')): ?>
<div class="form-group row">
    <label class="col-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.type'); ?></label>
    <div class="col-12">
        <select class="select2-basic form-control form-control-sm select2-preselected" id="kbcategory_type"
            name="kbcategory_type" data-preselected="<?php echo e($category->kbcategory_type ?? ''); ?>">
            <option value="text"><?php echo app('translator')->get('lang.standard_text'); ?></option>
            <option value="video"><?php echo app('translator')->get('lang.video'); ?></option>
        </select>
    </div>
</div>
<?php endif; ?>

<div class="form-group row">
    <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.description'))); ?></label>
    <div class="col-12">
        <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="kbcategory_description"
            id="kbcategory_description"><?php echo $category->kbcategory_description ?? '---'; ?></textarea>
    </div>
</div>

<!--visibility-->
<div class="form-group row">
    <label class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.visible_to'))); ?></label>
    <div class="col-12">
        <select class="select2-basic form-control form-control-sm" id="kbcategory_visibility"
            name="kbcategory_visibility">
            <option value="everyone" <?php echo e(runtimePreselected('everyone', $category->kbcategory_visibility ?? '')); ?>>
                <?php echo e(cleanLang(__('lang.everyone'))); ?>

            </option>
            <option value="team" <?php echo e(runtimePreselected('team', $category->kbcategory_visibility ?? '')); ?>>
                <?php echo e(cleanLang(__('lang.team'))); ?>

            </option>
            <option value="client" <?php echo e(runtimePreselected('client', $category->kbcategory_visibility ?? '')); ?>>
                <?php echo e(cleanLang(__('lang.clients'))); ?></option>
        </select>
    </div>
</div>

<!--display-icon-->
<div class="form-group row">
    <label class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.category_icon'))); ?></label>
    <div class="col-12 js-switch-toggle-icons" id="fx-settings-kb-icon-wrapper"
        data-target="category_display_icons_section">
        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <i id="icon-selector-display" class="<?php echo e($category->kbcategory_icon ?? ''); ?>"></i>
        <input type="hidden" name="kbcategory_icon" id="kbcategory_icon" value="<?php echo e($category->kbcategory_icon ?? ''); ?>">
        <?php else: ?>
        <i id="icon-selector-display" class="sl-icon-docs"></i>
        <input type="hidden" name="kbcategory_icon" id="kbcategory_icon" value="sl-icon-docs">
        <?php endif; ?>
    </div>
</div>
<!--spacer-->
<!--option toggle-->
<div class="hidden" id="category_display_icons_section">
    <?php echo $__env->make('misc.icons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!--option toggle-->

<!--migrate to another category-->
<?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
<div class="line"></div>
<div class="form-group row">
    <label
        class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.move_artiles_to_another_category'))); ?>

        (<?php echo e(cleanLang(__('lang.optional'))); ?>)</label>
    <div class="col-12">
        <select class="select2-basic form-control form-control-sm" id="migrate" name="migrate">
            <option>&nbsp;</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->kbcategory_id); ?>"><?php echo e($category->kbcategory_title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php endif; ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/settings/sections/knowledgebase/modals/add-edit-inc.blade.php ENDPATH**/ ?>