<?php
$data = array('error' => false, 'message' => '');
$pass = (isset($_GET['password']))? urldecode($_GET['password']):'';
$usnm = (isset($_GET['username']))? $_GET['username']:'';

if (($pass == '{GracelinB}' && $usnm == 'gracelin') || (isset($_SESSION['tmp_user']) && $_SESSION['tmp_user'] == true)) {
    $_SESSION['tmp_user'] = 'true';
    redirect_to('home');
} elseif (isset($_GET['username']) && isset($_GET['password'])) {
    $data['error']      = true;
    $data['message']    = "Username and password combination are incorrect";
} else {
    // redirect_to('home');
}
