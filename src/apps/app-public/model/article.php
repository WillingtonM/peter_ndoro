<?php
$cnt          = 0;
$req_res      = null;

if (isset($_GET['slgid']) && isset($_GET['type']) ) {
  $date         = date('Y-m-d H:i:s');
  $article_id   = (isset($_GET['slgid']))?$_GET['slgid']:false;
  $article_type = (isset($_GET['type']))?$_GET['type']:'';
  
  // check article visit
  $ip_addr = get_client_ip();
  $vst_sql = "SELECT ip_address FROM article_visits WHERE ip_address = ? AND article_id = ? LIMIT 1";
  $vst_dta = [$ip_addr, $article_id];

  
  if ($vst_res = prep_exec($vst_sql, $vst_dta, $sql_request_data[0])) {
    $vst_sql = "UPDATE article_visits SET visit_date_updated = ? WHERE article_id = ? LIMIT 1";
    $vst_dta = [$date, $article_id];
  } else {
    $vst_sql = "INSERT INTO article_visits (ip_address, article_id, visit_date_created) VALUES (?, ?, ?)";
    $vst_dta = [$ip_addr, $article_id, $date];
  }
  // attempt to execute sql
  prep_exec($vst_sql, $vst_dta, $sql_request_data[2]);
  
  // select article
  $req_res = get_article_by_id($article_id);
  // get first 3 comment ;

  $cmnt_sql = "SELECT * FROM article_comments WHERE article_id = ? AND article_comment_type = 0 AND article_comment_status = 1 ORDER BY article_comment_date_created LIMIT 3";
  $cmnt_dta = [$article_id];
  $cmnt_res = prep_exec($cmnt_sql, $cmnt_dta, $sql_request_data[1]);

  $cnt_res  = get_article_visits_count($article_id);

  // article db date
  $artcl_date     = DateTime::createFromFormat('Y-m-d H:i:s', $req_res['article_publish_date']);
  $artcl_dateud   = DateTime::createFromFormat('Y-m-d H:i:s', $req_res['article_date_updated']);
  $article_link   = urlencode(host_url('/article?article=' . $slugify->slugify($req_res["article_title"]) . '&slgid=' . $req_res["article_id"] . '&type=' . $req_res["article_type"]));
}
