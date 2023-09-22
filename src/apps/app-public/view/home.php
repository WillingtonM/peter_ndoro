<div id="" class="container pt-10">
    <div class="page-header min-height-300 my-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
        <span class="mask" style="background-color: rgb(41, 55, 75, .8);">
            <div class="p-0">
                <div class="text-center py-3 pt-5">
                  <h1 class="font-weight-bolder text-white text-uppercase"> <span class="me-2"> <?= PROJECT_TITLE ?> </span> </h1>
                  <h5 class="font-weight-light text-white">
                    International Broadcast Journalist 
                  </h5>
                  <h5 class="font-weight-light text-white">
                    World Class Event MC, Conference Director 
                  </h5>
                  <h5 class="font-weight-light text-white">
                    Panel Moderator, Speaker and Trainer
                  </h5>
                </div>
            </div>
        </span>
    </div>
</div>

<div class="container-fluid bg-white p-3 py-5 mb-0">
    <div class="container">

        <div class="d-flex align-items-start row">
            <div class="col-12 col-lg-3" id="pills-tab">
              <ul class="nav nav-pills border bg-dark py-3" id="pills-tab" style="border-radius: 25px" role="tablist" aria-orientation="vertical">
                <?php $tabbs_count = 0 ?>
                <?php foreach ($home_services as $key => $nav) : ?>
                  <?php $tabbs_count++ ?>
                  <li class="service_nav nav-item font-weight-bolder border-bottom w-100">
                    <div class="d-flex">
                      <div class="flex-grow-1 ms-0 px-3">
                        <a href="<?= $key ?>" class="nav-link text-white px-2" id="v-pills-<?= $key ?>-tab" role="tab">
                          <span class="border-weight-bolder"> <?= str_replace('|', '<br>',$nav['short']) ?> </span>
                        </a>
                      </div>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="tab-content col-12 col-lg-9" id="pills-tabContent">

                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                    <?php $bt_cnt = 0?>
                    <?php foreach ($home_services as $home_key => $opt_val) : ?>
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $bt_cnt ?>" class="<?= ($bt_cnt == 0) ? 'active' : '' ?>" aria-current="<?= ($bt_cnt == 0) ? 'true' : 'false' ?>" aria-label="Slide <?= $bt_cnt ?>"></button>
                      <?php $bt_cnt ++?>
                    <?php endforeach; ?>
                  </div>
                  <div class="carousel-inner">
                    <?php $cnt = 0 ?>
                    <?php foreach ($home_services as $home_key => $opt_val) : ?>
                      <?php $cnt ++ ?>
                      <div class="carousel-item <?= ($cnt == 1) ? 'active' : '' ?>">
                        <div class="row">
                          <div class="col-lg-6 wait-1s" data-animation="animated bounceIn">
                            <h3 class="font-weight-bolder px-3 py-2 font-weight-bolder mb-3">
                              <span class="text-warning"><?= $opt_val['short'] ?></span>
                            </h3>
                            <p class="text-dark fs-5">
                              <?php require_once $config['PARSERS_PATH'] . 'services' . DS . $home_key . '.php' ?>
                            </p>
                          </div>

                          <div class="col-lg-6 d-none d-lg-block <?= $opt_val['clas'] ?> mb-3 wait-<?= $opt_val['wait'] ?>s" data-animation="animated <?= $opt_val['anim'] ?>" style="z-index: 10 !important;">
                            <div class="mt-3 py-4"></div>
                            <img src="<?= img_path(ABS_SERVICE, $opt_val['page'] .'.jpg', '')   ?>" alt="data" class="img-fluid" style="border-radius: 0 35px 35px 0;">
                          </div>

                          <div class="col-12 mb-5">
                            <div class="row">
                              <div class="col-12 col-md-8 col-lg-6 mt-3">
                                <div class="row">
                                  <div class="col-12 col-md-6 px-3">
                                    <a href="<?= $opt_val['page'] ?>" class="btn btn-dark col-12 border-radius-lg"> Learn more ... </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

            </div>

        </div>
        <div class="row">
                
        </div>
    </div>

</div>

<!-- testimonials -->
<?php if (is_array($clients)) : ?>
<div class="container-fluid bg-light/ p-3 py-5 mb-0" style="background-color: rgb(41, 55, 75, .8);">
  <div class="container">

    <div class="row">

      <div class="col-12 wait-1s text-center" data-animation="animated bounceIn">
        <h5 class="text-center font-weight-bolder text-secondary/" style="color: #aaa !important"> Testimonials </h5>
        <hr class="horizontal light mt-3 mb-3">
        <h3 class="font-weight-bolder px-3 py-2 mb-3 ">
          <span class="text-white"> Our Clients Say </span>
        </h3>
      </div>

      <div class="col-12">

        <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php $cnt = 0 ?>
            <?php foreach ($clients as $client) : ?>
              <?php $cnt ++ ?>
              <div class="carousel-item <?= ($cnt == 1) ? 'active' : '' ?>">
                <div class="row">
                  <div class="col-12 p-3">
                    <div class="card/ bg-white shadow mb-4 p-3 text-center border border-radius-lg" style="border-radius: 35px;">
                      <div class="card-header pb-0">
                        <img src="<?= img_path(ABS_USER_PROFILE, $client['testimonial_image'], 1) ?>" alt="data" width="100" class="img-fluid border border-5 border-dark" style="border-radius: 50%;">
                      </div>
                      <div class="card-body p-3">
                        <p>
                          "
                          <?= $client['testimonial_message'] ?>
                          "
                        </p>
                        <h5 class="text-dark font-weight-bolder"> <?= $client['testimonial_name'] . ' ' . $client['testimonial_last_name'] ?> </h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-1" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-1" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>

    </div>
  </div>
</div>
<?php endif; ?>

<!-- clients -->
<div class="container-fluid bg-white/ p-3 py-5 mb-5" id="clients_sliders">
    <div class="container">

        <div class="row mb-4" id="">
          <div class="col-12 wait-1s text-center" data-animation="animated bounceIn">
            <h5 class="text-center font-weight-bolder text-light" style="color: #aaa !important"> Clients </h5>
            <hr class="horizontal light mt-3 mb-3">
            <h3 class="font-weight-bolder px-3 py-2 mb-5 ">
              <span class="text-white"> Brands We Have Worked With </span>
            </h3>
          </div>

          <div class="col-12 bg-white border-radius-lg p-3" id="" style="border-radius: 35px">
            <div id="carouselControlsImg" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <?php $bt_cnt = 0?>
                <?php foreach ($img_arr as $home_key => $opt_val) : ?>
                  <button type="button" data-bs-target="#carouselControlsImg" data-bs-slide-to="<?= $bt_cnt ?>" class="<?= ($bt_cnt == 0) ? 'active' : '' ?> p-1" aria-current="<?= ($bt_cnt == 0) ? 'true' : 'false' ?>" aria-label="Slide <?= $bt_cnt ?>"></button>
                  <?php $bt_cnt ++?>
                <?php endforeach; ?>
              </div>

              <div class="carousel-inner">
                <?php $cnt = 0 ?>
                <?php foreach ($img_arr as $client_img) : ?>
                  <?php $cnt ++ ?>
                  <div class="carousel-item mb-5 <?= ($cnt == 1) ? 'active' : '' ?>">
                    <div class="row">
                      <?= $client_img ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselControlsImg" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-secondary rounded-circle p-1" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControlsImg" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-secondary rounded-circle p-1" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button> -->
            </div>
          </div>
        </div>

    </div>

</div>

<!-- contact -->
<div class="container-fluid bg-white/ p-3 py-5 mb-5">
    <div class="container">

        <div class="row">
          <div class="col-12 col-xl-8">

            <div class="row">
                <div class="col-12 px-3 border bg-light" style="border-radius: 35px 0 0 35px">
                    <div class="row">
                        <div class="col-12 text-center py-5">
                            <h3 class="font-weight-bolder text-dark"> Do you have any enquiry? </h3>
                            <small class="m-0 text-dark"> Enquire or contact us directly using any of the methods below </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-2 col-lg-3"></div>
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="text-center mb-4">
                                <p class="p-3 mb-3" style="color: #777;">
                                    <h6 class="">Get in touch, and we will get back to you</h6>
                                    <a class="p-2" style="font-size: .8rem" href="mailto:info@<?= $_ENV['PROJECT_HOST'] ?>"> <i class="fa-solid fa-envelope me-1"></i> <?= $contact_tabs['client']['mail'] ?> </a>
                                    <br>
                                </p>
                            </div>
                            <div id="message_booking_con" class=""></div>
                            <input type="hidden" name="form_type" value="booking_form">

                            <button type="button" class="btn btn-dark col-12 border-radius-lg" style="border-radius: 12px;" onclick="requestModal(post_modal[9], post_modal[9], {})">Online Booking</button>
                        </div>
                        <div class="col-12 col-md-2 col-lg-3"></div>

                        <div class="col-12 mt-3 px-4">
                            
                            <div class="text-center bg-light p-3 border-radius-xl mb-3">
                                <p class="p-0 font-weight-bolder"> Follow me  </p>
                                <hr class="horizontal dark mt-0">

                                <?php foreach ($social_media as $key => $social) : ?>
                                    <a class="text-dark me-4" href="<?= $social['link'] ?>" target="_blank"><i class="<?= $social['font'] ?> fa-2x"></i></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

          </div>

          <div id="get_in_touch" class="col-12 col-xl-4 hover_inimate px-0">
            <div class="card/ h-100 bg-dark wait-1s border-radius-none p-3" data-animation="animated/ shake/" style="border-radius: 0 35px 35px 0">

                <div class="card-body p-3">

                    <div class="form-row align-items-center">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                                <input type="text" class="form-control shadow-none" id="name" name="name" placeholder="Full Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-envelope input_color"></i></span>
                            <input type="email" class="form-control shadow-none" id="email" name="feedbackemail" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-comment input_color"></i></span>
                            <textarea class="form-control shadow-none" id="message" name="message" placeholder="Message ..." rows="4" required></textarea>
                        </div>
                    </div>
                    
                    <div id="feedbackErrors" class=""></div>

                    <div class="text-center" style="border-radius: 3px;">
                        <button type="button" class="btn btn-block rounded-0 btn-white btn-sm shadow-none col-12" style="border-radius: 12px !important;" onclick="postCheck('feedbackErrors', {email: $('#email').val(), name: $('#name').val(), last_name: $('#last_name').val(), message: $('#message').val(), 'form_type':'feedback_form'});">
                            Submit
                        </button>
                    </div>

                    <div class="col-12 text-center">
                        <br>
                        <small class="text-light" style="font-size: .7rem;">
                            Please note that any collected identifying information will be encrypted and stored in a password protected electronic format, <br> thus you can rest assured that your identifying information will be securely stored
                        </small>
                    </div>

                </div>
            </div>
          </div>
        </div>
    </div>

</div>