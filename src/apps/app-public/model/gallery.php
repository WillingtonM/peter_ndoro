<?php
$value          = null;

$data           = array('error' => false);
$intval         = 9;
$artcl_count    = 1;
$array_count    = 0;
$tabbs_count    = 0;

$media_id       = (isset($_GET['uid'])) ? $_GET['uid'] : '';
$media_path     = (isset($_GET['p'])) ? $_GET['p'] : '';

$value          = get_media_by_id($media_id);

if (!$data['error'] && empty($value)) {
    $data['error']      = true;
    $data['message']    = 'Media gallery does not exists, might have been deleted';
}

if (!$data['error'] && empty($media_path)) {
    $data['error']      = true;
    $data['message']    = 'Media gallery does not exists, might have been deleted';
}

if ( is_array($value) || is_object($value)) {
    $myDateTime     = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); 
    $img_dir        = ABS_GALLERY . $value['media_image'] . DS; 
}
