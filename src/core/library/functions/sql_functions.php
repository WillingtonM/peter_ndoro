<?php
$key        = constant("MERCHANT_KEY");
$email_key  = constant("EMAIL_KEY");
$date       = date('Y-m-d H:i:s');


// -----------------------------------------------------------------------------
// settings

function get_seetings () {
  global $sql_request_data;

  $sql_stmnt  = "SELECT * FROM settings WHERE user_id = ? LIMIT 1";
  $sql_data   = [1];

  $sql_res    = prep_exec($sql_stmnt, $sql_data, $sql_request_data[0]);
  if (!$sql_res) {
    $header   = '<p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center"><span style="color: #44546A; font-size: 18px;">I have just published a new article, please find the full text below.</span> </p>';
    $footer   = '<p style="margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;"><span style="color:#44546A;">&nbsp;</span></p>
          <p style="margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;"><span style="color:#44546A;">Regards,</span></p>
          <p style="margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;"><span style="color:#44546A;">'. PROJECT_TITLE .' </span></p>
          <p style="margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;border:none;padding:0cm;"><span style="color:#44546A;">&nbsp;</span></p>';
    $sql_ins  = "INSERT INTO settings (user_id, setting_email_header, setting_email_footer) VALUES (1, ?, ?)";
    $sql_dta  = [$header, $footer];

    $sql_res  = prep_exec($sql_ins, $sql_dta, $sql_request_data[0]);
  }

  return $sql_res;
}

// -----------------------------------------------------------------------------
// user

function check_user($user_id)
{
  global $sql_request_data;

  $sql_stmnt   = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
  $sql_data   = [$user_id];

  return (prep_exec($sql_stmnt, $sql_data, $sql_request_data[0])) ? true : false;
}

function get_user_by_id($user_id)
{
  global $sql_request_data;

  $sql_stmnt   = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
  $sql_data   = [$user_id];

  return ($sql_result = prep_exec($sql_stmnt, $sql_data, $sql_request_data[0])) ? $sql_result : null;
}

function get_user_by_username($username)
{
  global $sql_request_data;

  $sql_stmnt  = "SELECT * FROM users WHERE username = ? LIMIT 1";
  $sql_data   = [$username];

  return ($sql_result = prep_exec($sql_stmnt, $sql_data, $sql_request_data[0])) ? $sql_result : null;
}

function get_user_by_email($email)
{
  global $sql_request_data;

  $sql_stmnt  = "SELECT * FROM users WHERE email = ? LIMIT 1";
  $sql_data   = [$email];

  return ($sql_result = prep_exec($sql_stmnt, $sql_data, $sql_request_data[0])) ? $sql_result : null;
}

function get_users () {
  global $sql_request_data;

  $req_sql = "SELECT * FROM users WHERE user_status = 1 ORDER BY user_id DESC";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function get_user_by_usertype($usertype)
{
  global $sql_request_data;

  $cnt_sql = "SELECT * FROM afadwu_users as u INNER JOIN user_types ut ON ut.user_type_id = u.user_type_id WHERE ut.user_type = ? AND user_status = 1";
  $cnt_dta = [$usertype];
  return ($cnt_res = prep_exec($cnt_sql, $cnt_dta, $sql_request_data[1])) ? $cnt_res : null;
}

function get_media_by_id($article_id)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM media WHERE media_id = ? LIMIT 1";
  $req_dta = [$article_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_media_by_title($article_title, $media_type = '')
{
  global $sql_request_data;

  $ext_sql = (!empty($media_type)) ? " AND media_type = ? " : "";
  $req_sql = "SELECT * FROM media WHERE media_title = ? $ext_sql LIMIT 1";
  $req_dta = (!empty($media_type)) ? [$article_title, $media_type] : [$article_title];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_media_by_media_type($article_type)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM media WHERE media_type = ? AND media_status = 1 ORDER BY media_publish_date DESC";
  $req_dta = [$article_type];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function count_media_by_media_type($article_type)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM media WHERE media_type = ? AND media_status = 1";
  $req_dta = [$article_type];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[3])) ? $req_res : null;
}

function get_comment_replies_by_comment_id($comment_id)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM article_comments WHERE article_comment_type = 1 AND article_comment_status = 1 AND comment_id = ? ORDER BY article_comment_date_created";
  $req_dta = [$comment_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function get_article_by_id($article_id)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM articles WHERE article_id = ? LIMIT 1";
  $req_dta = [$article_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_article_by_title($article_title)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM articles WHERE article_title = ? LIMIT 1";
  $req_dta = [$article_title];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function update_article_by_id($article_id)
{
  global $sql_request_data;

  $req_sql = "UPDATE articles SET article_sent = 1 WHERE article_id = ? LIMIT 1";
  $req_dta = [$article_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[2])) ? $req_res : null;
}

function get_article_commennts_by_id($blog_id)
{
  global $sql_request_data;

  $userkey    = constant("USER_INFO_KEY");

  $sql_stmnt  = "SELECT * FROM article_comments WHERE article_id = ?";
  $sql_data   = [$blog_id];

  return ($sql_result = prep_exec($sql_stmnt, $sql_data, $sql_request_data[1])) ? $sql_result : null;
}

function get_article_by_type($article_type, $limit = 255)
{
  global $sql_request_data;

  $userkey    = constant("USER_INFO_KEY");

  $sql_stmnt  = "SELECT * FROM articles WHERE article_type = ? AND article_status = 1 ORDER BY article_publish_date DESC LIMIT $limit";
  $sql_data   = [$article_type];

  return ($sql_result = prep_exec($sql_stmnt, $sql_data, $sql_request_data[1])) ? $sql_result : null;
}

function get_article_visits_count($article_id)
{
  global $sql_request_data;

  $cnt_sql = "SELECT * FROM article_visits WHERE article_id = ?";
  $cnt_dta = [$article_id];
  return ($cnt_res = prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3])) ? $cnt_res : 0;
}


// ****************************************************************************************
// events 

function get_event_by_date($event_host_date)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT * FROM events WHERE event_host_date = ? LIMIT 1";
  $req_dta = [$event_host_date];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_event_by_id($event_id)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT * FROM events WHERE event_id = ? LIMIT 1";
  $req_dta = [$event_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_event_by_email($email)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT * FROM events WHERE event_user_email = ? LIMIT 1";
  $req_dta = [$email];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_events()
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM events ORDER BY event_date_created DESC";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function get_events_by_type($event_type)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM events WHERE event_type = ? AND event_processed = 0 ORDER BY event_date_created DESC";
  $req_dta = [$event_type];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function get_events_processed()
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM events WHERE event_processed = 1 ORDER BY event_date_created DESC";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}


function get_page_content_by_name($page_content_name)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM page_contents WHERE page_content_name = ? LIMIT 1";
  $req_dta = [$page_content_name];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_services()
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM services ORDER BY service_date_created DESC";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

function get_service_by_id($service_id)
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM services WHERE service_id = ? LIMIT 1";
  $req_dta = [$service_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

// **************************************************************************************************
// subscriptions

function get_subscriber_by_id($subscription_id)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT subscription_id, subscription_name, subscription_last_name, subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_edit, subscription_status FROM email_subscription WHERE subscription_id = ? LIMIT 1";
  $req_dta = [$subscription_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

function get_subscriber_by_email($subscription_email)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT subscription_id, subscription_name, subscription_last_name, subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_edit, subscription_status FROM email_subscription WHERE subscription_email = ? LIMIT 1";
  $req_dta = [$subscription_email];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}


function get_subscribers()
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT subscription_id, subscription_name, subscription_last_name, subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_status FROM email_subscription WHERE subscription_status = 1";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}

// API users
function get_api_by_user_id($user_id)
{
  global $sql_request_data, $email_key;

  $req_sql = "SELECT * FROM api_users WHERE user_id = ? LIMIT 1";
  $req_dta = [$user_id];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[0])) ? $req_res : null;
}

// feedback ***********************************************************************************
function get_feedback() 
{
  global $sql_request_data;

  $req_sql = "SELECT * FROM feedback WHERE feedback_status = 1 ORDER BY feedback_date_created DESC";
  $req_dta = [];
  return ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1])) ? $req_res : null;
}
