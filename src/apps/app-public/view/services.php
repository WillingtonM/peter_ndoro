   <div id="services_div" class="container pt-10 min-vh-100">
    
       <div class="page-header min-height-300 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
           <span class="mask opacity-6/" style="background-color: rgb(41, 55, 75, .5); ">
               <div class="p-0">
                   <div class="text-center py-3 pt-5">
                       <h3 class="font-weight-bolder text-white"><i class="me-2">Our</i> <span class="text-warning"> Services </span></h3>
                       <small class="m-0 text-light">
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
                           Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
                       </small>
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
                                   <span class="font-weight-bolder fs-6"> <?= $nav_val['short'] ?> </span> <br>
                                   <!-- <small class=""> <?= $nav_val['long'] ?> </small> -->
                               </p>

                               <button type="button" class="btn btn-dark btn-sm mb-0 border-radius-lg" onclick="requestModal( post_modal[13], post_modal[13], {'service':'<?= $nav_key ?>'})"> View Details </button>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       </div>

   </div>