
<div class="card count-<?php echo e(is_countable($generalexpencecat) ? count($generalexpencecat) : 0); ?>" id="expencecat-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            <?php if(@count($generalexpencecat) > 0): ?>
            <table id="expencecat-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                 <thead>
                     
                     <th class="col_catgeory_id"><a class="js-ajax-ux-request js-list-sorting"
                        id="sort_subcategory_name" href="javascript:void(0)"
                        data-url="<?php echo e(urlResource('/general-expense/category?action=sort&orderby=id&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.id'); ?><span
                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--title-->
                    <th class="col_catgeory_name"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_proposal_template_title" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/general-expense/category?action=sort&orderby=category_name&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.name'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                   

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)"><?php echo app('translator')->get('lang.created_by'); ?></a></th>

                    <!--actions-->
                    <th class="col_generalexpence_category_actions w-px-120"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.actions'); ?></a>
                    </th>
                </thead>
                <tbody id="expencecat-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.generalexpence.generalexpencecategory.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--/ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--/load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($generalexpencecat) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/generalexpencecategory/components/table/table.blade.php ENDPATH**/ ?>