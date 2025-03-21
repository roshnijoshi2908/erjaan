<!DOCTYPE html>
<html lang="en">

<?php echo $__env->make('frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="inner-page faq">

    <?php echo $__env->make('frontend.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('frontend.layout.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--page heading-->
    <div class="container page-wrapper pages-wrapper faq">

        <?php if($content->page_show_title == 'yes'): ?>
        <div class="pages-header">
            <h4><?php echo e($content->page_title ?? ''); ?></h4>
        </div>
        <?php endif; ?>


        <!--faq container-->
        <div class="pages-container">

            <?php echo $content->page_content ?? ''; ?>


        </div>
    </div>

    <?php echo $__env->make('frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('frontend.layout.footerjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/frontend/pages/page.blade.php ENDPATH**/ ?>