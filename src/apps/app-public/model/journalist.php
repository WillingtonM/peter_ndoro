<?php


$rgst_sql     = "SELECT * FROM media WHERE media_status = 1 AND media_type = ? ORDER BY media_publish_date DESC LIMIT 4";
$rgst_dta     = ['appearance'];
$tvap_qry     = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
