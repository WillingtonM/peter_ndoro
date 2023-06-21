<?php

$usr_arr        = null;
$usrt_sql       = "SELECT user_type_id, user_type FROM user_types";
$usrt_dta       = [];
$usrt_qry       = prep_exec($usrt_sql, $usrt_dta, $sql_request_data[1]);

$dft_user_type  = (isset($_POST['user_type']))? $_POST['user_type']:'';
$is_admin       = is_admin_check();

if (isset($_POST['id']) || isset($_POST['user_id'])) :

    $user_id    = $_POST['user_id'];
    $usr_sql    = "SELECT t.user_type, t.user_type_id, u.user_id, u.username, u.name, u.last_name, u.contact_number, u.alt_contact_number, u.email, u.user_position, u.user_listpos, u.user_province, u.user_image, u.user_description FROM users as u INNER JOIN user_types as t ON u.user_type_id = t.user_type_id WHERE u.user_id = ? LIMIT 1";
    $usr_dta    = [$user_id];
    $usr_arr    = prep_exec($usr_sql, $usr_dta, $sql_request_data[0]);
    
endif;

// modal variables
$modal_id         = 'users';
$modal_title      = '';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';
