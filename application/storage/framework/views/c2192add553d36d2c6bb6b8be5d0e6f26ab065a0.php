
<div class="card count-<?php echo e(is_countable($generalexpencesubcat) ? count($generalexpencesubcat) : 0); ?>" id="expencesubcat-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            
            <?php if(@count($generalexpencesubcat) > 0): ?>
            <table id="expencecat-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                 <thead>
                     
                     <!--subcategory-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_subcategory_name" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/general-expense/subcategory?action=sort&orderby=id&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.id'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--subcategory-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_subcategory_name" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/general-expense/subcategory?action=sort&orderby=subcategory_name&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.name'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                                
                    <!--category-->
                    <th class="col_subcatgeory_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_category_name" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/general-expense/subcategory?action=sort&orderby=category_name&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.category'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                   

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)"><?php echo app('translator')->get('lang.created_by'); ?></a></th>

                    <!--actions-->
                    <th class="col_generalexpence_category_actions w-px-120"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.actions'); ?></a>
                    </th>
                </thead>
                <tbody id="expencesubCat-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.generalexpence.generalexpencesubcategory.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($generalexpencesubcat) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/generalexpence/generalexpencesubcategory/components/table/table.blade.php ENDPATH**/ ?>