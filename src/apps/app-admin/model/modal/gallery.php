<?php
unset($_SESSION['media_id']);

$media_id 		= (isset($_POST['media_id']))?$_POST['media_id']:0;

$type 			= (isset($_POST['type']))? $_POST['type'] : '';
$media_res 		= null;
if (!empty($media_id)) {
	$media_res 	= get_media_by_id($media_id);

    $dir_url    = ABS_GALLERY . $media_res['media_image'] . DS;
}


// modal variables
$modal_id         = 'galleryModal';
$modal_title      = '';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';