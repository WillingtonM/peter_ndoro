<?php

$event_id   = (isset($_POST['event_id']))?sanitize($_POST['event_id']):'';

$event      = get_event_by_id($event_id);
$services   = get_services();

$event_type = (isset($_POST['type'])) ? $_POST['type'] : $event['event_type'];

// modal variables
$modal_id         = 'events';
$modal_title      = '';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';
