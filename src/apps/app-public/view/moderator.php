<div id="home-top" class="row">
    <div id="top_logo_text" class="container-fluid work_items hidden">
        <div class="col-12" style="padding: 25px;"></div>

        <div class="container">
            <div class="row p-3 mb-3">
                <div class="col-12 text-center left-1st mb-3" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(0, 0, 0, .3);">
                    <div class="card-body">
                        <h3 class="card-title font-weight-bolder text-white"> Webinar, Panel Facilitator</h3>
                        <p class="card-text p-3 mb-3 text-white fs-6">
                            Fifi is a proficient orator who connects well with an audience.
                            <br>She is well versed in economics and financial markets. She is also knowledgeable on the retail, manufacturing, banking, construction, mining and energy sectors
                            <br>Fifi has moderated discussions for local and global government entities, private sector companies as well as multilateral institutions including the United Nations Industrial Development Organisation.
                            <br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row text-center mb-3 p-3">
                <?php if (is_array($tvap_qry) || is_object($tvap_qry)) : ?>
                    <?php foreach ($tvap_qry as $key => $value) : ?>
                        <?php $count++ ?>
                        <?php $img_dir = ABS_GALLERY . $value['media_image'] . DS ?>
                        <div class="frst_crsl_<?= $count ?> carousel-item/ <?= (($count == 1) ? 'active' : '') ?>">
                            <div id="member_<?= $value['media_id'] ?>" style="border-bottom/: 1px solid #ddd;" class="li_media">
                                <div class="row mod_img">
                                    <?= global_imgs($img_dir, 'col-md-2', 6, 'sqaure', $value['media_image'], $value['media_id']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-12 text-center mt-3">
                    <a href="./media?tab=gallery-moderator" class="text-white btn btn-secondary px-3 py-1">View More Media Gallery</a>
                </div>
            </div>
        </div>

    </div>

    <div id="carouselFade" class="carousel slide carousel-fade col-12" data-ride="carousel">
        <div class="carousel-inner">
            <!-- 1st carousel -->
            <div class="frst_crsl moderator_crsl carousel-item active" style="height: max-content;">
                <div class="text-center">
                    <div style="padding: 39px;"> <br><br> </div>
                    <div class="work_items" style="border-radius: 0;">
                        <div class="col-12" style="padding: 25px;"></div>

                        <div class="container">
                            <div class="row p-3 mb-3">
                                <div class="col-12 text-center left-1st mb-3" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(0, 0, 0, .3);">
                                    <div class="card-body">
                                        <h3 class="card-title font-weight-bolder text-white"> Webinar, Panel Facilitator</h3>
                                        <p class="card-text p-3 mb-3 text-white fs-6">
                                            Fifi is a proficient orator who connects well with an audience.
                                            <br>She is well versed in economics and financial markets. She is also knowledgeable on the retail, manufacturing, banking, construction, mining and energy sectors
                                            <br>Fifi has moderated discussions for local and global government entities, private sector companies as well as multilateral institutions including the United Nations Industrial Development Organisation.
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-center mb-3 p-3">
                                <?php if (is_array($tvap_qry) || is_object($tvap_qry)) : ?>
                                    <?php foreach ($tvap_qry as $key => $value) : ?>
                                        <?php $count++ ?>
                                        <?php $img_dir = ABS_GALLERY . $value['media_image'] . DS ?>
                                        <div class="frst_crsl_<?= $count ?> carousel-item/ <?= (($count == 1) ? 'active' : '') ?>">
                                            <div id="member_<?= $value['media_id'] ?>" style="border-bottom/: 1px solid #ddd;" class="li_media">
                                                <div class="row mod_img">
                                                    <?= global_imgs($img_dir, 'col-md-2', 6, 'sqaure', $value['media_image'], $value['media_id']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <div class="col-12 text-center mt-3">
                                    <a href="./media?tab=gallery-moderator" class="text-white btn btn-secondary px-3 py-1">View More Media Gallery</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- 2nd carousel -->
            <div class="scnd_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-12 bg-2_1 moderator_crsl_2_1 wait-1s" data-animation="animated fadeInLeft">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 bg-2_2 moderator_crsl_2_2 wait-1s" data-animation="animated fadeInRight">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 3rd carousel -->
            <div class="thrd_crsl carousel-item" style="width: 100%; height: max-content;">
                <div class="bg-3-0">
                    <div class="row">
                        <div class="col-12 bg-3_0 moderator_crsl_3 wait-1s" data-animation="animated">
                            <div class="">
                                <div style="padding: 40px;"><br><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 4th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-6 bg-4_1 moderator_crsl_4_1 wait-1s" data-animation="animated rotateInDownLeft">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                            <br>
                        </div>
                    </div>
                    <div class="col-6 bg-4_2 moderator_crsl_4_2 wait-1s" data-animation="animated rotateInDownRight">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
            <!-- 5th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="">
                    <div class="row">
                        <div class="col-12 bg-5_0 moderator_crsl_5 wait-1s" data-animation="animated">
                            <div class="">
                                <div style="padding: 40px;"><br><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 6th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-6 bg-6_1 moderator_crsl_6_1 wait-1s" data-animation="animated fadeInDown">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                    <div class="col-6 bg-6_2 moderator_crsl_6_2 wait-1s" data-animation="animated fadeInUp">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>