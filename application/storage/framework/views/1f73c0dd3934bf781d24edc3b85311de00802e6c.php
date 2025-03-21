<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="pages_<?php echo e($page->page_id); ?>">

    <!--page_title-->
    <td class="col_page_title">
        <a
            href="<?php echo e(url('app-admin/frontend/pages/'.$page->page_id.'/edit')); ?>"><?php echo e(str_limit($page->page_title ?? '---', 100)); ?></a>
    </td>

    <!--creator-->
    <td class="col_creator">
        <img src="<?php echo e(getUsersAvatar($page->avatar_directory, $page->avatar_filename, $page->page_creatorid)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($page->first_name, $page->page_creatorid)); ?>

    </td>

    <!--page_created-->
    <td class="col_page_created">
        <?php echo e(runtimeDate($page->page_created)); ?>

    </td>

    <!--page_status-->
    <td class="col_page_status">
        <?php if($page->page_status == 'published'): ?>
        <span class="label label-outline-info"><?php echo app('translator')->get('lang.published'); ?></span>
        <?php else: ?>
        <span class="label label-outline-default"><?php echo app('translator')->get('lang.draft'); ?></span>
        <?php endif; ?>
    </td>

    <!--actions-->
    <td class="pages_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('app-admin/frontend/pages/'.$page->page_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
            <a href="<?php echo e(url('app-admin/frontend/pages/'.$page->page_id.'/edit')); ?>"
                title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm">
                <i class="sl-icon-note"></i>
            </a>

            <!--view-->
            <a href="https://<?php echo e(config('system.settings_frontend_domain').'/page/'.$page->page_permanent_link.'?preview='.$page->page_uniqueid); ?>"
                title="<?php echo e(cleanLang(__('lang.view'))); ?>" target="_blank"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/landlord/frontend/pages/table/ajax.blade.php ENDPATH**/ ?>