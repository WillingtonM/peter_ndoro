<?php

$page_key     = $page;

$count        = 0;
$rgst_dta     = [];
$rgst_sql     = "SELECT * FROM media WHERE media_status = 1 AND media_type = 'gallery-trainer' ORDER BY media_publish_date DESC LIMIT 1";
$tvap_qry     = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
