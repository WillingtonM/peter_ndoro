<?php

$event_type         = (isset($_POST['type']) && key_exists($_POST['type'], $services_navba)) ? $_POST['type'] : $services_navba[0]['short'];

// modal variables
$modal_id           = 'events';
$modal_title        = '';
$modal_size         = 'modal-lg';

$modal_backdrop     = true;
$modal_screen       = 'modal-fullscreen-md-down';
$modal_centered     = 'modal-dialog-centered';
$modal_scrollable   = 'modal-dialog-scrollable';