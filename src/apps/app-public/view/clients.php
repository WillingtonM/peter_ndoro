<div id="services_div" class="container pt-10 min-vh-100">

    <div class="page-header min-height-200 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
        <span class="mask opacity-6/" style="background-color: rgb(41, 55, 75, .5);">
            <div class="p-0">
                <div class="text-center px-3 pt-5">
                    <h3 class="card-title font-weight-bolder text-white"> <?= $home_panel[$page_key]['short'] ?> </h3>

                    <small class="m-0 text-light">
                        <?php require_once $config['PARSERS_PATH'] . 'services' . DS . $page_key . '.php' ?>
                    </small>
                    <!-- <button type="button" class="btn btn-dark border-radius-lg me-3 border" style="border-radius: 12px;" onclick="requestModal(post_modal[9], post_modal[9], {})">Online Booking</button>
                    <a href="contact" class="btn btn-dark border-radius-lg border"> Contact Peter </a> -->

                </div>
            </div>
        </span>
    </div>

    <div class="mx-4 mt-n6 bg-white p-3 border-radius-xl" style="border-radius: 35px;">
        <div class="row">
            <?php $count    = 0 ?>
            <?php $img_arr  = [] ?>
            <?php ob_start(); ?>
            <?php foreach ($imgs AS $img) : ?>
                <?php 
                    if (is_file($img)) :
                        $img_path   = $img;
                        $img_expl   = explode(DS, $img);
                        $img_ends   = end($img_expl);
                        $img_full   = explode('.', $img_ends);
                        $img_name   = $img_full[0];

                        $last_pos   = strripos($img_path, DS);
                        $rev        = strrev($img_path);
                        $path       = substr($rev, strlen($img_path) - ($last_pos +1) );
                        $path       = strrev($path);

                        echo $count . '<br>';
                ?>
                <div style="z-index: 12;" class="col-12 col-md-2 mb-3 wait-2s p-3" data-animation="animated ZoomOut">
                    <div class="card_work_home/ p-0">
                        <div class="text-center w-100 home_card/ p-0">
                            <img style="border-radius: 15px !important; padding: 0;" src="<?= img_path($path, $img_ends, '') ?>" class="img-thumbnail">
                        </div>
                    </div>
                </div>
                <?php 
                    endif;

                    if ( ($count > 1) && ($count % 6) == 0 || ($global_count == ($count + 1)) ):
                        $img_arr[] = ob_get_clean();
                        ob_start();
                    endif;

                    $count ++;
                ?>

            <?php endforeach; ?>
            <?php //var_dump($img_arr) ?>
        </div>
    </div>

</div>