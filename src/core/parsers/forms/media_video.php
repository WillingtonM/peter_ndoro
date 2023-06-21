<div class="row">
	<div class="col-md-6">
        <form id="video_media_form" class="col-12" method="POST">
            <input type="hidden" name="media_type" value="video">
            <input type="hidden" name="file_type" value="video">

            <div id="tittleDiv" class="input-group mb-2">
                <span class="input-group-text"><b class="mt-3"> <i class="fa-solid fa-newspaper"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1">
                    <input type="text" name="media_title" class="special_form form-control shadow-none" id="media_title" value="<?= ((isset($req_res['media_title'])) ? $req_res['media_title'] : '') ?>" placeholder="Video title" style="border-radius: 0 12px 12px 0;">
                    <label for="media_title">Video title</label>
                </div>
                <section id="titleFeedback" class="valid-feedback">
                    Invalid video title
                </section>
                <input type="hidden" class="invalid_text" value="Invalid video title">
            </div>

            <div id="sourceDiv" class="input-group mb-2">
                <span class="input-group-text"><b class="mt-3"> <i class="fa-solid fa-link"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1">
                    <input type="text" name="media_url" class="special_form form-control shadow-none" id="media_url" value="<?= ((isset($req_res['media_url'])) ? $req_res['media_url'] : '') ?>" placeholder="Media Source" style="border-radius: 0 12px 12px 0;">
                    <label for="media_url">Media source</label>
                </div>
                <section id="sourceFeedback" class="valid-feedback">
                    Invalid media source
                </section>
                <input type="hidden" class="invalid_text" value="Invalid media source">
            </div>

            <div id="dateDiv" class="input-group mb-2">
                <span class="input-group-text"><b class="mt-3"> <i class="fa-solid fa-calendar-day"></i> </b> </span>
                <div class="form-floating form-floating-group flex-grow-1">
                    <input type="date" name="media_publish_date" class="special_form form-control shadow-none" id="media_publish_date" value="<?= ((isset($req_res['media_publish_date'])) ? date('Y-m-d', strtotime($req_res['media_publish_date'])) : '') ?>" placeholder="YYYY/mm/dd" style="border-radius: 0 12px 12px 0;">
                    <label for="media_publish_date">Media Published date</label>
                </div>
                <section id="dateFeedback" class="valid-feedback">
                    Invalid Published date
                </section>
                <input type="hidden" class="invalid_text" value="Invalid Published date">
            </div>

            <div id="contentDiv" class="mb-2 d-flex">
                <span class="input-group-text flex-shrink-1 border-end-0 border-radius-end-none" style="border-radius: 12px 0 0 12px"><b class="mt-3"> <i class="fa-solid fa-photo-film"></i> </b> </span>
                <div class="form-floating form-floating-group w-100">
                    <textarea class="special_form form-control shadow-none" id="media_content" name="media_content" value="" rows="4" cols="80" placeholder="Media Content" style="border-radius: 0 12px 12px 0;"><?= ((isset($req_res['media_content'])) ? $req_res['media_content'] : '') ?></textarea>
                    <label for="media_content">Media content</label>
                </div>
                <section id="dateFeedback" class="valid-feedback">
                    Invalid content
                </section>
                <input type="hidden" class="invalid_text" value="Invalid content">
            </div>

            <input type="hidden" name="media_id" value="<?= ((isset($media_id) && !empty($media_id)) ? $req_res['media_id'] : '') ?>">

        </form>

    </div>

    <div class="col-md-6 border-start">
        <div class="col border border-3 bg-secondary d-md-none mt-3"> </div>
        <label for="gender" class="text-secondary">Upload Video</label> <br>
        <hr class="horizontal dark mt-1 mb-0">
        <form id="product_form_img" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <div class="w-100 mb-3">
                    <input class="form-control col-12 shadow-none" type="file" id="video_file" name="video_file" accept="video/*" required>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="row py-3 px-1 mx-0">
                    <div class="col-12" style="padding-top: 56.25%; min-height:260px;">
                        <iframe id="file_upload" class="image" autoplay="false" preload="none" src="<?= $video_name ?>" title="<?= $value['media_title'] ?>" width="1280" height="720" frameborder="0" allowfullscreen></iframe>
                        <input type="hidden" name="file_name" class="file_name" value="">
                    </div>
                </div>
            </div>
            <div class="error_msg"> </div>
        </form>
    </div>

</div>

<div class="row">
    <div id="video_error_pop" class="video_error_pop col-12 mt-4 mb-1"></div>

    <div class="col-12">
        <?php if (isset($media_id) && !empty($media_id)) : ?>
        <button class="btn shadow-none text-danger float-end border-radiusl-lg" onclick="postCheck('video_error_pop', {'media_remove':true,'media_id':<?= $req_res['media_id'] ?>}, 0);"> <i class="fa fa-trash me-2" aria-hidden="true"></i> Remove</button>
        <?php endif; ?>
		<button class="btn btn-secondary shadow-none btn-sm border-radiusl-lg <?= (isset($media_id) && !empty($media_id)) ? '' : 'col-12' ?>" onclick="postCheck('video_error_pop', $('#video_media_form').serialize(), 0, true);"> <?= ((isset($_POST['media_id']) && $_POST['media_id'] != '') ? 'Edit' : 'Add') ?> Video Content</button>
    </div>
</div>

<script class="script">
	$(document).ready(function() {
		$('#video_file').change(function(e) {
			$('#product_form_img').submit();
			var files = $(this)[0].files;
			if (files.length != 0) {
				var fileName = e.target.value.split('\\').pop()
				$('#label_span_1').text(fileName);
			}
		});

		$('#product_form_img').on('submit', function(e) {
			e.preventDefault();

			postFile4('file_upload', 'product_form_img', 'video_error_pop', url_val = 0, '.file_name');

		});
	});
</script>