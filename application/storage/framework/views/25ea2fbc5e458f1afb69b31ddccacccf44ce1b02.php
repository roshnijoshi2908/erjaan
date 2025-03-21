<div class="header-cover" id="hero-header-cover" <?php echo getDocumentHeroImage($document->doc_hero_direcory ?? '',
    $document->doc_hero_filename ?? '', $document->doc_hero_updated ?? '', $document->doc_type); ?>>
    <!--draft-->
    <div class="document-status-ribbon bg-draft <?php echo e(documentRibbonVisibility('draft', $document->doc_status)); ?>"
        id="doc_status_ribbon_draft">
        <?php echo app('translator')->get('lang.draft'); ?>
    </div>
    <!--new-->
    <div class="document-status-ribbon bg-info <?php echo e(documentRibbonVisibility('new', $document->doc_status)); ?>"
        id="doc_status_ribbon_new">
        <?php echo app('translator')->get('lang.new'); ?>
    </div>
    <!--accepted-->
    <div class="document-status-ribbon bg-success <?php echo e(documentRibbonVisibility('accepted', $document->doc_status)); ?>"
        id="doc_status_ribbon_accepted">
        <?php echo app('translator')->get('lang.accepted'); ?>
    </div>
    <!--declined-->
    <div class="document-status-ribbon bg-danger <?php echo e(documentRibbonVisibility('declined', $document->doc_status)); ?>"
        id="doc_status_ribbon_declined">
        <?php echo app('translator')->get('lang.declined'); ?>
    </div>
    <!--revised-->
    <div class="document-status-ribbon bg-primary <?php echo e(documentRibbonVisibility('revised', $document->doc_status)); ?>"
        id="doc_status_ribbon_revised">
        <?php echo app('translator')->get('lang.revised'); ?>
    </div>
    <!--expired-->
    <div class="document-status-ribbon bg-danger <?php echo e(documentRibbonVisibility('expired', $document->doc_status)); ?>"
        id="doc_status_ribbon_expired">
        <?php echo app('translator')->get('lang.expired'); ?>
    </div>
    <!--awiting-signature-->
    <div class="document-status-ribbon bg-warning <?php echo e(documentRibbonVisibility('awaiting_signatures', $document->doc_status)); ?>"
        id="doc_status_ribbon_awaiting_signatures">
        <?php echo app('translator')->get('lang.awaiting_signatures'); ?>
    </div>
    <!--active-->
    <div class="document-status-ribbon bg-info <?php echo e(documentRibbonVisibility('active', $document->doc_status)); ?>"
        id="doc_status_ribbon_active">
        <?php echo app('translator')->get('lang.active'); ?>
    </div>
    <div class="doc-hero-header <?php echo e(documentEditingModeCheck1($payload['mode'] ?? '')); ?>"
        data-block-styling="hero-heading" id="doc-element-hero">
        <!--editing icons-->
        <div class="doc-edit-icon <?php echo e(documentEditingModeCheck2($payload['mode'] ?? '')); ?>">
            <span class="x-edit-icon js-toggle-side-panel" data-reset-form='skip'
                data-target="documents-side-panel-hero" data-value-header="<?php echo e($document->doc_heading); ?>"
                data-value-title="<?php echo e($document->doc_title); ?>">
                <i class="sl-icon-note"></i>
            </span>
        </div>

        <!--main heading-->
        <div class="main-heading" data-block-src="block_sub_heading_1" <?php echo _clean(getFontColor($document->
            doc_heading_color ?? '')); ?>><?php echo e($document->doc_heading); ?></div>

        <!--document title-->
        <div class="main-title" <?php echo getFontColor($document->doc_title_color ?? ''); ?>><?php echo e($document->doc_title); ?>

        </div>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/documents/elements/hero.blade.php ENDPATH**/ ?>