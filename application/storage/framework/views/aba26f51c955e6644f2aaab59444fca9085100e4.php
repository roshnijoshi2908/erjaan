<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.my_notes'))); ?></div>



<!--Form Data-->
<div class="card-show-form-data " id="card-lead-mynotes">
    <div class="x-notes-editor">
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control form-control-sm tinymce-textarea" name="lead_mynotes"
                    id="lead_mynotes"><?php echo $note->note_description ?? ''; ?></textarea>
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="button" class="btn btn-danger btn-xs ajax-request" data-loading-target="card-leads-left-panel"
            data-url="<?php echo e(url('/leads/content/'.$lead->lead_id.'/edit-mynotes')); ?>" data-type="form"
            data-loading-class="loading-before-centre" data-ajax-type="post" data-form-id="card-lead-mynotes">
            <?php echo e(cleanLang(__('lang.update'))); ?>

        </button>
    </div>
</div><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/lead/content/mynotes/edit.blade.php ENDPATH**/ ?>