<div class="table-responsive" id="category-items-list-table">
    <table class="table">
        <thead>
            <tr>
                <!--with sort-->
                <th class="col_category"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.category'); ?></a></th>
                <!--actions-->
                <th class="col_no_sort"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.products'); ?></a></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!--list checkbox-->
                <td class="items_col_checkbox checkitem">
                    <div class="clearfix">
                        <div class="pull-left p-l-10">
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="category-<?php echo e($category->category_id); ?>"
                                    name="ids[<?php echo e($category->bar); ?>]" <?php echo e(runtimeCategoryItemsDisabledCheck(count($category->items))); ?>

                                    data-target=".checkbox_items_<?php echo e($category->category_id); ?>"
                                    class="listcheckbox listcheckbox-items filled-in chk-col-light-blue category-items-checkbox">
                                <label for="category-<?php echo e($category->category_id); ?>"></label>
                            </span>
                        </div>
                        <div class="pull-left p-l-30">
                            <?php echo e($category->category_name); ?>

                        </div>
                    </div>
                    <!--each category product (hidden)-->
                    <div class="list m-t-20 hidden" id="category-items-<?php echo e($category->category_id); ?>">

                        <!--all items-->
                        <?php if(count($category->items) > 0): ?>
                        <?php $__currentLoopData = $category->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="x-each-item m-b-10 p-l-40 clearfix">
                            <div class="pull-left p-l-10">
                                <span class="list-checkboxes display-inline-block w-px-20">
                                    <input type="checkbox" name="items[<?php echo e($category->bar); ?>]"
                                        id="item-<?php echo e($item->item_id); ?>"
                                        data-actions-container-class="items-checkbox-actions-container"
                                        data-item-id="<?php echo e($item->item_id); ?>" data-unit="<?php echo e($item->item_unit); ?>"
                                        data-quantity="1" data-description="<?php echo e($item->item_description); ?>"
                                        data-type="<?php echo e($item->item_type); ?>"
                                        data-length="<?php echo e($item->item_dimensions_length); ?>"
                                        data-width="<?php echo e($item->item_dimensions_width); ?>"
                                        data-tax-status="<?php echo e($item->item_tax_status); ?>"
                                        data-has-estimation-notes="<?php echo e($item->has_estimation_notes); ?>"
                                        data-estimation-notes="<?php echo e($item->estimation_notes_encoded); ?>"
                                        data-rate="<?php echo e($item->item_rate); ?>"
                                        class="listcheckbox listcheckbox-items filled-in chk-col-light-blue checkbox_items_<?php echo e($category->category_id); ?> items-checkbox">
                                    <label for="item-<?php echo e($item->item_id); ?>"></label>
                                </span>
                            </div>
                            <div class="pull-left p-l-30">
                                <?php echo e($item->item_description); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <!--no items-->
                        <?php if(count($category->items) == 0): ?>
                        <div class="text-center m-b-20 m-t--10 opacity-9">
                            <small><?php echo app('translator')->get('lang.no_products_in_category'); ?></small>
                        </div>
                        <?php endif; ?>
                    </div>
                </td>
                <!--count & toggle-->
                <td class="vt">
                    <div class="clearfix">
                        <div class="pull-left w-px-51">
                            <?php echo e(count($category->items)); ?>

                        </div>
                        <div class="switch pull-right m-l-20">
                            <label>
                                <input type="checkbox" name="add_client_option_contact" id="add_client_option_contact"
                                    data-target="category-items-<?php echo e($category->category_id); ?>"
                                    class="js-switch-toggle-hidden-content">
                                <span class="lever switch-col-light-blue"></span>
                            </label>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="text-right m-t-20">
    <button type="submit" id="categoryItemsModalSelectButton"
        class="btn btn-rounded-x btn-danger waves-effect text-left" data-url="" data-loading-target=""
        data-ajax-type="POST"
        data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.add_selected_items'))); ?></button>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/items/components/modals/category-items.blade.php ENDPATH**/ ?>