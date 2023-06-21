<?php
$member = null;
$user_type = (isset($_GET['usr_type']))? $_GET['usr_type']:'';

if (isset($_GET['usr']) && isset($_SESSION['user_id'])) {
    $member_id  = $_GET['usr'];

    if ($user_type == 'client') {
        $member     = get_user_by_id($member_id);
    } else {
        $member     = get_member_by_member_id($member_id);
        $clients    = get_association_user_by_member_id($member_id);
    }
}