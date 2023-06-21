<?php

$image_modify_paths = array('', 'square', 'rect');

// echo array_key_exists($image_modify_paths[3], $image_modify_paths);

if (empty($image_modify_paths[0])) {
    // echo 'string';
}


$social_media = array(
    'facebook'  => array(
        'name' => 'facebook',
        'user' => '',
        'font' => 'fab fa-facebook',
        'link' => 'https://www.facebook.com/gracelin.c.baskaran',
        // 'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/facebook.png',
    ),
    'intagram'  => array(
        'name' => 'instagram',
        'user' => '@gracelin510',
        'font' => 'fab fa-instagram',
        'link' => 'https://www.instagram.com/gracelin510/',
        // 'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/instagram.png',
    ),
    'linkedin'  => array(
        'name' => 'linkedin',
        'user' => '',
        'font' => 'fab fa-linkedin',
        'link' => 'https://www.linkedin.com/in/gracelinbaskaran/',
        // 'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/linkedin.png',
    ),
    'twitter'   => array(
        'name' => 'twitter',
        'user' => '@GraceBaskaran',
        'font' => 'fab fa-twitter',
        'link' => 'https://twitter.com/GraceBaskaran',
        // 'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/twitter.png',
    ),
);

echo $social_media['twitter']['name'];