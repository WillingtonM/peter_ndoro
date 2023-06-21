<div id="member_<?= $value['media_id'] ?>" class="col-12 col-sm-6 col-md-4 article_container my-1 p-1">
    <div class="shadow gallery_contents artclt_bg2 p-2 border-radius-xl">
        <h5 class="col-12">
            <a class="doc_anchor text-secondary" href="<?= ABS_FILES . $value['media_image'] ?>" style="padding-bottom: 15px !important;">
                <i class="fa <?= $fl_ext . ' ' . $text_colr ?> " aria-hidden="true"></i> &nbsp; <?= $value['media_title'] ?>
            </a> &nbsp;
            <embed src="<?= ABS_FILES . $value['media_image'] ?>#page=1&zoom=25" width="575" height="500" style="width: 100%; max-height: 300px; overflow-y: hidden !important; overflow: hidden;">
        </h5>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="col-12">
                <button type="button" class="btn btn-sm float-right btn-secondary border-radius-lg" onclick="requestModal(post_modal[12], 'fileModal', {'media_id':<?= $value['media_id'] ?>})" name="button">Edit </button>
            </div>
        <?php endif; ?>
    </div>
</div>