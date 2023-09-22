<?php

$testimonial_id   = (isset($_POST['testimonial_id']))?sanitize($_POST['testimonial_id']):'';

$testimonial      = get_testimonial_by_id($testimonial_id);

var_dump($testimonial_id);

$testimonial_type = (isset($_POST['type'])) ? $_POST['type'] : ((isset($testimonial['testimonial_type'])) ? $testimonial['testimonial_type'] : '' );

// modal variables
$modal_id         = 'testimonials';
$modal_title      = '';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';
