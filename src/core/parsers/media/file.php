<div class="col-12 text-center/">
    <a type="button" class="btn btn-secondary shadow-none float-right" onclick="requestModal(post_modal[12], 'fileModal', {})" style="color: #eee;"> Upload Files</a>

    <div class="row">

        <?php if (is_array($media) || is_object($media)) : ?>
            <?php foreach ($media as $value) : ?>
                <?php $myDateTime   = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>

                <?php
                $file_parts = pathinfo($value['media_image']);
                $fl_ext     = 'fa-file';
                $text_colr  = 'text-secondary';
                if (array_key_exists('extension', $file_parts)) {
                    switch ($file_parts['extension']) {
                        case "pdf":
                            $fl_ext = 'fa-file-pdf';
                            $text_colr = 'text-danger';
                            break;

                        case "doc" || 'docx':
                            $fl_ext = 'fa-file-word';
                            $text_colr = 'text-primary';

                            break;

                        case "": // Handle file extension for files ending in '.'
                            $fl_ext = 'fa-file';
                        case NULL: // Handle no file extension
                            $fl_ext = 'fa-file';
                            break;
                    }
                }
                ?>
                <div id="member_<?= $value['media_id'] ?>" class="media_file_container col-md-4 col-12" style="border-bottom: 1px solid #ddd; padding-top: 9px;">
                    <div class="row">
                        <h5 class="col-12">
                            <a class="doc_anchor text-secondary" href="<?= ABS_FILES . $value['media_image'] ?>" style="padding-bottom: 15px !important;">
                                <i class="fa <?= $fl_ext . ' ' . $text_colr ?> " aria-hidden="true"></i> &nbsp; <?= $value['media_title'] ?>
                            </a> &nbsp;
                            <embed src="<?= ABS_FILES . $value['media_image'] ?>#page=1&zoom=25" width="575" height="500" style="width: 100%; max-height: 300px; overflow-y: hidden !important; overflow: hidden;">
                        </h5>
                        <div class="col-12">
                            <button type="button" class="btn btn-sm float-right btn-info" onclick="requestModal(post_modal[5], 'fileModal', {'media_id':<?= $value['media_id'] ?>})" name="button">Edit </button>
                            <!-- <small class="float-right text-danger">Edit</small> -->
                            <small style="padding: 0" class="text-warning"><?= $value['media_content'] ?></small>
                        </div>
                        <div class="col-12" style="padding: 5px"></div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>