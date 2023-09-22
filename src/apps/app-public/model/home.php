<?php

$clients_sql    = "SELECT * FROM testimonials WHERE testimonial_status = 1 ORDER BY testimonial_date_created DESC LIMIT 6";;
$clients_dta    = [];

$clients        = prep_exec($clients_sql, $clients_dta, $sql_request_data[1]);


// client images

$clients_imgs   = ABS_CLIENTS; 

$imgs           = glob($clients_imgs.'*.*', GLOB_BRACE);
$global_count   = count($imgs);

$global_floor   = floor($global_count / 6);
$minim_floor    = $global_floor * 6;

$count          = 1;
$img_arr        = [];
ob_start(); 
foreach ($imgs AS $img):
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
        ?>
        <div style="z-index: 12;" class="col-12 col-md-2 mb-3 wait-2s p-3" data-animation="animated ZoomOut">
            <div class="card_work_home/ p-0">
                <div class="text-center w-100 home_card/ px-4">
                    <img style="border-radius: 15px !important; padding: 0;" src="<?= img_path($path, $img_ends, '') ?>" class="img-thumbnail border-white">
                </div>
            </div>
        </div>
        <?php
    endif;

    if ( ($count > 1) && ($count % 6) == 0 ):
        $img_arr[] = ob_get_clean();
        ob_start();
    elseif (($count) == $global_count):
        $img_arr[] = ob_get_clean();
    endif;

    $count ++;
endforeach;
// $img_arr[] = ob_get_clean();
