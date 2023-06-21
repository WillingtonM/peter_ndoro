    <!-- Modal -->
    <?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

    <div class="row">
        <div class="col-12">
            <h5 class="modal-title"><?= (($usr_arr != null) ? '<i class="fa fa-edit"></i> User | <i class="text-danger">' . $usr_arr['username'] . '</i>' : '<i class="fa fa-plus"></i> Add User') ?></h5>
        </div>

        <div id="userformErrors" class="col-md-12"></div>
        <div class="col-sm-6">
            <form id="userForm" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">
                <?php if (isset($dft_user_type) && $dft_user_type != 'guest') : ?>
                    <div class="form-group row">
                        <label for="user_type" class="col-sm-2 col-form-label"><i class="fas fa-users"></i></label>
                        <div class="col-sm-10">
                            <select id="user_type" name="user_type" value="" class="form-control shadow-none">
                                <option value="">Select User Type</option>
                                <?php foreach ($usrt_qry as $key => $user_type) : ?>
                                    <?php if ($user_type['user_type'] == 'guest') continue ?>
                                    <?php if ($usr_arr != null && ($user_type['user_type_id'] == $usr_arr['user_type_id']) || $dft_user_type == $user_type['user_type']) : ?>
                                        <option value="<?= $user_type['user_type_id'] ?>" selected> <?= ucfirst($user_type['user_type']) ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $user_type['user_type_id'] ?>"><?= ucfirst($user_type['user_type']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <small style="padding-left: 15px;">User Type <sup style="color: red;">*</sup> </small>
                        </div>
                    </div>
                <?php else : ?>
                    <input type="hidden" name="user_type" value="6">
                <?php endif; ?>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label"><i class="far fa-user"></i></label>
                    <div class="col-sm-10">
                        <input id="username" type="text" name="username" value="<?= (($usr_arr != null) ? $usr_arr['username'] : '') ?>" class="form-control shadow-none" placeholder="Username">
                        <small style="padding-left: 15px;">Username <sup style="color: red;">*</sup> </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"><i class="far fa-user"></i></label>
                    <div class="col-sm-10">
                        <input id="name" type="text" name="name" value="<?= (($usr_arr != null) ? $usr_arr['name'] : '') ?>" class="form-control shadow-none" placeholder="Name">
                        <small style="padding-left: 15px;">Name <?= ((isset($dft_user_type) && $dft_user_type != 'guest') ? '<sup style="color: red;">*</sup>' : '') ?> </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-2 col-form-label"><i class="far fa-user"></i></label>
                    <div class="col-sm-10">
                        <input id="surname" type="text" name="surname" value="<?= (($usr_arr != null) ? $usr_arr['last_name'] : '') ?>" class="form-control shadow-none" placeholder="Surname">
                        <small style="padding-left: 15px;">Surname</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label"><i class="fas fa-phone-alt"></i></label>
                    <div class="col-sm-10">
                        <input id="mobile" type="tel" name="mobile" value="<?= (($usr_arr != null) ? $usr_arr['contact_number'] : '') ?>" class="form-control shadow-none" placeholder="Mobile Number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                        <small style="padding-left: 15px;">Mobile Number <?= ((isset($dft_user_type) && $dft_user_type != 'guest') ? '' : '<sup style="color: red;">*</sup>') ?> </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telephone" class="col-sm-2 col-form-label"><i class="fas fa-phone-alt"></i></label>
                    <div class="col-sm-10">
                        <input id="telephone" type="tel" name="telephone" value="<?= (($usr_arr != null) ? $usr_arr['alt_contact_number'] : '') ?>" class="form-control shadow-none" placeholder="Telephone Number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                        <small style="padding-left: 15px;">Telephone Number</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"><i class="far fa-envelope"></i></label>
                    <div class="col-sm-10">
                        <input id="email" type="email" name="email" value="<?= (($usr_arr != null) ? $usr_arr['email'] : '') ?>" class="form-control shadow-none" placeholder="Email">
                        <small style="padding-left: 15px;">Email, eg: user@mail.com</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label"><i class="fas fa-key"></i></label>
                    <div class="col-sm-10">
                        <input id="password" type="password" name="password" value="" class="form-control shadow-none" placeholder="Password">
                        <small style="padding-left: 15px;">Password, only if applicable !</small>
                    </div>
                </div>
                <?php if (isset($dft_user_type) && $dft_user_type != 'guest') : ?>
                    <div class="form-group row">
                        <label for="position" class="col-sm-2 col-form-label"><i class="fas fa-crosshairs"></i></label>
                        <div class="col-sm-10">
                            <input id="position" type="text" name="position" value="<?= (($usr_arr != null) ? $usr_arr['user_position'] : '') ?>" class="form-control shadow-none" placeholder="Position/Title" required>
                            <small style="padding-left: 15px;">Position, eg: Attorney <sup style="color: red;">*</sup> </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="list_position" class="col-sm-2 col-form-label"><i class="fas fa-crosshairs"></i></label>
                        <div class="col-sm-10">
                            <input id="list_position" type="number" min="0" name="list_position" value="<?= (($usr_arr != null) ? $usr_arr['user_listpos'] : '') ?>" class="form-control shadow-none" placeholder="List Position">
                            <small style="padding-left: 15px;">User Position [1=high]</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="province" class="col-sm-2 col-form-label"><i class="fas fa-map-marker-alt"></i></label>
                        <div class="col-sm-10">
                            <select id="province" name="province" value="<?= (($usr_arr != null) ? $usr_arr['user_province'] : '') ?>" class="form-control shadow-none">
                                <option value="">Select Province</option>
                                <?php foreach ($provinces as $key => $type) {
                                    echo '<option value="' . $key . '" ' . (($usr_arr != null && $usr_arr['user_province'] == $key) ? 'selected' : '') . '>' . $type . '</option>';
                                } ?>
                            </select>
                            <small style="width: 100%; padding-left: 15px;">Province</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label text-warning/"><i class="far fa-comment-alt"></i></label>
                        <div class="input-group col-sm-10">
                            <textarea id="description" class="form-control shadow-none" name="description" placeholder="User Description" rows="4" style="width: 100%;" required><?= (($usr_arr != null) ? $usr_arr['user_description'] : '') ?></textarea>
                            <small style="padding-left: 15px;">User Description</small>
                        </div>
                    </div>
                <?php else : ?>
                    <input type="hidden" name="position" value="Applicant/Executor">
                    <input type="hidden" name="list_position" value="0">
                    <input type="hidden" name="province" value="">
                    <input type="hidden" name="description" value="Applicant/Executor">
                <?php endif; ?>


                <?php if ($usr_arr != null) : ?>
                    <input type="hidden" name="post_user" value="<?= $user_id ?>">
                <?php endif; ?>

            </form>
        </div>
        <div class="col-sm-6">
            <h4 class="text-center alt_dflt">User Profile Image</h4>
            <form id="product_form_img" class="form-horizontal" action="includes/action/create_product.php" method="POST" enctype="multipart/form-data">

                <div id="profile_img_form" class="text-center body_element" style="border: 1px solid #ddd; border-radius: 35px; padding: 5px;">
                    <a id="img_cspture_img" class="btn" type="button" name="button">
                        <img id="image_profile" class="image" style="border-radius: 15px; border: 1px solid #ddd; width/: 100%; height: 160px;" src="<?= (($usr_arr != null) ? img_path(ABS_USER_PROFILE, $usr_arr['user_image'], 1) : '') ?>" alt="<?= ((isset($req_res) && $req_res != NULL) ? $req_res['article_title'] : '') ?>">
                        &emsp;
                        <i class="fas fa-camera fa-3x"></i>&emsp;
                        <small>Upload profile image </small>
                    </a> &emsp;
                    <input id="post_image" type="file" name="post_image" accept="image/*" style="display: none;">
                </div>

            </form>
        </div>
    </div>
    <div class="col-12" id="error_pop"></div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-danger btn-sm" onclick="closeModalByID('users')">Close</button>
            <button class="btn btn-warning btn-sm" onclick="modal_user_post();" <?= ((!$is_admin) ? 'disabled' : '') ?>> <?= (($usr_arr != null) ? 'Edit' : 'Add') ?> User</button>
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
                    postFile3('image_profile', 'product_form_img', 2)
                } else {
                    $('#img_cspture_img').css('color', '');
                }
            });
        });
    </script>