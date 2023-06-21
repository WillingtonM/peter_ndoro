<?php
$is_admin   = is_admin_check();
$tabbs_count = 0;
$allowed_db     = array('members', 'associations');
// if (!$is_admin)  redirect_to('home');


if (isset($_SESSION['user_id'])) {
    $user_id    = $_SESSION['user_id'];
}
