<div id="services_div" class="container pt-10 min-vh-100">

    <div class="page-header min-height-400 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
        <span class="mask opacity-6/" style="background-color: rgb(41, 55, 75, .5);">
            <div class="p-0">
                <div class="text-center px-3 pt-5">
                    <h3 class="card-title font-weight-bolder text-white"> <?= $home_panel[$page_key]['short'] ?> </h3>

                    <small class="m-0 text-light">
                        <?php require_once $config['PARSERS_PATH'] . 'services' . DS . $page_key . '.php' ?>
                    </small>
                    <button type="button" class="btn btn-dark border-radius-lg me-3 border" style="border-radius: 12px;" onclick="requestModal(post_modal[9], post_modal[9], {})">Online Booking</button>
                    <a href="contact" class="btn btn-dark border-radius-lg border"> Contact Peter </a>
                </div>
            </div>
        </span>
    </div>

    <div class="mx-4 mt-n6">
        <div class="row">
            <?php foreach ($journalism_array as $home_key => $home_val) : ?>
                <?php if($home_key == 'podcast') : continue; endif; ?>
                <div style="z-index: 12;" class="col-12 col-md-6 mb-3 wait-<?= $home_val['wait'] ?>s" data-animation="animated <?= $home_val['anim'] ?>">
                    <div class="card_work_home p-0">
                        <div class="text-center w-100 home_card p-0">
                        <a class="w-100 text-center p-3 text-white" href="<?= $home_key ?>">
                            <i class="<?= $home_val['font'] ?> fa-2x p-4 def_text/"></i>
                        </a>
                        </div>
                        <div class="p-0">
                        <h5 class="font-weight-bolder py-3 text-center font-weight-bolder fs-5">
                            <a href="media?tab=<?= $home_key ?>" class="text-white"><?= $home_val['short'] ?></a>
                        </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row text-center mb-3 p-3">
            <?php if (is_array($tvap_qry) || is_object($tvap_qry)) : ?>
                <?php foreach ($tvap_qry as $key => $value) : ?>
                    <?php $count++ ?>
                    <?php $img_dir      = ABS_GALLERY . $value['media_image'] . DS ?>
                    <div class="frst_crsl_<?= $count ?> carousel-item/ <?= (($count == 1) ? 'active' : '') ?>" style="">
                        <div id="member_<?= $value['media_id'] ?>" class="li_media">
                            <div class="row mc_img">
                                <?= global_imgs($img_dir, 'col-md-2', 6, 'square', $value['media_image'], $value['media_id']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-12 text-center mt-3">
                    <a href="./media?tab=gallery-moderator" class="text-white btn btn-secondary px-3 py-1">View More Media Gallery</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>