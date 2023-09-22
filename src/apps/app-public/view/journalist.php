<div id="services_div" class="container pt-10 min-vh-100">

    <div class="page-header min-height-400 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
        <span class="mask opacity-6/" style="background-color: rgb(41, 55, 75, .5);">
            <div class="p-0">
                <div class="text-center px-3 pt-5">
                    <h3 class="card-title font-weight-bolder text-white"> <?= $home_panel[$page_key]['short'] ?> </h3>

                    <small class="m-0 text-light">
                        <?php require_once $config['PARSERS_PATH'] . 'services' . DS . $page_key . '.php' ?>
                    </small>

                    <div class="text-center">
                        <button type="button" class="btn btn-dark border-radius-lg me-3 border" style="border-radius: 12px;" onclick="requestModal(post_modal[9], post_modal[9], {})">Online Booking</button>
                    <a href="contact" class="btn btn-dark border-radius-lg border"> Contact Peter </a>
                    </div>
                </div>
            </div>
        </span>
    </div>

    <div class="mx-4 mt-n6">
        <div class="row">
            <?php foreach ($journalism_array as $home_key => $home_val) : ?>
                <div style="z-index: 12;" class="col-12 col-md-4 mb-3 wait-<?= $home_val['wait'] ?>s" data-animation="animated <?= $home_val['anim'] ?>">
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
                    <?php $media_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="row card bg-none py-3 px-1 mx-0" style="background: none !important;">
                            <div class="col-12 py-2 px-1" style="border-radius: 15px">
                                <div class="col-12" style="padding-top: 56.25%; height:fit-content">
                                    <?= $value['media_content'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-12 text-center mt-3">
                    <a href="./media?tab=appearance" class="text-white btn btn-secondary px-3 py-1">View More Content</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>