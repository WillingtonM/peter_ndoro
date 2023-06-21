<?php


$article_title     = (isset($_POST['article_title'])? $_POST['article_title']:'');
$article_post      = (isset($_POST['article_content'])? $_POST['article_content']:'');
$article_type      = (isset($_POST['article_type'])) ? $_POST['article_type'] : false;
$article_id        = (isset($_POST['article_id'])) ? $_POST['article_id'] : false;
$article_link      = (isset($_POST['article_link']))? $_POST['article_link']:'';
$article_publisher = (isset($_POST['article_publisher'])) ? $_POST['article_publisher'] : '';
$article_author    = (isset($_POST['article_author']))?$_POST['article_author']:'';
$article_source    = (isset( $_POST['article_source']))? $_POST['article_source']:'';
$article_pubdate   = (isset($_POST['article_publish_date']))?$_POST['article_publish_date']:'';

$artcl_date        = DateTime::createFromFormat('Y-m-d', $article_pubdate);



$file_content      = (isset($_POST['file_content']))? $_POST['file_content']:'';

// echo $file_content;


// modal variables
$modal_id         = 'article_view';
$modal_title      = '<i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp; Article View';
$modal_size       = 'modal-lg';

$modal_backdrop   = true;
$modal_screen     = 'modal-fullscreen-md-down';
$modal_centered   = 'modal-dialog-centered';
$modal_scrollable = 'modal-dialog-scrollable';