<?php

$page_key       = $page;

$clinets        = ABS_CLIENTS; 

$imgs           = glob($clinets.'*.*', GLOB_BRACE);
$global_count   = count($imgs);
$output         = '';
$count          = 0;

