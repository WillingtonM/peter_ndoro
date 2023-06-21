<?php

$usr_arr     = null;
$last_key    = null;
$is_admin    = is_admin_check();

if (isset($_POST['member']) && $_POST['member'] !== 'add' ) :

    $user_id    = $_POST['member'];
    $usr_arr    = get_member_by_member_id($user_id);

    $last_key   = member_state($usr_arr)['key_text'];
    $mbr_proc   = ($usr_arr)? $usr_arr['member_time_type']:'';

endif;



// modal variables
$modal_id         = 'members';
$modal_title      = '';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';
