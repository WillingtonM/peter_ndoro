   <div id="services_div" class="container pt-10 min-vh-100">
    
       <div class="page-header min-height-400 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
           <span class="mask opacity-6/" style="background-color: rgb(41, 55, 75, .5); ">
               <div class="p-0">
                   <div class="text-center px-3 pt-5">
                       <h3 class="font-weight-bolder text-white"><i class="me-2"></i> <span class="text-warning/"> Services </span></h3>

                       <p class="fs-5 text-white">
                            <?php $s_count = count($services_navba) ?>
                            <?php $count = 0 ?>
                            <?php foreach ($services_navba AS $nav_val) : ?>
                                <?php $count ++ ?>
                                <?= $nav_val['short'] . (($s_count != $count) ? ' | ' : '') ?>
                            <?php endforeach; ?>
                       </p>
                       <small class="m-0 text-light">
                            With his diverse background, extensive experience in broadcasting, and remarkable talents, Peter Ndoro is the ideal choice for your next event as a Master of Ceremonies (MC), Conference Speaker, or Moderator. <br> 
                            Whether you're organizing a corporate event, conference, or special occasion, Peter Ndoro brings professionalism, charisma, and expertise to ensure a memorable and engaging experience for your audience. 
                            <br> <br>
                            To book Peter Ndoro for your next event or to inquire about his availability and rates, please contact us using the information provided here: <br> 
                       </small>
                       <p class="pt-2">
                            <a href="contact" class="btn btn-light border-radius-xl font-weight-bolder py-2">Contact Page</a>
                       </p>
                   </div>
               </div>
           </span>
       </div>

       <div class="mx-4 mt-n6 overflow-hidden/">
           <div class="row">
               <?php foreach ($services_navba as $nav_key => $nav_val) : ?>
                   <div id="service_<?= $nav_key ?>" class="col-12 col-md-4 p-2 h-200 hover_inimate">
                       <div class="card card-blog bg-white text-center wait-<?= $nav_val['wait'] ?>s" data-animation="animated <?= $nav_val['anim'] ?>" style="border-radius: 35px 35px 20px 20px;">
                           <div class="position-relative">
                               <a class="d-block" onclick="requestModal( post_modal[13], post_modal[13], {'service':'<?= $nav_key ?>'})">
                                   <img src="./img/services/<?= $nav_key ?>.jpg" alt="img-blur-shadow" class="img-fluid" style="border-radius: 35px 35px 0 0; ">
                               </a>
                           </div>
                           <div class="card-body p-3">
                               <p class="text-gradient text-dark mb-2 text-sm">
                                   <span class="font-weight-bolder fs-4"> <?= $nav_val['short'] ?> </span> <br>
                               </p>

                               <div class="">
                                    <?php require_once $config['PARSERS_PATH'] . 'services' . DS . $nav_key . '.php' ?>
                               </div>

                               <button type="button" class="btn btn-dark btn-sm mb-0 border-radius-lg" onclick="requestModal( post_modal[9], post_modal[9], {'type':'<?= $nav_key ?>'})"> Make a booking </button>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       </div>

   </div>