<?php

$search = (isset($_GET['search']))?urldecode($_GET['search']):'';

if (!empty($search)) {

  $req_sql = "SELECT article_id, article_title, article_type, article_link, article_publisher, article_publish_date, article_content, article_source, article_image, article_author, article_status, article_date_created, user_id FROM articles WHERE article_title LIKE '%$search%' OR article_content LIKE '%$search%' AND article_status = 1 ORDER BY article_date_created DESC LIMIT 15";
  $req_dta = [];
  $req_res = prep_exec($req_sql, $req_dta, $sql_request_data[1]);

}
