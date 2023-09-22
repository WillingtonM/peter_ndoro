<?php

use Abraham\TwitterOAuth\TwitterOAuth;

if(isset($_POST)) {
  $date     = date('Y-m-d H:i:s');
  $data     = array('error' => '','data' => '', 'success' => false,'message' => '', 'url' => '', 'image' => '');
  $user_id  = (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null)?$_SESSION['user_id']:0;

  $emailkey = constant("EMAIL_KEY");

  if (isset($_FILES["post_image"]["tmp_name"]) && $_FILES['post_image']['error'] == UPLOAD_ERR_OK && !isset($_SESSION['article_id'])) {

    $user_dir = ARTICLES_URL . 'tmp' . DS;
    $new_name = 'IMGIM' . date("YmddHis");
    $img_name = $_FILES["post_image"]["name"];
    $img_temp = $_FILES["post_image"]["tmp_name"];
    // Be sure we're dealing with an upload
    $image_res = image_validation($img_name, $new_name, $img_temp, $user_dir);
    if ($image_res['success']) {
      $new_name = $new_name . '.' . $image_res['mime_type'];
      if (is_dir($user_dir)) {
        // article_img('tmp', $new_name);

        $data['success']  = $image_res['success'];
        $data['image']    = ABS_ARTICLES . 'tmp' . DS . $new_name;
      } else {
        $data['error']    = true;
        $data['message']  = 'Image was not uploaded successfully';
      }
    } else {
      $data['error']    = $image_res['success'];
    }

    $data['message']  = (empty($data['message'])) ? $image_res['message'] : $data['message'];
  }

  if (isset($_POST['resend_confirm'])) {
    // Prepare to send email
    $user     = get_user_by_id($user_id);

    if (!$user['email_confirm']) {
      $token    = $user['email_confirm_code'];
      $url      = '/confirmation?token='.$token.'&usrkey='.db_hash($user['user_id']).'&uid='.$user['user_id'];

      $full_name = '';
      $email      = $user['email'];

      $to_usrs    = array(
        "name"    => $full_name,
        "email"   => $email
      );

      $client_ifo = array(
        "name"    => $full_name,
        "email"   => $email,
        "message" => "Please confirm your email by clicking below:",
        "url"     => host_url($url),
      );

      $subject  = PROJECT_TITLE . " | Email Confirmation";
      $html     = confirmation_mail($full_name, $client_ifo);

      if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
        $mailer->mail->clearAllRecipients();

        $data['success'] = true;
        $data['message'] = "Email has been sent";
      }
    } else {
      $data['error']    = true;
      $data['message']  = "Email has has already been sent";
    }

  }

  // media apearance type
  if (isset($_POST['media_title']) && isset($_POST['media_content']) && isset($_POST['media_type']) && !isset($_POST['file_type']) && ($_POST['media_type'] == 'appearance' || $_POST['media_type'] == 'podcast')) {

    $media_title    = (isset($_POST['media_title'])) ? $_POST['media_title'] : '';
    $media_content  = (isset($_POST['media_content'])) ? $_POST['media_content'] : '';
    $media_url      = (isset($_POST['media_url']))? $_POST['media_url'] : '';
    $media_pubdate  = (isset($_POST['media_publish_date'])) ? $_POST['media_publish_date'] : '';
    $media_pubdate  = (!empty($media_pubdate)) ? date('Y-m-d H:i:s', strtotime($media_pubdate)) : $media_pubdate;
    $media_type     = (isset($_POST['media_type'])) ? $_POST['media_type'] : '';

    $media_id       = (isset($_POST['media_id']) && !empty($_POST['media_id'])) ? $_POST['media_id']: '';

    if (!$data['error'] && empty($media_title)) {
      $data['error']    = true;
      $data['message']  = "Media title field is empty";
    }

    if (!$data['error'] && empty($media_pubdate)) {
      $data['error']    = true;
      $data['message']  = "Publication date cannot be blank";
    }

    if (!$data['error'] && empty($media_content)) {
      $data['error']    = true;
      $data['message']  = "Media content field is empty";
    }

    $media_check = null;
    $media_check = get_media_by_title($media_title, $media_type);
    if (!$data['error'] && $media_check) {
      $data['error']    = true;
      $data['message']  = "Media tittle already exists";
    }

    $media              = get_media_by_id($media_id);

    if ($media_check && !empty($media) && $media_check['media_id'] == $media_id && $media_check['media_type'] == $media['media_type'] ) {
      $data['error']    = false;
      $data['message']  = "";
    }

    // var_dump($_POST);

    if (!$data['error']) {

      if (!empty($media_id) ) {
        $req_sql = "UPDATE media SET media_title = ?, media_content = ?, media_url = ?, media_publish_date = ? WHERE media_id = ? LIMIT 1";
        $req_dta = [$media_title, $media_content, $media_url, $media_pubdate, $media_id];
      } else {
        $req_sql = "INSERT INTO media (media_title, media_content, media_url, media_type, user_id, media_publish_date, media_date_created) VALUES (?,?,?,?,?,?,?)";
        $req_dta = [$media_title, $media_content, $media_url, $media_type, $user_id, $media_pubdate, $date];
      }

      if (prep_exec($req_sql, $req_dta, $sql_request_data[2])) {
        $message          = (!empty($media_id)) ? 'updated' : 'published';
        $data['success']  = true;
        $data['message']  = "Your media content hab been " . $message;
        $data['delayed']  = true;
        $data['seconds']  = 7000;
        $data['url']      = "refresh";
      } else {
        $data['error']    = true;
        $data['message']  = "There was an error on updating your media content";
      }
    }
  }

  // media remove
  if (isset($_POST['media_remove']) && $_POST['media_remove'] && isset($_POST['media_id'])) {
    $media_id = $_POST['media_id'];

    if (!empty($media_id)) {
      $req_sql = "UPDATE media SET media_status = 0 WHERE media_id = ? LIMIT 1";
      $req_dta = [$media_id];
      if (prep_exec($req_sql, $req_dta, $sql_request_data[2])) {
        $data['url'] = "refresh";
        $data['delayed'] = true;
        $data['seconds'] = 7000;
        $data['success'] = true;
        $data['message'] = "Media has been removed";
      } else {
        $data['error']   = true;
        $data['message'] = "Something went wrong, and your media is not removed";
      }
    }
  }

  // article content
  if (isset($_POST['article_title']) && isset($_POST['article_content'])) {

    unset($_SESSION['article_id']);
    $article_title     = sanitize($_POST['article_title']);
    $article_post      = $_POST['article_content'];
    $article_type      = (isset($_POST['article_type']))?$_POST['article_type']:false;
    $article_id        = (isset($_POST['article_id']))?$_POST['article_id']:false;
    $article_link      = $_POST['article_link'];
    $article_publisher = (isset($_POST['article_publisher']))?$_POST['article_publisher']:'';
    $article_author    = $_POST['article_author'];
    $article_source    = $_POST['article_source'];
    $article_pubdate   = $_POST['article_publish_date'];
    
    
    $article_file      = ((isset($_POST['file_name']))? $_POST['file_name']:'');
    
    $cronjob           = (isset($_POST['cronjob'])) ? 1 : 0;
    $cronjob_status    = $cronjob;
    
    // cron date
    $dob               = (isset($_POST['dob']))? $_POST['dob']:'';
    $mob               = (isset($_POST['mob']))? $_POST['mob']:'';
    $yob               = (isset($_POST['yob']))? $_POST['yob']:'';
    $hour              = (isset($_POST['hour']))? $_POST['hour']:'';
    
    $cronjob_date      = (!empty($dob) && !empty($mob) && !empty($yob))? date("Y-m-d H:i:s", strtotime($yob . '/' . $mob . '/' . $dob . ' ' . $hour . ':0:0')):'';

    if (!empty($article_post)) {
      // $article_post = json_encode($article_post);
      // $article_post = json_decode($article_post);
      // $article_post = $article_post['content'];
    }

    if (empty($article_pubdate)) {
      $data['error']    = true;
      $data['message']  = "Provide article published date";
    }

    if (get_article_by_title($article_title) && empty($article_id) && !empty($article_title) ) {
      $data['error']    = true;
      $data['message']  = "The aticle title already exists, consider changing the title of your article";
    }

    if (empty($article_title) && !$data['error']) {
      $data['error']    = true;
      $data['message']  = "Article title field is empty";
    } elseif (empty($article_post) && !$data['error']) {
      $data['error']    = true;
      $data['message']  = "Article content field is empty";
    }

    if (!in_array($article_type, $article_types) && !$data['error']) {
      $data['error']    = true;
      $data['message']  = "The article type mentioned is not supported";
    } elseif (!$article_type && !$data['error']) {
      $data['error']    = true;
      $data['message']  = "Please choose article type";
    }

    if (!empty($article_link)) {
      if (!check_url($article_link)) {
        $data['error']   = true;
        $data['message'] = "The link provided is incorrect";
      }
    }

    if (!isset($_SESSION['user_id'])) {
      $data['error']    = true;
      $data['message']  = "You are not logged in, please refresh the page and attempt tp login";
    }

    if (!$data['error']) {
      if (empty($article_id)) {
        $article_sql = "INSERT INTO articles (user_id, article_title, article_author, article_link, article_file, article_publisher, article_source, article_content, article_type, article_cronjob, article_cronjob_status, article_cronjob_date, article_publish_date, article_date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $article_dta = [$user_id, $article_title, $article_author, $article_link, $article_file, $article_publisher, $article_source, $article_post, $article_type, $cronjob, $cronjob_status, $cronjob_date, $article_pubdate, $date];
      } else {
        $db_article = get_article_by_id($article_id);
        if ($db_article['article_cronjob_status'] == 0 && $cronjob == 1) {
          $article_sql = "UPDATE articles SET user_id = ?, article_title = ?, article_author = ?, article_link = ?, article_file = ?, article_publisher = ?, article_source = ?, article_content = ?, article_type = ?, article_cronjob = ?, article_cronjob_status = ?, article_publish_date = ? WHERE article_id = ? LIMIT 1";
          $article_dta = [$user_id, $article_title, $article_author, $article_link, $article_file, $article_publisher, $article_source, $article_post, $article_type, $cronjob, $cronjob_status, $article_pubdate, $article_id];
        } elseif ($db_article['article_cronjob_status'] == 1 && $db_article['article_sent'] == 0) {
          $article_sql = "UPDATE articles SET user_id = ?, article_title = ?, article_author = ?, article_link = ?, article_file = ?, article_publisher = ?, article_source = ?, article_content = ?, article_type = ?, article_cronjob = ?, article_cronjob_status = ?, article_cronjob_date = ?, article_publish_date = ? WHERE article_id = ? LIMIT 1";
          $article_dta = [$user_id, $article_title, $article_author, $article_link, $article_file, $article_publisher, $article_source, $article_post, $article_type, $cronjob, $cronjob_status, $cronjob_date, $article_pubdate, $article_id];
        } else {
          $article_sql = "UPDATE articles SET user_id = ?, article_title = ?, article_author = ?, article_link = ?, article_file = ?, article_publisher = ?, article_source = ?, article_content = ?, article_type = ?, article_cronjob = ?, article_publish_date = ? WHERE article_id = ? LIMIT 1";
          $article_dta = [$user_id, $article_title, $article_author, $article_link, $article_file, $article_publisher, $article_source, $article_post, $article_type, $cronjob, $article_pubdate, $article_id];
        }
      }

      if($sbscrp_qry = prep_exec($article_sql, $article_dta, $sql_request_data[2])) {
        $data['success'] = true;
        $data['message'] = "Your article has been updated!";
        $_SESSION['article_id'] = (!empty($article_id))?$article_id:$connect->lastInsertId();

        $dir_url = FILES_URL . 'tmp' . DS;
        if (!empty($article_file) && file_exists($dir_url . $article_file)) {
          if (rename($dir_url . $article_file, FILES_URL . $article_file)) {
            $data['data'] = 'File updated';
          }
        }

        if (empty($article_id) && $cronjob ===  0) {
          $_SESSION['cronjob'] = false;
        }

      }
    }
  }

  // article image
  if(!empty($_FILES['post_image']) && ($_FILES['post_image']['error'] == UPLOAD_ERR_OK && isset($_SESSION['article_id'])))
  {
    clearstatcache();
    $article_id     = $_SESSION['article_id'];
    $user           = get_user_by_id($user_id);
    $dir_url        = $config["MEDIA_URL"];

    $article_sql = "SELECT * FROM articles WHERE article_id = ? LIMIT 1";
    $article_dta = [$article_id];

    if ($article = prep_exec($article_sql, $article_dta, $sql_request_data[0])) {

      $user_dir = ARTICLES_URL . $article['article_type'] .DS;
      $new_name = 'IMGIM' . date("YmddHis");
      $img_name = $_FILES["post_image"]["name"];
      $img_temp = $_FILES["post_image"]["tmp_name"];
      // Be sure we're dealing with an upload
      $image_res = image_validation($img_name, $new_name, $img_temp, $user_dir);
      if ( $image_res['success'] ) {

        $img_name = $new_name . '.'. $image_res['mime_type'];
        $img_sql = "UPDATE articles SET article_image = ?, user_id = ? WHERE article_id = ? LIMIT 1";
        $img_dta = [$img_name, $user_id, $article_id];

        if (prep_exec($img_sql, $img_dta, $sql_request_data[2])) {
          $data['success']  = true;
          $data['message']  = "Article has been succesfully created";

          if(!isset($_SESSION['cronjob']) ){
            unset($_SESSION['article_id']);
          } else {
            $_SESSION['imgupload'] = true;
          }

        } else {
          $data['error']    = true;
          $data['message']  = "Image was not successfully updated";
        }

      } else {
        $data['error']    = $image_res['success'];
        $data['message']  = (empty($data['message']))?$image_res['message']:$data['message'];
      }
    } else {
      $data['error']      = true;
      $data['message']    = "Article was not found";
    }

    clearstatcache();

  }

  // article cronjob
  if ( isset($_SESSION['cronjob']) && isset($_SESSION['article_id']) && isset($_SESSION['imgupload']) ) {

    $publication    = (isset($_POST['subscription_publish'])) ? 1 : 0;

    $article_id     = $_SESSION['article_id'];
    // Prepare to send email
    $article        = get_article_by_id($article_id);
    $article_title  = $article['article_title'];
    $article_type   = $article['article_type'];
    $article_post   = $article['article_content'];
    $article_author = $article['article_author'];
    $article_image  = $article['article_image'];
    $article_pubdat = $article['article_publish_date'];
    $article_slg    = $slugify->slugify($article_title);

    $url            = '/article?article=' . $article_slg . '&slgid=' . $article_id . '&type=' . $article_type;
    // $url_title      = "New Article";
    $message        = short_paragrapth($article_post, 2500);
    $subject        = PROJECT_TITLE . ' | ' . $article_title;
    $subject        = PROJECT_TITLE . ' | ' . html_entity_decode($article_title, ENT_QUOTES, "UTF-8");
    $subject        = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    $artcl_date     = DateTime::createFromFormat('Y-m-d H:i:s', $article_pubdat);
    // $artcl_date     = DateTime::createFromFormat('Y-m-d', $article_pubdat);

    $mail_data      = array(
      "name"        => '',
      "email"       => '',
      "url_info"    => array(
        "url_title" => 'Read more ...',
        "url_link"  => host_url($url),
        "url_reset" => ''
      ),
      "message"     => $message,
      "title"       => htmlspecialchars($article_title, ENT_QUOTES, "UTF-8"),
      // "title"       => html_entity_decode($article_title, ENT_QUOTES, "UTF-8"),
      "author"      => $article_author,
      "date"        => $artcl_date->format('F jS, Y'),
      "image"       => host_url('/' . ABS_ARTICLES . $article_type . DS . $article_image),
    );

    $subscribers    = get_subscribers();

    if ($subscribers != null && $publication === 1) {
      foreach ($subscribers as $user) {
        $full_name      = $user['subscription_name'] . " " . $user['subscription_last_name'];
        $url_reset      = '/action?&distroy=true&mail=' . $user['subscription_email'];

        $to = array(
          array(
            "name"   => $full_name,
            "email"  => $user['subscription_email']
          ),
        );

        $mail_data['name']  = $full_name;
        $mail_data['email'] = $user['subscription_email'];
        $mail_data['url_info']['url_reset'] = host_url($url_reset);

        $html           = general_mail($mail_data);
        if (isset($mailer)) {
          $mailer->mail->clearAllRecipients();
        }

        if ($mailer->mail($to, $subject, $html, MAIL_FROM)) {
          $mailer->mail->clearAllRecipients();
        }
      }

      $data['success'] = true;
      $data['message'] = "Article succesfully published and sent ";
    }

    update_article_by_id($article_id);
    unset($_SESSION['cronjob']);
    unset($_SESSION['article_id']);
    unset($_SESSION['imgupload']);

  }

  // article remove
  if (isset($_POST['article_remove']) && $_POST['article_remove'] && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    $article_tp = $_POST['article_type'];

    if (!empty($article_id)) {
      $req_sql = "UPDATE articles SET article_status = 0 WHERE article_id = ? LIMIT 1";
      $req_dta = [$article_id];
      if (prep_exec($req_sql, $req_dta, $sql_request_data[2])) {
        $data['success'] = true;
        $data['message'] = "Article has been removed";
        $data['url']     = 'articles?' . $article_tp;
      } else {
        $data['error']   = true;
        $data['message'] = "Something went wrong, and your media is not removed";
      }
    }
  }

  // media ************************************************************************************************
  // media content
  if (isset($_POST['media_title']) && isset($_POST['media_type']) && $_POST['media_type'] != 'appearance' && $_POST['media_type'] != 'podcast') {

    unset($_SESSION['media_id']);
    $media_title    = (isset($_POST['media_title'])) ? $_POST['media_title'] : '';
    $media_type     = (isset($_POST['media_type']) && $_POST['media_type'] == 'video') ? 'appearance' : ((isset($_POST['media_type']))? $_POST['media_type'] : '');
    $file_type      = (isset($_POST['file_type'])) ? $_POST['file_type'] : '';
    $media_url      = (isset($_POST['media_url'])) ? $_POST['media_url'] : '';
    $media_id       = (isset($_POST['media_id']) && !empty($_POST['media_id'])) ? $_POST['media_id'] : 0;
    $media_content  = (isset($_POST['media_content'])) ? $_POST['media_content'] : '';
    $media_date     = (isset($_POST['media_publish_date'])) ? $_POST['media_publish_date'] : '';

    $media_image    = ($media_type != 'file' && $media_type != 'appearance') ? $slugify->slugify($media_title) : '';

    if (!$data['error'] && empty($media_title)) {
      $data['error']    = true;
      $data['message']  = "File title can not be blank";
    }

    if (!$data['error'] && empty($media_date)) {
      $data['error']    = true;
      $data['message']  = "Publication date cannot be blank";
    } else {
      $media_date       = (!empty($media_date)) ? date('Y-m-d H:i:s', strtotime($media_date)) : $media_date;
    }

    if (!$data['error']) {
      $chck_sql = "SELECT * FROM media WHERE media_title = ? AND media_type = ? LIMIT 1";
      $chck_dta = [$media_title, $media_type];

      if (prep_exec($chck_sql, $chck_dta, $sql_request_data[0])) {
        if ($media_id == 0) {
          $data['error']      = true;
          $data['message']    = "The title already exists, consider using a different media title";
        } else {
          $media  = get_media_by_id($media_id);
          if ($media['media_title'] != $media_title) {
            $data['error']    = true;
            $data['message']  = "The title already exists, consider using a different media title";
          }
        }
      }

      if ($file_type == 'video') {
        $img_dir  = VIDEOS_URL;
        $tmp_dir  = $img_dir . 'tmp' . DS;

        $tmp_glb  = glob($tmp_dir . '*');
        // var_dump($tmp_glb);

        if (count($tmp_glb) !== 0) {
          foreach ($tmp_glb as $tmp_file) {
            $img_exp  = explode(DS, $tmp_file);
            $img_name = end($img_exp);
            $new_file = $img_dir . $img_name;
            // rename($file, );
          }

          $media_image  = $img_name;
        } else {
            $data['error']    = true;
            $data['message']  = "There was an error in uploading the video";
        }
      }

      if (!$data['error']) {
        $old_image_url = '';

        if ($media_id) {
          if ($media_type != 'file') {
            $old_image_url =  get_media_by_id($media_id)['media_image'];
          }

          $inst_sql   = "UPDATE media SET media_title = ?, media_content = ?, media_url = ?, media_type = ?, media_file_type = ?, media_image = ?, media_publish_date = ?, user_id = ? WHERE media_id = ? LIMIT 1";
          $inst_dta   = [$media_title, $media_content, $media_url, $media_type, $file_type, $media_image, $media_date, $user_id, $media_id];
        } else {
          if ($media_type == 'file') {
            $media_image =  '';
          }

          $inst_sql   = "INSERT INTO media (media_title, media_content, media_url, media_type, user_id, media_file_type, media_image, media_publish_date, media_date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $inst_dta   = [$media_title, $media_content, $media_url, $media_type, $user_id, $file_type, $media_image, $media_date, $date];
        }

        if (prep_exec($inst_sql, $inst_dta, $sql_request_data[2])) {
          $media_id = ($media_id == 0) ? $connect->lastInsertId() : $media_id;

          if ($file_type == 'video' && file_exists($tmp_file)) {
            rename($tmp_file, $new_file);
          }

          $data['url']      = "refresh";
          $data['success']  = true;
          $data['message']  = "Media content has been succesfully updated";

          if ($file_type != 'video') {
            if ($media_image != '') {
              $img_dir  = GALLERY_URL;
              $tmp_dir  = $img_dir . 'tmp' . DS;
              $gal_dir  = $img_dir . $media_image . DS;

              if (!is_dir($gal_dir) && !file_exists($gal_dir)) {
                mkdir($gal_dir, 0777, true);

                $edit_img = (isset($old_image_url) && $old_image_url != $media_image) ? true : false;
              }

              $old_dir    = $img_dir . $old_image_url . DS;
              $old_files  = glob($old_dir . '*.*');

              if (isset($edit_img) && $edit_img) {
                foreach ($old_files as $file) {
                  $img_exp  = explode(DS, $file);
                  $img_name = end($img_exp);
                  rename($file, $gal_dir . $img_name);
                }
              }

              $files      = glob($tmp_dir . '*.*');

              foreach ($files as $file) {
                $img_exp  = explode(DS, $file);
                $img_name = end($img_exp);
                rename($file, $gal_dir . $img_name);
              }

              foreach ($files as $file) {
                if (is_file($file)) {
                  unlink($file);
                }
              }
            } else {
              $_SESSION['media_id'] = $media_id;
            }
          }
          
        }
      }
    }
  }

  // media file docs
  if (!empty($_FILES['file_doc']) && ($_FILES['file_doc']['error'] === UPLOAD_ERR_OK)) {

    if (is_uploaded_file($_FILES['file_doc']['tmp_name']) === false) {
      $data['error']    = true;
      $data['messages'] = "Error on upload: Invalid file definition";
    } else {

      if (isset($_SESSION['media_id'])) {

        $media_id     = $_SESSION['media_id'];

        $image        = $_FILES['file_doc'];
        $img_temp     = $image['tmp_name'];

        $prod_sql     = "SELECT media_id, media_image, media_type, media_title FROM media WHERE media_id = ? LIMIT 1";
        $prod_dta     = [$media_id];

        if ($media = prep_exec($prod_sql, $prod_dta, $sql_request_data[0])) {
          $crnt_img   = $media['media_image'];
          $orgn_name  = $slugify->slugify($media['media_title']);
          $media_type = $media['media_type'];
          $dir_url    = FILES_URL;

          // Rename the uploaded file
          $img_name   = $image['name'];
          $img_type   = strtolower(substr($img_name, strripos($img_name, '.') + 1));
          $img_name   = $orgn_name . '.' . $img_type;

          $img_dir    = $dir_url;
          $img_url    = $img_dir . DS . $img_name;

          $media_sql  = "UPDATE media SET media_image = ? WHERE media_id = ? LIMIT 1";
          $media_dta  = [$img_name, $media_id];

          if (prep_exec($media_sql, $media_dta, $sql_request_data[2])) {

            if (!is_dir($img_dir) && !file_exists($img_dir)) {
              mkdir($img_dir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $img_url)) {
              $tmp_dir  = MEDIA_TMP;
              // $files    = glob($tmp_dir.'*');
              // foreach ($files as $file) {
              //   unlink($file);
              // }

              // $data['success']  = true;
              // $data['message']  = "Successfully added file";
              unset($_SESSION['media_id']);

              if (file_exists($img_dir . $crnt_img) && is_file($img_dir . $crnt_img)) {
                unlink($img_dir . $crnt_img);
              }
            }
          }
        }
      } else {

        $dir_url      = FILES_URL;
        $image        = $_FILES['file_doc'];
        $img_temp     = $image['tmp_name'];

        $new_name     = 'FILE' . date("YmddHis");
        // Rename the uploaded file
        $img_name   = $image['name'];
        $img_type   = strtolower(substr($img_name, strripos($img_name, '.') + 1));
        $img_name   = $new_name . '.' . $img_type;

        $img_dir    = $dir_url . 'tmp';
        $img_url    = $img_dir . DS . $img_name;

        if (!is_dir($img_dir) && !file_exists($img_dir)) {
          mkdir($img_dir, 0777, true);
        }

        if (move_uploaded_file($image['tmp_name'], $img_url)) {
          $tmp_dir  = MEDIA_TMP;
          $files    = glob($tmp_dir . '*');
          // foreach ($files as $file) {
          //   if( is_file($file) ) {
          //     unlink($file);
          //   }
          // }

          $apnd = '#page=1&zoom=75';

          $data['data']     = $img_name;
          $data['success']  = true;
          // $data['message']  = "Successfully added file";
          $data['image']    = ABS_FILES . 'tmp' . DS . $img_name . $apnd;
        }
      }
    }
  }
  
  // media video
  if ( isset($_FILES["video_file"]) && !empty($_FILES["video_file"]) ) {

    if ($_FILES['video_file']['error'] === UPLOAD_ERR_OK) {

      //uploading successfully done
      if (is_uploaded_file($_FILES['video_file']['tmp_name']) === false) {
        $data['error']    = true;
        $data['messages'] = "Error on upload: Invalid file definition";
      } else {

        if (isset($_SESSION['media_id'])) {

          $media_id     = $_SESSION['media_id'];

          $image        = $_FILES['video_file'];
          $img_temp     = $image['tmp_name'];
          $file_size    = $image["size"];
          $file_type    = $image["type"];

          if ($file_type != "video/mp4" && $file_type != "video/mpeg" && $file_type != "video/quicktime" && $file_type != "video/x-msvideo" && $file_type != "video/x-ms-wmv" && $file_type != "video/webm") {
            $data['error']    = true;
            $data['message']  =  "Invalid file type. Allowed file types are MP4, MPEG, QuickTime, AVI, WMV, and WebM.";
          } 

          if ($file_size > ((int) FILE_SIZE["video"] * 1000000)) {
            $data['error']    = true;
            $data['message']  =  "The file is too large. Maximum file size is " . FILE_SIZE["video"] . " MB.";
          }

          if (!$data['error']) {
            $prod_sql     = "SELECT media_id, media_image, media_type, media_title FROM media WHERE media_id = ? LIMIT 1";
            $prod_dta     = [$media_id];

            if ($media = prep_exec($prod_sql, $prod_dta, $sql_request_data[0])) {
              $crnt_img   = $media['media_image'];
              $orgn_name  = $slugify->slugify($media['media_title']);
              $media_type = $media['media_type'];
              $dir_url    = VIDEOS_URL;

              // Rename the uploaded file
              $img_name   = $image['name'];
              $img_type   = strtolower(substr($img_name, strripos($img_name, '.') + 1));
              $img_name   = $orgn_name . '.' . $img_type;

              $img_dir    = $dir_url;
              $img_url    = $img_dir . DS . $img_name;

              $media_sql  = "UPDATE media SET media_image = ? WHERE media_id = ? LIMIT 1";
              $media_dta  = [$img_name, $media_id];

              if (prep_exec($media_sql, $media_dta, $sql_request_data[2])) {

                if (!is_dir($img_dir) && !file_exists($img_dir)) {
                  mkdir($img_dir, 0777, true);
                }

                if (move_uploaded_file($image['tmp_name'], $img_url)) {
                  // $data['success']  = true;
                  // $data['message']  = "Successfully added file";
                  unset($_SESSION['media_id']);

                  if (file_exists($img_dir . $crnt_img) && is_file($img_dir . $crnt_img)) {
                    unlink($img_dir . $crnt_img);
                  }
                }
              }
            }

          }
        } else {

          $dir_url      = VIDEOS_URL;
          $image        = $_FILES['video_file'];
          $img_temp     = $image['tmp_name'];

          $new_name     = 'VID' . date("YmddHis");
          // Rename the uploaded file
          $img_name     = $image['name'];
          $img_type     = strtolower(substr($img_name, strripos($img_name, '.') + 1));
          $img_name     = $new_name . '.' . $img_type;

          $img_dir      = $dir_url . 'tmp';
          $img_url      = $img_dir . DS . $img_name;

          if (!is_dir($img_dir) && !file_exists($img_dir)) {
            mkdir($img_dir, 0777, true);
          }

          $tmp_glb = glob($img_dir . DS .'*');

          if (count($tmp_glb) !== 0) {
            foreach ($tmp_glb as $tmp_file) {
              unlink($tmp_file);
            }
          }

          if (move_uploaded_file($image['tmp_name'], $img_url)) {
            $data['data']     = $img_name;
            $data['success']  = true;
            // $data['message']  = "Successfully added file";
            $data['image']    = ABS_VIDEOS . 'tmp' . DS . $img_name;
          }
        }

      }

    } else {

      $uploadError      = new PublicFileUpload();

      $data['error']    = true;
      $data['messages'] = $uploadError->codeToMessage($_FILES['video_file']['error']);;
    }

  }

  // gallery
  if (is_array($_FILES) && isset($_FILES['product_images']) && !isset($_SESSION['media_id'])) {

    $media_id   = (isset($_POST['media_id']) && $_POST['media_id'] != '') ? $_POST['media_id'] : 0;
    $count      = 0;
    // $total_files 	= count($_FILES['product_images']['name']);
    if ($media_id) {
      $media    = get_media_by_id($media_id);
    }

    $dir_url    = ($media_id != 0 && isset($media)) ? GALLERY_URL . $media['media_image'] . DS : GALLERY_URL . 'tmp' . DS;
    if (!is_dir($dir_url) && !file_exists($dir_url)) {
      mkdir($dir_url, 0777, true);
    }

    foreach ($_FILES['product_images']['name'] as $name => $value) {
      $img_name       = $_FILES['product_images']['name'][$name];
      $img_type       = strtolower(substr($img_name, strripos($img_name, '.') + 1));
      $img_temp       = $_FILES['product_images']['tmp_name'][$name];
      $file_name      = explode('.', $_FILES['product_images']['name'][$name]);
      $allowed_ext    = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
      if (isset($file_name[1]) && in_array($file_name[1], $allowed_ext)) {
        $new_name     = 'IM_IMG' . date('YmdHms') . $count . '.' . $file_name[1];
        $new_imgpath  = $dir_url . $new_name;
        if (move_uploaded_file($img_temp, $new_imgpath)) {
          chmod($new_imgpath, 0777);

          $array_size = array(1080, 1080);
          // continue reduce image size if more than MAX_IMG_SIZE
          $image_size = check_image_size($new_imgpath, $array_size);
          if ($image_size && is_array($image_size)) {
            image_resize($new_imgpath, $image_size);
          }

          $img_size   = filesize($new_imgpath);
          clearstatcache();

          while ($img_size >= MAX_IMG_SIZE * 1000) {
            
            $heith = $image_size[1];
            $width = $image_size[0];
            $ratio = $heith/$width;
            $array_size[0] = $image_size[0] - 10;  
            $array_size[1] = round($array_size[0] * $ratio);

            $image_size = check_image_size($new_imgpath, $array_size);
            if ($image_size && is_array($image_size)) {
              image_resize($new_imgpath, $image_size);
            }
            
            $img_size   = filesize($new_imgpath);
            clearstatcache();
          }

        }
      } else {
        $data['error']    = true;
        $data['message']  = 'invalid file format';
      }
      $count++;
    }

    $dir = ($media_id != 0 && isset($media)) ? ABS_GALLERY . $media['media_image'] . DS : ABS_GALLERY . 'tmp' . DS;

    if (!$data['error']) {

      $data['update']   = true;
      $data['image']    = global_imgs($dir, 'col-md-3', 24);
      $data['success']  = true;
      $data['message']  = 'image uploaded';
    }

    unset($_SESSION['media_id']);
  }

  // delete image from slide folder image
  if (isset($_POST['path']) && !empty($_POST['path'])) {
    //echo $_POST['img_id'];
    $media_id = (isset($_POST['media_id']) && $_POST['media_id'] != '') ? $_POST['media_id'] : 0;
    if ($media_id) {
      $media  = get_media_by_id($media_id);
    }
    $dir_url      = ($media_id != 0 && isset($media)) ? GALLERY_URL . $media['media_image'] . DS : GALLERY_URL . 'tmp' . DS;

    $image        = $_POST['image'];
    $post_path    = $_POST['path'];
    $path         = $dir_url . $image;

    if (file_exists($path)) {
      if (unlink($path)) {
        $data['url']     = 'remove';
        $data['success'] = true;
      }
    }
  }

  // email subscription ************************************************************************************************
  // email subscription
  if (isset($_POST['signup_email'])) {
    $name         = $_POST['name'];
    $last_name    = $_POST['last_name'];
    $signup_email = sanitize(strtolower($_POST['signup_email']));
    $full_name    = $name . ' ' . $last_name;

    $subscription_id = (isset($_POST['subscription_id']) && !empty($_POST['subscription_id'])) ? $_POST['subscription_id'] : null;

    if (empty($name)) {
      $data['error'] = true;
      $data['message'] = 'Please provide your name';
    }

    if (empty($last_name)) {
      $data['error'] = true;
      $data['message'] = 'Please provide you surname';
    }

    // email validity
    if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
      $data['error'] = true;
      $data['message'] = 'Incorect email format';
    }

    if (empty($signup_email)) {
      $data['error'] = true;
      $data['message'] = 'Please provide your email';
    }

    if (!$data['error']) {

      // check subcription if exists
      if ($subscription_id != null) {
        $chck_sql = "SELECT subscription_id, subscription_name, subscription_last_name, AES_DECRYPT(subscription_email, UNHEX('$emailkey')) subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_status FROM email_subscription WHERE subscription_id = ? LIMIT 1";
        $chck_dta = [$subscription_id];
        $chck_qry = prep_exec($chck_sql, $chck_dta, $sql_request_data[0]);

        $email = $chck_qry['subscription_email'];

        $email_id = ($email == $signup_email) ? true : false;

        if (!$email_id && get_subscriber_by_email($signup_email)) {
          $data['error'] = true;
          $data['message'] = "There is already a user who currently uses this email";
        }
      } else {
        $chck_qry = get_subscriber_by_email($signup_email);
        if ($chck_qry) {
          $data['error']      = true;
          $data['message']    = "The email subscriber already exists, try to use a fifferent email";
        }
      }

      if (!$data['error']) {
        if ($chck_qry && $subscription_id != null) {
          $user = get_subscriber_by_email($chck_qry['subscription_email']);
          $sbscrp_sql = "UPDATE email_subscription SET subscription_status = 1, subscription_edit = 0, subscription_name = ?, subscription_last_name = ?, subscription_email = AES_ENCRYPT( ?, UNHEX('$emailkey')) WHERE subscription_id = ? LIMIT 1";
          $sbscrp_dta = [$name, $last_name, $signup_email, $subscription_id];
        } else {
          $sbscrp_sql = "INSERT INTO email_subscription (subscription_name, subscription_last_name, subscription_email, subscription_date_created) VALUES (?,?, AES_ENCRYPT( ?, UNHEX('$emailkey')),?)";
          $sbscrp_dta = [$name, $last_name, $signup_email, $date];
        }

        if ($sbscrp_qry = prep_exec($sbscrp_sql, $sbscrp_dta, $sql_request_data[2])) {

          $last_id          = $connect->lastInsertId();
          $token            = db_hash($last_id);
          $token_url        = "/action?distroy=true&id=" . $last_id . "&token=" . $token . '&mail=' . $signup_email;

          $upd_sql          = "UPDATE email_subscription SET subscription_token = ? WHERE subscription_id = ? LIMIT 1";
          $upd_dta          = [$token, $last_id];
          if ($sql_res = prep_exec($upd_sql, $upd_dta, $sql_request_data[2])) {
            $data['success']  = true;
            $data['message']  = "The email has been successfully subscribed";
          }

          $data['url']        = 'refresh';

          if ($data['success'] == true) {
            $data['error']    = false;
          } else {
            $data['success'] == false;
          }
        }
      }
    }
  }

  if (isset($_POST['subscribtion_remove']) && isset($_POST['subscribtion_id'])) {
    $subscription_id = $_POST['subscribtion_id'];

    if (!empty($subscription_id)) {
      $sbscrp_sql   = "UPDATE email_subscription SET subscription_status = 0, subscription_edit = 1 WHERE subscription_id = ? LIMIT 1";
      $sbscrp_dta   = [$subscription_id];

      if ($sbscrp_qry = prep_exec($sbscrp_sql, $sbscrp_dta, $sql_request_data[2])) {
        $data['success'] = true;
        $data['message'] = "Email has been succesfully unsubsribed";

        $data['url'] = 'refresh';
      }
    } else {
      $data['error']    = true;
      $data['message']  = 'Your subscription was not remove, Somwthing went wrong';
    }
  }

  if (isset($_POST['article_file'])) {
    
    // Allowed origins to upload images
    $accepted_origins = array("http://localhost", "https://" . $_ENV['PROJECT_HOST'], "http://" . $_ENV['PROJECT_HOST']);

    // Images upload path
    
    
    reset($_FILES);
    $temp = current($_FILES);
    if(is_uploaded_file($temp['tmp_name'])){
      if(isset($_SERVER['HTTP_ORIGIN'])){
        // Same-origin requests won't set an origin. If the origin is set, it must be valid.
        if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
          header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        }else{
          header("HTTP/1.1 403 Origin Denied");
          return;
        }
      }
      
      // Sanitize input
      if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
        header("HTTP/1.1 400 Invalid file name.");
            return;
      }
      
      // Verify extension
      if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
        header("HTTP/1.1 400 Invalid extension.");
        return;
      }
      
      // Accept upload if there was no origin, or if it is an accepted origin
      // $filetowrite = $imageFolder . $temp['name'];
      // move_uploaded_file($temp['tmp_name'], $filetowrite);
      
      // Respond to the successful upload with JSON.
      // $data['url'] = $filetowrite;
      // echo json_encode(array('location' => $filetowrite));
      
      $path_image   = 'images' .DS;

      $user_dir = MEDIA_URL . $path_image;
      $new_name = 'IMGIM' . date("YmddHis");
      $img_name = $temp["name"];
      $img_temp = $temp["tmp_name"];
      // Be sure we're dealing with an upload
      $image_res = image_validation($img_name, $new_name, $img_temp, $user_dir);
      if ( $image_res['success'] ) {
        $new_name = $new_name . '.' . $image_res['mime_type'];
        if (is_dir($user_dir)) {
          // article_img('tmp', $new_name);

          $data['success']  = $image_res['success'];
          $data['image']    = ABS_MEDIA . $path_image . $new_name;
        } else {
          $data['error']    = true;
          $data['message']  = 'Image was not uploaded successfully';
        }
      } else {
        $data['error']    = $image_res['success'];
      }

      $data['message']  = (empty($data['message'])) ? $image_res['message'] : $data['message'];

    } else {
        // Notify editor that the upload failed
        header("HTTP/1.1 500 Server Error");
    }

  }

  if (isset($_POST['page_name']) && isset($_POST['article_content'])) {

    $page_content   = $_POST['article_content'];
    $page_id        = (isset($_POST['page_id']))? sanitize($_POST['page_id']):'';
    $page_name      = sanitize($_POST['page_name']);

    if (empty($page_content)) {
      $data['error']    = true;
      $data['message']  = "Page content is empty";
    }

    if (!$data['error'] && empty($page_name)) {
      $data['error']    = true;
      $data['message']  = "Page name is empty";
    }


    if (!$data['error']) {

      $db_page = get_page_content_by_name($page_name);
      if (!$db_page || $db_page == null) {
        $article_sql = "INSERT INTO page_contents (page_content_name, page_content, page_content_date_created) VALUES (?, ?, ?)";
        $article_dta = [$page_name, $page_content, $date];
      } else {
        $article_sql      = "UPDATE page_contents SET page_content_name = ?, page_content = ? WHERE page_content_name = ? LIMIT 1";
        $article_dta      = [$page_name, $page_content, $page_name];
        
      }

      if ( $sbscrp_qry = prep_exec($article_sql, $article_dta, $sql_request_data[2])) {
        $data['success'] = true;
        $data['message'] = "Page content has been updated!";

      }
    }
  }

  // bookings
  if (isset($_POST['form_type']) && $_POST['form_type'] == 'rsvp_form') {
    $last_name      = $_POST['last_name'];
    $name           = $_POST['name'];
    $booking_email  = $_POST['user_email'];
    $contact        = $_POST['contact'];

    $attandence     = (isset($_POST['attandence'])) ? $_POST['attandence'] : '';
    $guests         = (isset($_POST['guests'])) ? (int) $_POST['guests'] : 0;

    $dietary        = (isset($_POST['dietary'])) ? $_POST['dietary'] : array();
    $dietary        = json_encode($dietary, true);

    $diet_comment   = $_POST['dietary_comment'];
    $message        = $_POST['comment'];

    $full_name      = $name . ' ' . $last_name;

    $event_id       = (isset($_POST['event'])? $_POST['event']:'');

    // attendance
    if (empty($attandence)) {
      $data['error'] = true;
      $data['message'] = 'Attandance option is empty';
    }

    // email validity
    if (!$data['error'] && !filter_var($booking_email, FILTER_VALIDATE_EMAIL)) {
      $data['error'] = true;
      $data['message'] = 'Incorect email format';
    }

    if (!$data['error'] && empty($booking_email)) {
      $data['error'] = true;
      $data['message'] = 'Please provide your email';
    }

    // check existance
    if (empty($event_id)) {
      $rsvp_user = get_event_by_email($booking_email);
    } else {
      $rsvp_user = null; 
    }
    

    if (!$data['error']  && $rsvp_user) {
      $data['error']    = true;
      $data['message']  = 'This email has already been used for booking';
    }

    if (!$data['error'] && empty($last_name)) {
      $data['error'] = true;
      $data['message'] = 'Please provide your last name (surname)';
    }

    if (!$data['error'] && empty($name)) {
      $data['error'] = true;
      $data['message'] = 'Please provide your name';
    }

    if (!$data['error'] && $guests > 2) {
      $data['error'] = true;
      $data['message'] = 'You can only bring no more than 2 guests';
    }

    if (!$data['error']) {

      if (!empty($event_id)) {
        $events_sql = "UPDATE events SET event_user_name = ?, event_last_name = ?, event_user_email =?, event_user_contact =?, event_attendance = ?, event_guests = ?, event_dietary = ?, event_dietary_message = ?, event_message = ?, event_date_updated = ? WHERE event_id = ? LIMIT 1";
        $events_dta = [$name, $last_name, $booking_email, $contact, $attandence, $guests, $dietary, $diet_comment, $message, $date, $event_id];
      } else {
        $events_sql = "INSERT INTO events (event_user_name, event_last_name, event_user_email, event_user_contact, event_attendance, event_guests, event_dietary, event_dietary_message, event_message, event_date_created, event_date_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $events_dta = [$name, $last_name, $booking_email, $contact, $attandence, $guests, $dietary, $diet_comment, $message, $date, $date];
      }
      

      $events_qry   = prep_exec($events_sql, $events_dta, $sql_request_data[2]);

      if ($events_qry) {

        $messsage   = (!empty($event_id))?'updated':'inserted';

        $data['success'] = true;
        $data['message'] = 'Your RSVP have been recieved ' . $messsage;
      } else {
        $data['error']   = true;
        $data['message'] = 'Your request was not submitted';
      }

    }
  }

  // add route
  if (isset($_POST['form_type']) && $_POST['form_type'] == 'route_form') {
    
    $departure    = (isset($_POST['booking_departure'])) ? $_POST['booking_departure'] : '';
    $destination  = (isset($_POST['booking_destination'])) ? $_POST['booking_destination'] : 'booking_destination';
    $week_day     = (isset($_POST['dow'])) ? $_POST['dow'] : '';
    $day_time     = (isset($_POST['tod'])) ? $_POST['tod'] : '';
    $booking_fare = (isset($_POST['booking_fare'])) ? $_POST['booking_fare'] : '';
    $service_id   = (isset($_POST['service'])) ? $_POST['service'] : '';
    $comment      = (isset($_POST['booking_comment']))? $_POST['booking_comment'] : '';

    if (!$data['error'] && empty($departure)) {
      $data['error']    = true;
      $data['message']  = 'Departure form field is empty';
    }

    if (!$data['error'] && empty($destination)) {
      $data['error']    = true;
      $data['message']  = 'Destination form field is empty';
    }

    if (!$data['error'] && empty($day_time)) {
      $data['error']    = true;
      $data['message']  = 'Time form field is empty';
    }

    if (!$data['error'] && empty($booking_fare)) {
      $data['error']    = true;
      $data['message']  = 'Time form field is empty';
    }

    if (!$data['error'] && empty($week_day)) {
      $data['error']    = true;
      $data['message']  = 'Week day form field is empty';
    }

    if (!$data['error'] && !empty($service_id) && !get_service_by_id($service_id)) {
      $data['error']    = true;
      $data['message']  = 'Route does not exist, try to add a new route';
    }

    if (!$data['error']) {

      $service_type   = 'shared';
      $transport_mode = '7_seater';

      if (!empty($service_id)) {
        $route_sql = "UPDATE services SET service_type = ?, service_trans_mode = ?, service_departure =?, service_destination = ?, service_week_day = ?, service_departure_time = ?, service_price = ?, service_message = ? WHERE service_id = ? LIMIT 1";
        $route_dta = [$service_type, $transport_mode, $departure, $destination, $week_day, $day_time, $booking_fare, $comment, $service_id];
      } else {
        $route_sql = "INSERT INTO services (service_type, service_trans_mode, service_departure, service_destination, service_week_day, service_departure_time, service_price, service_message) VALUES (?,?,?,?,?,?,?,?)";
        $route_dta = [$service_type, $transport_mode, $departure, $destination, $week_day, $day_time, $booking_fare, $comment];
      }     

      if (prep_exec($route_sql, $route_dta, $sql_request_data[2])) {

        $messsage   = (!empty($service_id)) ? 'updated' : 'created';

        $data['success'] = true;
        $data['message'] = 'Your route has been ' . $messsage;
      } else {
        $data['error']   = true;
        $data['message'] = 'Your request was not submitted';
      }

    }

  }

  // bookings
  if (isset($_POST['form_type']) && $_POST['form_type'] == 'booking_form') {
    $name           = (isset($_POST['name'])) ? $_POST['name'] : '';
    $last_name      = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
    $message        = (isset($_POST['booking_message'])) ? $_POST['booking_message'] : '';
    $booking_email  = (isset($_POST['booking_email'])) ? $_POST['booking_email'] : '';
    $booking_phone  = (isset($_POST['booking_phone'])) ? $_POST['booking_phone'] : '';
    
    $company_name   = (isset($_POST['event_company_name'])) ? $_POST['event_company_name'] : '';
    $event_period   = (isset($_POST['event_period']))? $_POST['event_period']:'';
    $event_descript = (isset($_POST['event_description']))? $_POST['event_description']:'';
    $event_address  = (isset($_POST['event_address']))? $_POST['event_address']:'';

    $event_type     = (isset($_POST['booking_type']) && !empty($_POST['booking_type'])) ? $_POST['booking_type'] : null;

    $event_id       = (isset($_POST['event']))? $_POST['event'] : '';

    // dfate 
    $dob            = (isset($_POST['dob'])) ? $_POST['dob'] : '';
    $mob            = (isset($_POST['mob'])) ? $_POST['mob'] : '';
    $yob            = (isset($_POST['yob'])) ? $_POST['yob'] : '';
    $tod            = (isset($_POST['tod'])) ? $_POST['tod'] : '';

    // shared booking type
    $service_id     = (isset($_POST['departure_destination'])) ? $_POST['departure_destination'] : 0;
    $booking_date   = (isset($_POST['booking_date']) ? date('Y-m-d H:i:s', strtotime($_POST['booking_date'])) : '');

    $complete       = (isset($_POST['booking_complete']))?1:0;


    $db_week        = '';
    if (!empty($service_id) && $service_type = 'shared') {
      $service      = get_service_by_id($service_id);

      $tod_date     = date('H:i:s', strtotime($service['service_departure_time']));
      $time_string  = ' +' . date('H', strtotime($tod_date)) . ' hours +' . date('i', strtotime($tod_date)) . ' minutes +' . date('s', strtotime($tod_date)) . ' seconds';
      $booking_time = date('Y-m-d H:i:s', strtotime($time_string, strtotime($booking_date)));
      $week_day     = date('l', strtotime($booking_time));
      $db_week      = $service['service_week_day'];

      $departure    = $service['service_departure'];
      $destination  = $service['service_destination'];
    } else {
      // charter booking type
      $tod          = str_replace(["PM","AM"], '', $tod);
      $tod_date     = date('H:i:s', strtotime($tod));
      $event_date   = $yob . '-' . $mob . '-' . $dob . ' ' . $tod_date;
      $booking_time = date("Y-m-d H:i:s", strtotime($event_date));
      $departure    = (isset($_POST['booking_departure'])) ? $_POST['booking_departure'] : '';
      $destination  = (isset($_POST['booking_destination'])) ? $_POST['booking_destination'] : '';

      $week_day     = date('l', strtotime($booking_time));

    }

    $user_count     = (isset($_POST['booking_user_count'])) ? $_POST['booking_user_count'] : '';
    $full_name      = $name . ' ' . $last_name;

    $event_date_alt = date("d M Y, @ H:i", strtotime($booking_time));
    $event_date     = date('Y-m-d H:i', strtotime($booking_time));


    if (!$data['error'] && $event_type == null) {
      $data['error']    = true;
      $data['message']  = "Make sure that booking type option is selected";
    }

    // booking date
    if (!$data['error'] && $event_type == 'shared' && $db_week != $week_day) {
      $data['error']    = true;
      $data['message']  = "Make sure that the selected date correcponds correctly with the selected scheduled day of the week";
    }

    if (!$data['error'] && is_valid_date($event_date)) {
      $data['error']    = true;
      $data['message']  = "Incorrect date format";
    }

    // validate allowed booking date
    $hour           = date('H');
    $minute         = (date('i') > 30) ? '60' : '30';
    $time_round     = "$hour:$minute:00";

    $date_norm      = date("Y-m-d");

    $current_date   = date("Y-m-d H:i:s");

    if (!$data['error'] && $booking_time <= $current_date) {
      $data['error']    = true;
      $data['message']  = "Your choosen date and or time is in the past. Choose a different date and time";
    }

    // email validity
    if (!$data['error'] && !filter_var($booking_email, FILTER_VALIDATE_EMAIL)) {
      $data['error']    = true;
      $data['message']  = 'Incorect email format';
    }

    if (!$data['error'] && empty($booking_email)) {
      $data['error']    = true;
      $data['message']  = 'Please provide your email';
    }


    if (!$data['error'] && empty($name)) {
      $data['error']    = true;
      $data['message']  = 'Please provide your name';
    }

    if (!$data['error'] && empty($user_count)) {
      $data['error']    = true;
      $data['message']  = 'Please provide expected number of attendees/guests';
    }

    if (!$data['error']) {

      if (!empty($event_id)) {
        $events_sql = "UPDATE events SET event_user_count =?, event_host_date = ?, event_user_name = ?, event_last_name = ?, event_user_email = ?, event_user_phone = ?, event_message = ?, event_type = ?, event_processed = ?, event_company_name = ?, event_description = ?, event_address = ?, event_period = ? WHERE event_id = ? LIMIT 1";
        $events_dta = [$user_count, $event_date, $name, $last_name, $booking_email, $booking_phone, $message, $event_type, $complete, $company_name, $event_descript, $event_address, $event_period, $event_id, ];
      } else {
        $events_sql = "INSERT INTO events (event_user_count, event_host_date, event_user_name, event_last_name, event_user_email, event_user_phone, event_message, event_type, event_date_created, event_date_updated, event_processed, event_company_name, event_description, event_address, event_period) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $events_dta = [$user_count, $event_date, $name, $last_name, $booking_email, $booking_phone, $message, $event_type, $date, $date, $complete, $company_name, $event_descript, $event_address, $event_period];
      }

      if (prep_exec($events_sql, $events_dta, $sql_request_data[2])) {
        $message    = (!empty($event_id))?'updated':'created';

        $data['success'] = true;
        $data['message'] = 'Your booking has been ' . $message;
      } else {
        $data['error']   = true;
        $data['message'] = 'Your request was not submitted';
      }

    }
  }

  // feedback form
  if (isset($_POST['form_type']) &&  $_POST['form_type'] == 'testimonials') {
    $testimonial_id = (isset($_POST['testimonial_id'])) ? $_POST['testimonial_id'] : '';
    $name       = (isset($_POST['name'])) ? $_POST['name'] : '';
    $last_name  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
    $message    = (isset($_POST['message'])) ? $_POST['message'] : '';
    $email      = (isset($_POST['email'])) ? $_POST['email'] : '';
    $full_name  = $name . ' ' . $last_name;

    if (!$data['error'] && empty($name)) {
      $data['error']    = true;
      $data['message']  = "Please provide name";
    }

    if (!$data['error'] && empty($last_name)) {
      $data['error']    = true;
      $data['message']  = "Please provide last name";
    }

    if (!$data['error'] && empty($message)) {
      $data['error']    = true;
      $data['message']  = "Please write your message";
    }

    $testimonial  = get_testimonial_by_id($testimonial_id);
    $img_dir      = USER_PROFILE_URL;
    $tmp_dir      = $img_dir . 'tmp' . DS;

    $tmp_glb      = glob($tmp_dir . '*');

    if (count($tmp_glb) !== 0) {
      foreach ($tmp_glb as $tmp_file) {
        $img_exp  = explode(DS, $tmp_file);
        $img_name = end($img_exp);
        $new_file = $img_dir . $img_name;
      }
    } elseif($testimonial) {
      $img_name   = $testimonial[''];
    }
    
    if (empty($data['error'])) {
      $media_image          = (!empty($img_name)) ? $img_name : 'profile.png';

      if (!empty($testimonial_id)) {
        $testimonials_sql   = "UPDATE testimonials SET testimonial_name = ?, testimonial_last_name = ?, testimonial_email = ?, testimonial_message = ?, testimonial_image = ? WHERE testimonial_id = ?";
        $testimonials_dta   = [$name, $last_name, $email, $message, $media_image, $testimonial_id];
      } else {
        $testimonials_sql   = "INSERT INTO testimonials (testimonial_name, testimonial_last_name, testimonial_email, testimonial_message, testimonial_image) VALUES (?, ?, ?, ?, ?)";
        $testimonials_dta   = [$name, $last_name, $email, $message, $media_image];
      }

      if (prep_exec($testimonials_sql, $testimonials_dta, $sql_request_data[2])) {
        $testimonial_id     = (empty($testimonial_id)) ? $connect->lastInsertId() : $testimonial_id;

        if (count($tmp_glb) !== 0) {
          rename($tmp_file, $new_file);
        }

        $data['url']        = "refresh";
        $data['success']    = true;
        $data['message']    = "Testimonial has been succesfully updated";
      } else {
        $data['error']      = true;
        $data['message']    = 'Your message was not sent';
      }

    }
  }

  // print_r($data);
  

  echo json_encode($data, true);

}
