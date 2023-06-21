<?php

$type       = (isset($_GET['article_id']))?'edit':'add';
$article_id = (int) (isset($_GET['article_id']))?$_GET['article_id']:NULL;
$req_res    = NULL;
$count      = 0;

if (isset($_GET['article_id'])) {

  $req_sql = "SELECT * FROM articles WHERE article_id = ? AND article_status = 1 LIMIT 1";
  $req_dta = [$article_id];
  $req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0]);

}
