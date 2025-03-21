<div class="kb-article">
    <?php if($category->kbcategory_type == 'text'): ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title card-title-underlined"><?php echo e($knowledgebase->knowledgebase_title); ?></h4>
            <p class="card-text"><?php echo _clean($knowledgebase->knowledgebase_text); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <?php if($category->kbcategory_type == 'video'): ?>
    <div class="card">
        <div class="card-body">
            <div class="kb-video">
                <?php echo _clean($knowledgebase->knowledgebase_embed_code); ?>

                <h4 class="card-title p-t-10"><?php echo e($knowledgebase->knowledgebase_title); ?></h4>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/knowledgebase/article/page.blade.php ENDPATH**/ ?>