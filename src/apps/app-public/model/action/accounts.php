<?php

use Abraham\TwitterOAuth\TwitterOAuth;

if(isset($_POST)) {
  $date     = date('Y-m-d H:i:s');
  $data     = array('error' => '','data' => '', 'success' => false,'message' => '', 'url' => '');
  $user_id  = (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null)?$_SESSION['user_id']:null;

  $emailkey = constant("EMAIL_KEY");

   // feedback form
  if (isset($_POST['form_type']) &&  $_POST['form_type'] == 'feedback_form') {
    $name       = (isset($_POST['name'])) ? $_POST['name'] : '';
    $last_name  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
    $message    = (isset($_POST['message'])) ? $_POST['message'] : '';
    $email      = (isset($_POST['email'])) ? $_POST['email'] : '';
    $full_name  = $name . ' ' . $last_name;

    if (!$data['error'] && empty($name)) {
      $data['error']    = true;
      $data['message']  = "Please provide your full name";
    }

    if (!$data['error'] && empty($message)) {
      $data['error']    = true;
      $data['message']  = "Please write your message";
    }

    if (!$data['error'] && empty($email)) {
      $data['error']    = true;
      $data['message']  = "Please provide your email";
    }

    // email validity
    if (!$data['error'] && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $data['error']    = true;
      $data['message']  = "Incorect email format";
    }

    if (empty($data['error'])) {
      $Feedbacks_sql = "INSERT INTO feedback (feedback_name, feedback_last_name, feedback_email, feedback_message) VALUES (?, ?, ?, ?)";
      $Feedbacks_dta = [$name, $last_name, $email, $message];
      $Feedbacks_qry = prep_exec($Feedbacks_sql, $Feedbacks_dta, $sql_request_data[2]);

      if ($Feedbacks_qry) {

        // Send email preparation
        $client_ifo = array(
          "name"      => $full_name,
          "email"     => $email,
          "message"   => $message,
        );

        // Prepare to send email *************************************************

        $to_usrs    = array(
          "name"    => $full_name,
          "email"   => $email
        );

        $subject    = "Feedback Message Captured";
        $html       =  user_feedback($full_name, $client_ifo);

        if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {

          $subject = "New Feedback Message";

          if (isset($admin_emails) && !empty($admin_emails)) {
            foreach ($admin_emails as $key => $mail_user) {
              // $client_ifo['name']   = $mail_user['name'];
              // $client_ifo['email']  = $mail_user['mail'];

              
              $to_usrs = array(
                "name"    => $mail_user['name'],
                "email"   => $mail_user['mail']
              );
              
              $html = user_feedback_notifify($mail_user['name'], $client_ifo);
              
              $mailer->mail->clearAllRecipients();
              if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
                $data['success'] = true;
              }
              
            }
          } else {
            $to_usrs   = array(
              "name"    => $_ENV['MAIL_USER'],
              "email"   => $_ENV['MAIL_MAIL'],
            );

            // $client_ifo['name']   = $_ENV['MAIL_USER'];
            // $client_ifo['email']  = $_ENV['MAIL_USER'];

            $html = user_feedback_notifify($_ENV["MAIL_USER"], $client_ifo);

            $mailer->mail->clearAllRecipients();
            if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
              $data['success'] = true;
            }

          }

          $data['success'] = true;
          $data['message'] = "Your message has been sent";

        } else {
          $data['error'] = true;
          $data['message'] = 'Your message was not sent, please send your feedback using other forms of communication for now until furthwer notice';
        }

      } else {
        $data['error']   = true;
        $data['message']  = 'Your message was not sent';
      }

    }
  }

 // email subscription
  if (isset($_POST['signup_email'])) {
    $name               = $_POST['name'];
    $last_name          = $_POST['last_name'];
    $signup_email       = $_POST['signup_email'];
    $full_name          = $name . ' ' . $last_name;

    // name validity
    if (!$data['error'] && empty($last_name)) {
      $data['error']    = true;
      $data['message']  = 'Please provide your name';
    }

    // last name validity
    if (!$data['error'] && empty($last_name)) {
      $data['error']    = true;
      $data['message']  = 'Please provide your last name';
    }

    // email validity
    if (!$data['error'] && empty($signup_email)) {
      $data['error']    = true;
      $data['message']  = 'Please provide your email';
    }

    // email validity
    if (!$data['error'] && !filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
      $data['error']    = true;
      $data['message']  = 'Incorect email format';
    }

    if (!$data['error']) {

      // check subcription if exists
      $chck_sql = "SELECT subscription_id, subscription_name, subscription_last_name, subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_status FROM email_subscription WHERE subscription_email = ? LIMIT 1";
      $chck_dta = [$signup_email];
      $chck_qry = prep_exec($chck_sql, $chck_dta, $sql_request_data[0]);

      if ($chck_qry && $chck_qry['subscription_status'] == 1) {
        $data['error'] = true;
        $data['message'] = 'You have already subscribed to ' . PROJECT_TITLE . '\'s newsletter.';
      }

      if (!$data['error']) {
        if ($chck_qry && $chck_qry['subscription_status'] == 0) {
          $sbscrp_sql   = "UPDATE email_subscription SET subscription_status = 1 WHERE subscription_id = ? LIMIT 1";
          $sbscrp_dta   = [$chck_qry['subscription_id']];
        } else {
          $sbscrp_sql   = "INSERT INTO email_subscription (subscription_name, subscription_last_name, subscription_email, subscription_date_created) VALUES (?,?,?,?)";
          $sbscrp_dta   = [$name, $last_name, $signup_email, $date];
        }

        if ($sbscrp_qry = prep_exec($sbscrp_sql, $sbscrp_dta, $sql_request_data[2])) {

          $last_id      = $connect->lastInsertId();
          $token        = db_hash($last_id);
          $token_url    = "/action?distroy=true&id=" . $last_id . "&token=" . $token . '&mail=' . $signup_email;

          $upd_sql      = "UPDATE email_subscription SET subscription_token = ? WHERE subscription_id = ? LIMIT 1";
          $upd_dta      = [$token, $last_id];
          if ($sql_res  = prep_exec($upd_sql, $upd_dta, $sql_request_data[2])) {
            $data['modal']    = 'close';
            $data['modal_id'] = 'subscription';
            $data['success']  = true;
            $data['delayed']  = true;
            $data['seconds']  = 9000;
            $data['message']  = "You have been subscribed, please check your email inbox for confirmation";
          }

          // Prepare to send email
          $token_url    = "/action?distroy=true&mail=" . $signup_email;

          $to_usrs      = array(
            "name"      => $name,
            "last_name" => $last_name,
            "full_name" => $full_name,
            "email"     => $signup_email,
            "url_reset" => host_url($token_url)
          );

          $client_ifo         = $to_usrs;
          $client_ifo["url"]  = $token_url;

          $subject      = "Email Subscription";
          $html         =  email_subscription($to_usrs["name"], $client_ifo);

          if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
            $subject    = "New Email Subscription";
            $html       =  email_subscription_notify($_ENV["MAIL_USER"], $to_usrs);

            if (isset($mailer)) {
              $mailer->mail->clearAllRecipients();
            }
            if ($mailer->mail(array(array("name"    => $_ENV["MAIL_USER"], "email"   => $_ENV["MAIL_MAIL"])), $subject, $html, MAIL_FROM)) {
              $data['success'] = true;
            }
          }

          if ($data['success'] == true) {
            $data['error'] = '';
          } else {
            $data['success'] == false;
          }
        }
      }
    }
  }

  // unsubscription
  if (isset($_POST["subscribe_token"])) {
    $id       = $_POST["id"];
    $token    = $_POST["subscribe_token"];

    $chck_sql = "SELECT subscription_id, subscription_name, subscription_last_name, subscription_email, subscription_token, subscription_date_created, subscription_date_updated, subscription_status FROM email_subscription WHERE subscription_id = ? AND subscription_token = ? LIMIT 1";
    $chck_dta = [$id, $token];
    if ($chck_qry = prep_exec($chck_sql, $chck_dta, $sql_request_data[0])) {
      $sql    = "UPDATE email_subscription SET subscription_status = 0 WHERE subscription_id = ? AND subscription_token = ? LIMIT 1";
      $dta    = [$id, $token];

      if ($qry = prep_exec($sql, $dta, $sql_request_data[2])) {
        $data['success']  = true;
        $data['message']  = 'You have been unsubscribed from ' . PROJECT_TITLE . ' mailing list';
      } else {
        $data['success']  = false;
        $data['message']  = 'There was a problem with unsubscribing you from ' . PROJECT_TITLE . ' mailing list';
      }
    } else {
      $data['success']    = false;
      $data['message']    = 'You have never subscribed with us, or you have provided us with incorrect token';
    }
  }

  // twitter signin attempt
  if (isset($_POST['form_type']) && $_POST['form_type'] == 'twitter_signin') {
    $user_id        = '';
    $username       = (isset($_POST['username'])) ? $_POST['username'] : '';

    if ($user = get_user_by_username($username)) {
      $user_id      = $user['user_id'];
    }

    $api_user       = get_api_by_user_id($user_id);

    if (empty($username)) {
      $data['error']    = true;
      $data['message']  = "Please provide your admin username";
    }

    if (!$data['error'] && $user && $api_user) {
      $oauth_token        = $api_user['oauth_token'];
      $oauth_token_secret = $api_user['oauth_token_secret'];
    } elseif (!$data['error'] && $user) {
      $api_user           = $user;
    } elseif (!$data['error']) {
      $data['error']      = true;
      $data['message']    = 'You are not allowed to perform the task, please provide the correct username or contact the website administrator';
    }

    if (!$data['error'] && $api_user) {
      // $data['error']  = false;
      $twi_connect      = new TwitterOAuth($_ENV['TWEET_API_KEY'], $_ENV['TWEET_API_KEY_SECRET']);
      $request_token    = $twi_connect->oauth("oauth/request_token", ["oauth_callback" => $_ENV['TWEET_CALLBACK_URL']]);

      if ($twi_connect->getLastHttpCode() == 200) {

        // get twitter oauth url
        $oauth_token          = $request_token['oauth_token'];
        $oauth_token_secret   = $request_token['oauth_token_secret'];

        $oauthUrl             = $twi_connect->url("oauth/authorize", ["oauth_token" => $oauth_token]);

        $data['success']      = true;
        $data['url']          = filter_var($oauthUrl, FILTER_SANITIZE_URL);

        $_SESSION['TWT_URL']  = $data['url'];
        $_SESSION['user_token'] = $oauth_token;
        $_SESSION['user_token_secret'] = $oauth_token_secret;
        $_SESSION['TMP_USER_ID'] = $user_id;
      } else {
        $data['error']    = true;
        $data['message']  = 'Error connecting to twitter!, Try again later !';
      }
    }
  }

  // user login
  if (isset($_POST["login_password"]) && isset($_POST["login_username"])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    if(empty($password)){
      $data['error']    = true;
      $data['message']  = "Password field is empty";
    }elseif(empty($username)){
      $data['error']    = true;
      $data['message']  = "Username field is empty";
    }

    if (!$data['error']) {
      if( $usr_res  = get_user_by_username($username) ) {
        $found_user = try_login($username, $password);

        if($found_user) {
          $user_id  = $usr_res['user_id'];
          $usr_sql  = "UPDATE users SET last_seen = ? WHERE user_id = ? LIMIT 1";
          $usr_dta  = [$date, $user_id];
          prep_exec($usr_sql, $usr_dta, $sql_request_data[2]);

          $_SESSION['admin_id']   = 'admin';
          $_SESSION['active_app'] = 'admin';
          $_SESSION['user_id']    = $user_id;
          $_SESSION['user_type']  = (isset($found_user['user_type_id']) && ($found_user['user_type_id'] == 1) || $found_user['user_type_id'] == 2) ? 1 : 0;
          $data['success']        = true;
          $data['message']        = "User succesfully logged in";
          $data['url']            = "home";
        } else {
          $data['error']    = true;
          $data['message']  = "Your username and/ or password is incorrect";
        }
      } else {
        $data['error']      = true;
        $data['message']    = "This username may not exists";
      }
    }
  }

  // article comments user check
  if (isset($_POST['user_username']) && isset($_POST['user_email'])) {

    $user_id      = (isset($_SESSION['uid'])) ? $_SESSION['uid'] : '';
    $username     = $_POST['user_username'];
    $email        = $_POST['user_email'];
    $comment      = $_POST['comment'];
    $article_id   = $_POST['article'];

    if(!$data['error'] && empty($username)){
      $data['error']    = true;
      $data['message']  = "Please provide your name";
    }
    
    if(!$data['error'] && empty($email)) {
      $data['error']    = true;
      $data['message']  = "Please provide your email";
    }

    // email validity
    if (!$data['error'] && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $data['error']    = true;
      $data['message']  = 'Incorect email format';
    }

    if (!$data['error']) {

      if ($user   = get_user_by_email($email)) {
        $user_id  = $user['user_id'];
      } else {

        if ($user = get_user_by_username($username)) {
          if (!get_user_by_email($email)) {
            $data['error']    = true;
            $data['message']  = "This username is already in use, please choose a different username";
          } else {
            $user_id = $user['user_id'];
          }
        } else {
          $req_sql = "INSERT INTO users (username, email, password, user_type, date_created, date_updated, last_seen) VALUES (?,?,?,?,?,?,?)";
          $req_dta = [$username, $email, 'pass', 0, $date, $date, $date];

          if ($user = prep_exec($req_sql, $req_dta, $sql_request_data[2])) {
            $user_id = $connect->lastInsertId();
          } else {
            $data['error']    = true;
            $data['message']  = "User creation was not successful";
          }
        }
      }

      $_SESSION['uid']      = $user_id;
      $data['success']      = true;
      $data['message']      = 'User successfully modified';
      $data['url']          = 'refresh';

      if (!$data['error']) {

        if (!empty($comment)) {
          $cmnt_sql = "INSERT INTO article_comments (article_id, user_id, article_comment, article_comment_date_created, article_comment_date_updated) VALUES (?,?,?,?,?)";
          $cmnt_dta = [$article_id, $user_id, $comment, $date, $date];

          if (prep_exec($cmnt_sql, $cmnt_dta, $sql_request_data[2])) {
            $data['success']      = true;
            $data['message']      = "Comment was succesfully created";

            $article              = get_article_by_id($article_id);
            $user                 = get_user_by_id($user_id);
            $article_title        = $article['article_title'];
            $article_type         = $article['article_type'];
            $article_image        = $article['article_image'];
            $article_pubdat       = $article['article_publish_date'];
            $article_author       = $article['article_author'];

            $article_date         = DateTime::createFromFormat('Y-m-d H:i:s', $article['article_publish_date']);
            $article_slg          = $slugify->slugify($article_title);

            $url                  = '/article?article=' . $article_slg . '&slgid=' . $article_id . '&type=' . $article_type;

            // Prepare to send email *************************************************

            $subject    = "New Article Comment";

            $client_ifo           = array(
              "name"              => '',
              "email"             => '',
              "title"             => htmlspecialchars($article_title, ENT_QUOTES, "UTF-8"),
              "author"            => $article_author,
              "date"              => $article_date->format('F jS, Y'),
              "message_text_1"    => "There is a new comment on the article that was published on ". $article_date->format('F jS, Y') .", titled: <b>". htmlspecialchars($article_title, ENT_QUOTES, "UTF-8") ."</b>",
              "message_text_2"    => 'Here is the link to the article: <a href="'. host_url($url) .'">'. host_url($url) .'</a>',
              "message_type"      => 'admin',
              "message"           => 'Article comment by <b> ' . $user['username'] . '</b>: ' . $comment,
            );

            if (isset($admin_emails) && !empty($admin_emails)) {
              foreach ($admin_emails as $key => $mail_user) {
                $client_ifo['name']   = $mail_user['name'];
                $client_ifo['email']  = $mail_user['mail'];

                $to_usrs = array(
                  "name"    => $mail_user['name'],
                  "email"   => $mail_user['mail']
                );

                $html       =  main_general_mail($client_ifo);
                if (isset($mailer)) {
                  $mailer->mail->clearAllRecipients();
                }
                if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
                  $data['success'] = true;
                }
                
              }
            } else {
               $to_usrs   = array(
                "name"    => $_ENV['MAIL_USER'],
                "email"   => $_ENV['MAIL_MAIL'],
              );

              $client_ifo['name']   = $_ENV['MAIL_USER'];
              $client_ifo['email']  = $_ENV['MAIL_USER'];

              $html       =  main_general_mail($client_ifo);

              if (isset($mailer)) {
                $mailer->mail->clearAllRecipients();
              }
              if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
                $data['success'] = true;
              }

            }
            
          }
          
        }
        
      }

      setcookie("ism_user", $date, time() + 86400*365);
    }
  }

  // article comments
  if (isset($_POST['comment']) && isset($_POST['islogged']) && isset($_SESSION['uid'])) {

    $user_id      = (isset($_SESSION['uid'])) ? $_SESSION['uid'] : '';
    $comment      = $_POST['comment'];
    $comment_id   = (isset($_POST['comment_id']) && $_POST['comment_id'] != '')?$_POST['comment_id']:0;
    $article_id   = $_POST['article_id'];
    $comment_type = (isset($_POST['type']) && $_POST['type'] == 'reply')?1:0;

    if(empty($comment)){
      $data['error'] = true;
      $data['message'] = "Comment field is empty";
    } elseif (empty($article_id)) {
      $dataarticle_['error'] = true;
      $data['message'] = "Something went wrong, try to refresh the page";
    }

    if ($comment_type) {
      $usr_id   = $_POST['user'];
      $user     = get_user_by_id($usr_id);
      $comment  = '<a class="text-info">@' . $user['username'] . '</a>&nbsp; ' . $comment;
    }

    if (!$data['error']) {
      $cmnt_sql = "INSERT INTO article_comments (article_id, user_id, article_comment, article_comment_type, comment_id, article_comment_date_created) VALUES (?,?,?,?,?,?)";
      $cmnt_dta = [$article_id, $user_id, $comment, $comment_type, $comment_id, $date];

      if (prep_exec($cmnt_sql, $cmnt_dta, $sql_request_data[2])) {
        $data['success']  = true;
        $data['message']  = "Comment was succesfully created";
        $data['url']      = "comments_div".$article_id;

        $_SESSION['comment']  = '';

        $article              = get_article_by_id($article_id);
        $user                 = get_user_by_id($user_id);
        $article_title        = $article['article_title'];
        $article_type         = $article['article_type'];
        $article_image        = $article['article_image'];
        $article_pubdat       = $article['article_publish_date'];
        $article_author       = $article['article_author'];

        $article_date         = DateTime::createFromFormat('Y-m-d H:i:s', $article['article_publish_date']);
        $article_slg          = $slugify->slugify($article_title);

        $url                  = '/article?article=' . $article_slg . '&slgid=' . $article_id . '&type=' . $article_type;

        // Prepare to send email *************************************************
        $subject              = "New Article Comment";

        $client_ifo           = array(
          "name"              => '',
          "email"             => '',
          "title"             => htmlspecialchars($article_title, ENT_QUOTES, "UTF-8"),
          "author"            => $article_author,
          "date"              => $article_date->format('F jS, Y'),
          "message_text_1"    => "There is a new comment on the article that was published on ". $article_date->format('F jS, Y') .", titled: <b>". htmlspecialchars($article_title, ENT_QUOTES, "UTF-8") ."</b>",
          "message_text_2"    => 'Here is the link to the article: <a href="'. host_url($url) .'">'. host_url($url) .'</a>',
          "message_type"      => 'admin',
          "message"           => 'Article comment by <b> ' . $user['username'] . '</b>: ' . $comment,
        );

        if (isset($admin_emails) && !empty($admin_emails)) {
          foreach ($admin_emails as $key => $mail_user) {
            $client_ifo['name']   = $mail_user['name'];
            $client_ifo['email']  = $mail_user['mail'];

            $to_usrs = array(
              "name"    => $mail_user['name'],
              "email"   => $mail_user['mail'],
            );

            $html       =  main_general_mail($client_ifo);
            
            if (isset($mailer)) {
              $mailer->mail->clearAllRecipients();
            }
            if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
              $data['success'] = true;
            }
            
          }
        } else {
          $to_usrs   = array(
            "name"    => $_ENV['MAIL_USER'],
            "email"   => $_ENV['MAIL_MAIL'],
          );

          $client_ifo['name']   = $_ENV['MAIL_USER'];
          $client_ifo['email']  = $_ENV['MAIL_USER'];

          $html       =  main_general_mail($client_ifo);

          if (isset($mailer)) {
            $mailer->mail->clearAllRecipients();
          }
          if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
            $data['success'] = true;
          }

        }
      }
    }

  }

  // article share
  if (isset($_POST['share_type']) && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];

    if (!empty($article_id)) {

      $req_sql = "UPDATE articles SET article_shares = article_shares+1 WHERE article_id = ? LIMIT 1";
      $req_dta = [$article_id];

      if ($req_res = prep_exec($req_sql, $req_dta, $sql_request_data[2])) {
        $data['success'] = true;
        $data['message'] = "";
      }

    } else{
      $data['error'] = true;
      $data['message'] = "Update error";
    }
  }

  // article subcomments
  if (isset($_POST['article_comments']) && isset($_POST['article_id'])) {
    $article_id       = $_POST['article_id'];
    $article_comments = $_POST['article_comments'];

    if (!empty($article_id)) {

      $cmnt_sql = "SELECT * FROM article_comments WHERE article_id = ? ORDER BY article_comment_date_created LIMIT 3, 5000";
      $cmnt_dta = [$article_id];

      if ($cmnt_res = prep_exec($cmnt_sql, $cmnt_dta, $sql_request_data[1])) {
        $output = '';
        foreach ($cmnt_res as $comment) {
          $username = get_user_by_id($comment['user_id'])['username'];
          $db_date  = DateTime::createFromFormat('Y-m-d H:i:s', $comment['article_comment_date_created']);

          $output .= '<div class="user_comment" style="padding-top: 7px !important;">';
          $output .= '<img class="card-img-top card_img_comment img-thumbnail" style="height: 50px; width: 50px;" src="./img/users/profile.png" alt="User Image">';
          $output .= '<div class="card_img_comment_box/ card-body/" style="padding-left: 70px;">';
          $output .= '<h6 class="card-title"><i>' . $username;
          $output .= '</i>  &nbsp; | <small class="card-subtitle mb-2 text-muted"><span class="text-warning" style="">' . $db_date->format('H:m:s - F jS, Y') . '</span></small><br>';
          $output .= '</h6>';
          $output .= '<p class="text-muted">' . $comment['article_comment'] . '</p>';
          $output .= '</div>';
          $output .= '</div>';

        }

        $data['success'] = true;
        $data['message'] = $output;
      } else {
        $data['success'] = true;
        $data['message'] = '';
      }

    } else {
      $data['error']    = true;
      $data['message']  = 'Something went wrong';
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
    $event_period   = (isset($_POST['event_period'])) ? $_POST['event_period'] : '';
    $event_descript = (isset($_POST['event_description'])) ? $_POST['event_description'] : '';
    $event_address  = (isset($_POST['event_address'])) ? $_POST['event_address'] : '';

    $event_type     = (isset($_POST['booking_type']) && !empty($_POST['booking_type'])) ? $_POST['booking_type'] : null;

    $event_id       = (isset($_POST['event'])) ? $_POST['event'] : '';

    // dfate 
    $dob            = (isset($_POST['dob'])) ? $_POST['dob'] : '';
    $mob            = (isset($_POST['mob'])) ? $_POST['mob'] : '';
    $yob            = (isset($_POST['yob'])) ? $_POST['yob'] : '';
    $tod            = (isset($_POST['tod'])) ? $_POST['tod'] : '';

    // shared booking type
    $service_id     = (isset($_POST['departure_destination'])) ? $_POST['departure_destination'] : 0;
    $booking_date   = (isset($_POST['booking_date']) ? date('Y-m-d H:i:s', strtotime($_POST['booking_date'])) : '');

    $complete       = (isset($_POST['booking_complete'])) ? 1 : 0;


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
      $tod          = str_replace(["PM", "AM"], '', $tod);
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
        $events_dta = [$user_count, $event_date, $name, $last_name, $booking_email, $booking_phone, $message, $event_type, $complete, $company_name, $event_descript, $event_address, $event_period, $event_id,];
      } else {
        $events_sql = "INSERT INTO events (event_user_count, event_host_date, event_user_name, event_last_name, event_user_email, event_user_phone, event_message, event_type, event_date_created, event_date_updated, event_processed, event_company_name, event_description, event_address, event_period) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $events_dta = [$user_count, $event_date, $name, $last_name, $booking_email, $booking_phone, $message, $event_type, $date, $date, $complete, $company_name, $event_descript, $event_address, $event_period];
      }

      if (prep_exec($events_sql, $events_dta, $sql_request_data[2])) {

        // Send email preparation
        $client_ifo = array(
          "name"          => $full_name,
          "email"         => $booking_email,
          "message"       => $message,
          "contact"       => $booking_phone,
          "event_type"    => isset($admin_booking[$event_type]['short']) ? $admin_booking[$event_type]['short'] : '',
          "address"       => $event_address,
          "description"   => $event_descript,
          "event_date"    => $event_date_alt,
          "message_type"    => 'public',
          "message_text_1"  => 'We would like to kindly inform you that we have received your online booking; we will get in touch with you soon.',
          "message_text_2"  => '',
        );

        // Prepare to send email *************************************************
        $to_usrs    = array(
          "name"      => $full_name,
          "email"     => $booking_email
        );

        $subject      = "Booking Recieved";
        $html         =  event_notification($client_ifo, $to_usrs);

        if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
          $subject    = "New Booking";

          $client_ifo['message_type']   = 'admin';
          $client_ifo['message_text_1'] = 'You have a new online booking from '. PROJECT_TITLE .' website';
          $client_ifo['message_text_2'] = 'Here are the details,';

          foreach ($admin_emails as $key => $mail_user) {
            $to_usrs = array(
              "name"      => $mail_user['name'],
              "email"     => $mail_user['mail'],
            );

            $html         = event_notification($client_ifo, $to_usrs);
            
            if (isset($mailer)) {
              $mailer->mail->clearAllRecipients();
            }
            if ($mailer->mail(array($to_usrs), $subject, $html, MAIL_FROM)) {
              $data['success'] = true;
            }
          }

          $message          = (!empty($event_id)) ? 'updated' : 'created';
  
          $data['success']  = true;
          
          $data['message']  = (!isset($_SESSION['user_id'])) ? 'You have succesfully made a booking, please check your email for confirmation' : 'Your booking has been ' . $message;
        } else {
          $data['error']    = true;
          $data['message']  = "The message was not sent, you may need to use alternative ways to communicate with me";
        }
        
      } else {
        $data['error']   = true;
        $data['message'] = 'Your request was not succssfully submitted';
      }
    }
  }


  echo json_encode($data, true);

}
