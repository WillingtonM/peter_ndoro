<?php if (isset($_SESSION['admin_id'])) : ?>
    <div class="col-12 pt-3 px-1">
        <button type="button" class="btn btn-sm btn-secondary shadow-none border-radius-lg" onclick="requestModal(post_modal[4], 'galleryModal', {'type':'gallery'})"> <span class=""> <i class="fas fa-media-plus me-2"></i> Upload Gallery </span> </button>
    </div>
<?php endif; ?>

<div class="col-12">
    <div class="row">
        <?php if (is_array($gall_qry) || is_object($gall_qry)) : ?>
            <?php foreach ($gall_qry as $value) : ?>
                <?php $myDateTime   = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>
                <?php $img_dir      = ABS_GALLERY . $value['media_image'] . DS ?>
                <?php require $config['PARSERS_PATH'] . 'media' . DS . 'gallery_parse.php' ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>