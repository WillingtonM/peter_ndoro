<?php

$rgst_sql       = "SELECT * FROM users WHERE user_type != 'guest' AND user_status = 1 ORDER BY date_created DESC";
$rgst_dta       = [];
$nwsf_qry       = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);

if (is_array($nwsf_qry) || is_object($nwsf_qry)) {
    $labels = [];
    $data   = [];
    $colors = [];
    foreach ($nwsf_qry as $key => $value) {
        
        $cnt_sql        = "SELECT count(*) FROM notifications WHERE user_id = ?  AND notification_status = 1";
        $cnt_dta        = [$value['user_id']];
        $artcl_count    = (int) prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3]);
        
        $col_key        = array_rand($colors_array);
        $labels[]       = $value['username'];
        $colors[]       = $colors_array[$col_key]['rgb'];
        $data[]         = $artcl_count;


    }
}

// modal variables
$modal_id         = 'user_activities';
$modal_title      = '<i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp; Article View';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';