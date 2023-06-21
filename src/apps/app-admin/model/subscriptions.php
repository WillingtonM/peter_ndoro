<?php

$cnt_sql = "SELECT subscription_id, subscription_name, subscription_last_name, AES_DECRYPT(subscription_email, UNHEX('$email_key')) subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_edit, subscription_status FROM email_subscription";
$cnt_dta = [];
$cnt_res = prep_exec($cnt_sql, $cnt_dta, $sql_request_data[1]);

if (isset($_GET['subs']) && $_GET['subs'] == 'all') {
    $req_sql = "SELECT subscription_id, subscription_name, subscription_last_name, AES_DECRYPT(subscription_email, UNHEX('$email_key')) subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_edit, subscription_status FROM email_subscription";
} else {
    $req_sql = "SELECT * FROM (SELECT subscription_id, subscription_name, subscription_last_name, AES_DECRYPT(subscription_email, UNHEX('$email_key')) subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_edit, subscription_status FROM email_subscription ORDER BY subscription_id DESC LIMIT 50) email_subscription ORDER BY subscription_id ASC";
}
$req_dta = [];

$subscribers    = prep_exec($req_sql, $req_dta, $sql_request_data[1]);
$count          = 1;
