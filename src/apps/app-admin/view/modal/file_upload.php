<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>
<div class="row">
    <div class="col-12 shadow p-3 mb-3 bg-white rounded">
        <sapn class="font-weight-bolder text-center text-secondary ps-3"><?= (isset($media_res) && !empty($media_res)) ? 'Image Gallery | <small><i class="text-secondary">' . $media_res['media_title'] . '</i></small>' : 'Add Image Gallery' ?> </sapn>
    </div>
</div>

<div class="row">
    <div id="error_pop" class="col-md-12"></div>
    <div class="col-sm-6">
        <form id="mediaForm" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">
            <div id="tittleDiv" class="input-group mb-2">
                <span class="input-group-text"><b class="mt-3"> <i class="fa-solid fa-file-contract"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1">
                    <input type="text" name="media_title" class="special_form form-control shadow-none" id="media_title" value="<?= ((isset($media_res) && !empty($media_res)) ? $media_res['media_title'] : '') ?>" placeholder="Document Title" style="border-radius: 0 12px 12px 0;">
                    <label for="media_title">Document title</label>
                </div>
                <section id="titleFeedback" class="valid-feedback">
                    Invalid Document title
                </section>
                <input type="hidden" class="invalid_text" value="Invalid Document title">
            </div>


            <div id="dateDiv" class="input-group mb-2">
                <span class="input-group-text"><b class="mt-3"> <i class="fa-solid fa-calendar-day"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1">
                    <input type="date" name="media_publish_date" class="special_form form-control shadow-none" id="media_publish_date" value="<?= ((isset($media_res['media_publish_date'])) ? date('Y-m-d', strtotime($media_res['media_publish_date'])) : '') ?>" placeholder="YYYY/mm/dd" style="border-radius: 0 12px 12px 0;">
                    <label for="media_publish_date">Document Published date</label>
                </div>
                <section id="dateFeedback" class="valid-feedback">
                    Invalid Published date
                </section>
                <input type="hidden" class="invalid_text" value="Invalid Published date">
            </div>

            <input id="link" type="hidden" name="media_url" value="<?= ((isset($media_res) && !empty($media_res)) ? $media_res['media_url'] : '') ?>" class="form-control" placeholder="File Link">

            <div id="contentDiv" class="mb-2 d-flex">
                <span class="input-group-text flex-shrink-1 border-end-0 border-radius-end-none" style="border-radius: 12px 0 0 12px"><b class="mt-3"> <i class="fa-solid fa-file-lines"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1/ w-100">
                    <textarea class="special_form form-control shadow-none" id="media_content" name="media_content" value="" rows="4" cols="80" placeholder="File Content" style="border-radius: 0 12px 12px 0;"><?= ((isset($media_res['media_content'])) ? $media_res['media_content'] : '') ?></textarea>
                    <label for="media_content">File Description</label>
                </div>
                <section id="dateFeedback" class="valid-feedback">
                    Invalid File Description
                </section>
                <input type="hidden" class="invalid_text" value="Invalid File Description">
            </div>

            <input type="hidden" name="media_type" value="file">
            <?php if (isset($_POST['media_id']) && $_POST['media_id'] != '') : ?>
                <input id="media_id" type="hidden" name="media_id" value="<?= $_POST['media_id'] ?>">
            <?php endif; ?>
        </form>
    </div>
    <div class="col-sm-6">
        <h5 id="error_span" class="text-center text-danger col-md-12"></h5>
        <form id="product_form_img" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">
            <div class="row col-md-12" style="width: 100%;">
                <div class="col-md-12" align="center" id="product_preview">
                    <?php if (isset($media_res) && !empty($media_res)) : ?>
                        <div class="col-md-12" align="center"><a href="<?= $media_res['media_image'] ?>"> <?= $media_res['media_image'] ?></a></div>
                    <?php endif; ?>
                </div>
            </div><br>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file_doc" id="file_doc" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                    <label class="custom-file-label file_label_2" for="file_doc"><i class="fa fa-upload"></i> <span id="label_span_1">Upload Document</span></label>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (isset($media_res) && !empty($media_res)) : ?>
            <a type="button" class="btn shadow-none text-danger float-left" onclick="postonly(path_action, {'media_remove':true,'media_id':<?= $media_res['media_id'] ?>}, 'error_pop');"> <i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Remove</a>
        <?php endif; ?>
        <button class="btn btn-warning btn-sm" onclick="media_post()"><i class="fa fa-file-upload"></i>&nbsp; <?= ((isset($_POST['media_id']) && $_POST['media_id'] != '') ? 'Edit' : 'Add') ?> Document</button>
    </div>
</div>

<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>


<script class="script">
    jQuery(document).ready(function() {
        jQuery('#file_doc').change(function(e) {
            jQuery('#product_form_img').submit();
            var files = jQuery(this)[0].files;
            console.log(files);
            if (files.length != 0) {
                var fileName = e.target.value.split('\\').pop()
                jQuery('#label_span_1').text(fileName);
            }
        });

        jQuery('#product_form_img').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData();
            data.append('url', post_urls[0]);
            data.append('token', token);
            data.append('get_type', post_type[0]);
            data.append('post_image', $("#product_form_img")[0]);

            console.log(data);

            // var data = new FormData(jQuery('#product_form_img')[0]);

            jQuery.ajax({
                url: action_path,
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    data = JSON.parse(data);
                    if (is_json_string(data)) {
                        if (data.data != '') {
                            $('#product_preview').html(data.data);
                        } else {
                            $('#modal_add_errors').html(alert_msg(data.error));
                        }
                    }

                }
            });
        });
    });
</script>

<?php echo ob_get_clean(); ?>