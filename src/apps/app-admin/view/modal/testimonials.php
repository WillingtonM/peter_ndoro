    <!-- Modal -->
    <?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

    <div class="row">
        <div class="col-12 mb-3">
            <h5 class="modal-title px-3 font-weight-lg"><?= ($testimonial != null) ? 'Edit' : 'Add' ?> Testimonials </h5>
        </div>

        <div id="userformErrors" class="col-md-12"></div>
        <div class="col-sm-6">
            <form id="testimonialForm" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">

                <div class="col-12">
                    <div class="input-group mb-2">
                        <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                        <input type="text" class="form-control shadow-none" name="name" value="<?= (isset($testimonial['testimonial_name'])) ? $testimonial['testimonial_name'] : '' ?>" placeholder="Name" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mb-2">
                        <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                        <input type="text" class="form-control shadow-none" name="last_name" value="<?= (isset($testimonial['testimonial_last_name'])) ? $testimonial['testimonial_last_name'] : '' ?>" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mb-2">
                        <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-envelope input_color"></i></span>
                        <input type="email" class="form-control shadow-none" name="email" value="<?= (isset($testimonial['testimonial_user_email'])) ? $testimonial['testimonial_user_email'] : '' ?>" placeholder="Email" required>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text text-warning" style="border-right: none;"><i class="far fa-comment-dots input_color"></i></span>
                    <textarea class="form-control shadow-none" id="message" name="message" placeholder="Message ..." rows="4" required><?= ((isset($testimonial['testimonial_message'])) ? $testimonial['testimonial_message'] : '') ?></textarea>
                </div>

                <?php if ($testimonial != null) : ?>
                    <input type="hidden" name="testimonial_id" value="<?= $testimonial_id ?>">
                <?php endif; ?>
                <input type="hidden" name="form_type" value="testimonials">

            </form>
        </div>
        <div class="col-sm-6">
            <h6 class="text-center alt_dflt font-weight-lg"> Profile Image</h6>
            <form id="product_form_img" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div id="profile_img_form" class="text-center body_element" style="border: 1px solid #ddd; border-radius: 35px; padding: 5px;">
                    <a id="img_cspture_img" class="btn" type="button">
                        <img id="image_profile" class="image" style="border-radius: 15px; border: 1px solid #ddd; height: 160px;" src="<?= (($testimonial != null) ? img_path(ABS_USER_PROFILE, $testimonial['testimonial_image'], 1) : '') ?>" alt="">
                        &emsp;
                        <i class="fas fa-camera fa-3x"></i>&emsp;
                        <small> Upload profile image </small>
                    </a> &emsp;
                    <input id="post_image" type="file" name="post_image" accept="image/*" style="display: none;">
                </div>
            </form>
        </div>
    </div>
    <div class="col-12" id="error_pop"></div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-dark btn-sm" onclick="postCheck('error_pop', $('#testimonialForm').serialize(), 0, true);"> <?= (($testimonial != null) ? 'Edit' : 'Add') ?> Testimonials </button>
            <button class="btn btn-danger btn-sm" onclick="closeModalByID('testimonials')"> Close </button>
        </div>
    </div>

    <?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>

    <script class="script">
        // post to images
        jQuery(function($) {
            $('#img_cspture_img').on('click', function(e) {
                e.preventDefault();
                $('#post_image')[0].click();
            });

            $('#post_image').on('change', function(e) {
                var file_data = new FormData();
                if ($('#post_image').val()) {
                    $('.fa-camera.fa-3x').css('color', '#03556b');
                    file_data.append('post_image', $("#post_image")[0].files[0]);
                    file_data = $("#post_image")[0].files[0];
                    postFile3('image_profile', 'product_form_img', 2);
                } else {
                    $('#img_cspture_img').css('color', '');
                }
            });
        });
    </script>