<div id="home-top" class="row" style="height: max-content;">

  <div id="top_logo_text" class="container-fluid hidden" style="height: max-content; border-radius: 0; width: 100vw; padding: 0; margin: 0; right: 0; bottom: 0;">
    <div class="text-center right-2nd" data-animation="animated zoomInUp" style="font-size: 3.6em;">
      <div class="">
        <div class="text-center right-2nd" data-animation="animated zoomInUp" style="font-size: 3.6em;">
          <div class="row pad-col" style="padding: 50px;"></div>
        </div>
      </div>
    </div>
    <div class="container p-3">
      <div class="text-center left-1st mb-3 border-radius-xl" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(31,40,57, .3);">
        <div id="top_logo_text_carsl" class="text-center pb-3">
          <p>
            <span class="text-white" style="font-family: logo_font; font-size: 3.6em;"> <?= strtoupper(PROJECT_TITLE) ?> </span>
          </p>
          <p class="mb-2">
            <span class="text-white text-white home_service" size="font-size: 3.6em !important;"> MODERATOR &nbsp; <span class="me-1" style="font-size: 1rem;"> &middot; </span> &nbsp; CONFERENCE SPEAKER &nbsp; <span class="me-1" style="font-size: 1rem;"> &middot; </span> &nbsp;  MC </span> <br>
          </p>
          <hr class="horizontal light mt-1 mb-0">
          
          <p class="p-3 text-white">
            Peter Ndoro is a prominent media personality with a diverse background and extensive experience in broadcasting.
            <br>
            Peter Ndoro's remarkable journey, international experience, and remarkable talents have solidified his status as a respected media personality, 
            <br>
            making him a recognizable figure in the entertainment industry.
          </p>
          <p>
            <a href="about" class="btn btn-sm/ px-3 py-1 border-radius-xl btn-secondary font-weight-bolder text-white">Learn more ... </a>
          </p>
        </div>
      </div>
    </div>

    <div class="container text-center">
      <div class="row">

        <?php foreach ($home_array as $home_key => $home_val) : ?>
          <div class="col-12 col-md-4 mb-3 wait-<?= $home_val['wait'] ?>s" data-animation="animated <?= $home_val['anim'] ?>">
            <div class="card_work_home p-0">
              <div class="text-center w-100 home_card p-0">
                <a class="w-100 text-center p-3 text-white" href="<?= $home_key ?>">
                  <i class="<?= $home_val['font'] ?> fa-2x p-4 def_text/"></i>
                </a>
              </div>
              <div class="p-0">
                <h5 class="font-weight-bolder py-3 text-center font-weight-bolder fs-5">
                  <a href="<?= $home_key ?>" class="text-white"><?= $home_val['short'] ?></a>
                </h5>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <br>
    </div>
  </div>

  <div id="carouselFade" class="carousel slide carousel-fade col-12" data-ride="carousel">
    <div class="carousel-inner">
      <!-- 1st carousel -->
      <div class="frst_crsl home_crsl1 carousel-item active" style="height: max-content;">
        <div class="text-center">
          <div class="" style="padding: 39px;"><br><br></div>
          <div class="work_items" style="border-radius: 0;">
            <div class="text-center right-2nd" data-animation="animated zoomInUp" style="font-size: 3.6em;">
              <div class="row pad-col" style="padding: 50px;"></div>
            </div>

            <div class="container p-3">
              <div class="text-center left-1st mb-3 border-radius-xl" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(31,40,57, .3);">
                <div id="top_logo_text_carsl" class="text-center pb-3">
                  <p>
                    <span class="text-white" style="font-family: logo_font; font-size: 3.6em;"> <?= strtoupper(PROJECT_TITLE) ?> </span>
                  </p>
                  <p class="mb-2">
                    <span class="text-white text-white home_service" size="font-size: 3.6em !important;"> MODERATOR &nbsp; <span class="me-1" style="font-size: 1rem;"> &middot; </span> &nbsp; CONFERENCE SPEAKER &nbsp; <span class="me-1" style="font-size: 1rem;"> &middot; </span> &nbsp;  MC </span> <br>
                  </p>
                  <hr class="horizontal light mt-1 mb-0">
                  
                  <p class="p-3 text-white">
                    Peter Ndoro is a prominent media personality with a diverse background and extensive experience in broadcasting.
                    <br>
                    Peter Ndoro's remarkable journey, international experience, and remarkable talents have solidified his status as a respected media personality, 
                    <br>
                    making him a recognizable figure in the entertainment industry.
                  </p>
                  <p>
                    <a href="about" class="btn btn-sm/ px-3 py-1 border-radius-xl btn-secondary font-weight-bolder text-white">Learn more ... </a>
                  </p>
                </div>
              </div>
            </div>

            <div class="container text-center">
              <div class="row">

                <?php foreach ($home_array as $home_key => $home_val) : ?>
                  <div class="col-12 col-md-4 mb-3 wait-<?= $home_val['wait'] ?>s" data-animation="animated <?= $home_val['anim'] ?>">
                    <div class="card_work_home p-0">
                      <div class="text-center w-100 home_card p-0">
                        <a class="w-100 text-center p-3 text-white" href="<?= $home_val['link'] ?>">
                          <i class="<?= $home_val['font'] ?> fa-2x p-4"></i>
                        </a>
                      </div>
                      <div class="p-0">
                        <h5 class="font-weight-bolder py-3 text-center font-weight-bolder fs-5">
                          <a href="<?= $home_val['link'] ?>" class="text-white"><?= $home_val['short'] ?></a>
                        </h5>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
              <br>
            </div>
          </div>
        </div>
      </div>

      <!-- 2nd carousel -->
      <div class="scnd_crsl carousel-item" style="height: max-content;">
        <div class="row">
          <div class="col-12 bg-2_1 home_crsl_2_1 wait-1s" data-animation="animated fadeInLeft">
            <div class="">
              <div style="padding: 40px;"><br><br></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 bg-2_2 home_crsl_2_2 wait-1s" data-animation="animated fadeInRight">
            <div class="right-2nd/">
              <div style="padding: 40px;"><br><br></div>
            </div>
          </div>
        </div>
      </div>

      <!-- 3rd carousel -->
      <div class="thrd_crsl carousel-item" style="width: 100%; height: max-content;">

        <div class="bg-3-0">
          <div class="row">
            <div class="col-12 bg-3_0 home_crsl_3 wait-1s" data-animation="animated">
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
          <div class="col-6 bg-4_1 home_crsl_4_1 wait-1s" data-animation="animated rotateInDownLeft">
            <div class="">
              <div style="padding: 40px;"><br><br></div>
              <br>
            </div>
          </div>
          <div class="col-6 bg-4_2 home_crsl_4_2 wait-1s" data-animation="animated rotateInDownRight">
            <div class="">
              <div style="padding: 40px;"><br><br></div>
              <br>
            </div>
          </div>
        </div>
      </div>

      <!-- 5th carousel -->
      <div class="frth_crsl carousel-item" style="height: max-content;">
        <div class="bg-3-0/">
          <div class="row">
            <div class="col-12 bg-5_0 home_crsl_5 wait-1s" data-animation="animated">
              <div class="right-2nd/">
                <div style="padding: 40px;"><br><br></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 6th carousel -->
      <div class="frth_crsl carousel-item" style="height: max-content;">
        <div class="row">
          <div class="col-6 bg-6_1 home_crsl_6_1 wait-1s" data-animation="animated fadeInDown">
            <div class="right-2nd/">
              <div style="padding: 40px;"><br><br></div>
            </div>
          </div>
          <div class="col-6 bg-6_2 home_crsl_6_2 wait-1s" data-animation="animated fadeInUp">
            <div class="right-2nd/">
              <div style="padding: 40px;"><br><br></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>