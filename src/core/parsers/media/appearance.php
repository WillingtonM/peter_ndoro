<?php if (isset($_SESSION['user_id'])) : ?>
    <div class="w-100 pt-3 px-1">
        <button type="button" class="btn btn-sm btn-secondary shadow-none article_nav article_active" onclick="requestModal(post_modal[1], 'mediaModal', {'type':'appearance'})"> <span class=""> <i class="fas fa-media-plus me-2"></i> Upload Media Appearance</span> </button>
    </div>
<?php endif; ?>
<!-- <hr> -->
<div class="col-12">
    <div class="row">
        <?php if (is_array($gall_qry) || is_object($gall_qry)) : ?>
            <?php foreach ($gall_qry as $value) : ?>
                <?php $media_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>
                <?php $media_file = (!empty($value['media_file_type']) && $value['media_file_type'] == 'video') ? 'media_video':'media_apperance'; ?>
                <div class="col-12 px-3 col-lg-6 mb-3 py-2">
                    <?php require $config['PARSERS_PATH'] . 'media' . DS . $media_file . '.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>