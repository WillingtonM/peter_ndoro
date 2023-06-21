<div id="headnav/" class="topnavbar fixed-top">
  <div class="container social_top">
    <div class="row p-3">
      <div class="social_med col-12 p-0 px-3 bg-none">
        <?php foreach ($social_media as $key => $social) : ?>
          <a class="float-end p-2 text-dark" style="font-size: .7rem" href="<?= $social['link'] ?>" target="_blank"><i class="<?= $social['font'] ?> fa-2x/"></i></a>
        <?php endforeach; ?>
        <a class="float-end p-2 text-dark" style="font-size: .7rem" href="mailto:<?= $_ENV['MAIL_MAIL'] ?>" target="_blank"> <?= $_ENV['MAIL_MAIL'] ?> </a>
      </div>
    </div>
    <div class="clear-fix"></div>
  </div>

  <div class="container position-sticky z-index-sticky top-0 p-0">
    <div class="row">
      <div class="col-12 p-0 m-0">
        <!-- Navbar -->
        <nav id="navbar" class="navbar navbar-expand-lg top-0 z-index-3 shadow my-3 py-2 start-0 end-0 mx-4 position-absolute/ position-relative" style="border-radius: 18px; height: 60px;">
          <div class="container-fluid position-relative">

            <a class="navbar-brand log-card d-none d-sm-block" href="home">
              <img id="navbar-brand-img" class="bg-white/" style="border-radius: 50%" src="<?= PROJECT_LOGO ?>" height="30" loading="lazy" alt="<?= PROJECT_TITLE ?>">
              <span class="name_ref name_card_alt font-weight-bolder text-uppercase text-white"> <?= PROJECT_TITLE ?> </span>
            </a>

            <a class="navbar-brand log-card d-block d-sm-none" href="home">
              <img id="navbar-brand-img" class="bg-white/" style="border-radius: 50%" src="<?= PROJECT_LOGO ?>" height="30" loading="lazy" alt="<?= PROJECT_TITLE ?>">
              <span class="font-weight-bolder text-uppercase text-white"> <?= PROJECT_TITLE ?> </span>
            </a>

            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link text-uppercase font-weight-bolder <?= ((isset($page) && $page == "home") ? 'active nav_text_left' : '') ?>" href="home"> Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-uppercase font-weight-bolder <?= ((isset($page) && $page == "about") ? 'active nav_text_left' : '') ?>" href="about"> About</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link text-uppercase font-weight-bolder dropdown-toggle <?= ((isset($page) && $page == "services") ? 'active nav_text_left' : '') ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Services
                  </a>
                  <div class="dropdown-menu dropdown-menu-animation dropdown-menu-start dropdown-lg mt-0 mt-lg-4 p-3" aria-labelledby="navbarDropdownMenuLink" style="border-radius: 15px 15px; border: none !important; overflow-x: hidden !important; overflow-y: hidden !important; background: rgb(31,40,57, .9)">
                    <?php $count_limit  = 3; ?>
                    <?php $count        = 0; ?>

                    <div class="row">
                      <div class="col-12 col-md-6">
                        <?php foreach ($services_navba as $nav_key => $nav_val) : ?>
                          <?php $count++; ?>
                          <a class="w-100 px-2" href="services?tab=<?= $nav_key ?>">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <?php if ($nav_key == 'podcast') : ?>
                                  <span class="ps-1 pe-1/"><i class="<?= $nav_val['imgs'] ?> fa-2x text-white"></i></span> 
                                <?php else: ?>
                                  <i class="<?= $nav_val['imgs'] ?> fa-2x"></i>
                                <?php endif; ?>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                <p class="p-0 m-0 text-xs"><?= $nav_val['short'] ?></p>
                                <small class="text-xxs"> <?= $nav_val['long'] ?> </small>
                              </div>
                            </div>
                          </a>
                          <?php if ($count == $count_limit) break ?>

                        <?php endforeach; ?>
                      </div>

                      <?php $count = 0; ?>
                      <div class="col-12 col-md-6">
                        <?php foreach ($services_navba as $nav_key => $nav_val) : ?>
                          <?php $count++; ?>
                          <?php if ($count <= $count_limit) continue; ?>
                          <a class="w-100 px-2" href="services?tab=<?= $nav_key ?>">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <?php if ($nav_key == 'podcast') : ?>
                                  <span class="ps-1 pe-1/"><i class="<?= $nav_val['imgs'] ?> fa-2x text-white"></i></span> 
                                <?php else: ?>
                                  <i class="<?= $nav_val['imgs'] ?> fa-2x"></i>
                                <?php endif; ?>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                <p class="p-0 m-0 text-xs"><?= $nav_val['short'] ?></p>
                                <small class="text-xxs"> <?= $nav_val['long'] ?> </small>
                              </div>
                            </div>
                          </a>
                          <?php //if ($count == 4) break 
                          ?>

                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>

                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link text-uppercase font-weight-bolder dropdown-toggle <?= ((isset($page) && $page == "media") ? 'active nav_text_left' : '') ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Media
                  </a>
                  <div class="dropdown-menu dropdown-menu-animation dropdown-menu-start dropdown-lg mt-0 mt-lg-4 p-3" aria-labelledby="navbarDropdownMenuLink" style="border-radius: 15px 15px; border: none !important; overflow-x: hidden !important; overflow-y: hidden !important; background: rgb(31,40,57, .9)">
                    <?php $count_limit  = 3; ?>
                    <div class="row">
                      <?php $count = 0; ?>
                      <div class="col-12 col-md-6">
                        <?php foreach ($navbar_media as $nav_key => $nav_val) : ?>
                          <?php $count++; ?>
                          <a class="w-100 px-2" href="media?tab=<?= $nav_key ?>">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <?php if ($nav_key == 'podcast') : ?>
                                  <span class="ps-1"><i class="<?= $nav_val['imgs'] ?> fa-2x text-white"></i></span> 
                                <?php else: ?>
                                  <i class="<?= $nav_val['imgs'] ?> fa-2x"></i>
                                <?php endif; ?>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                <p class="p-0 m-0 text-xs"><?= $nav_val['short'] ?></p>
                                <small class="text-xxs"> <?= $nav_val['long'] ?> </small>
                              </div>
                            </div>
                          </a>
                          <?php if ($count == $count_limit) break ?>
                        <?php endforeach; ?>
                      </div>

                      <?php $count = 0; ?>
                      <div class="col-12 col-md-6">
                        <?php foreach ($navbar_media as $nav_key => $nav_val) : ?>
                          <?php $count++; ?>
                          <?php if ($count <= $count_limit) continue; ?>
                          <a class="w-100 px-2" href="media?tab=<?= $nav_key ?>">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <?php if ($nav_key == 'podcast') : ?>
                                  <span class="ps-1"><i class="<?= $nav_val['imgs'] ?> fa-2x text-white"></i></span> 
                                <?php else: ?>
                                  <i class="<?= $nav_val['imgs'] ?> fa-2x"></i>
                                <?php endif; ?>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                <p class="p-0 m-0 text-xs"><?= $nav_val['short'] ?></p>
                                <small class="text-xxs"> <?= $nav_val['long'] ?> </small>
                              </div>
                            </div>
                          </a>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>

                </li>
                <li class="nav-item">
                  <a class="nav-link text-uppercase font-weight-bolder <?= ((isset($page) && $page == "contact") ? 'active nav_text_left' : '') ?>" href="contact"> Contact </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a type="button" class="btn/ btn-sm mb-0/ border-radius-lg bg-gradient-dark/ btn-light text-uppercase font-weight-bolder" onclick="requestModal(post_modal[9], post_modal[9], {})"> Bookings </a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>

</div>
<div id="navbarholder" class=""></div>