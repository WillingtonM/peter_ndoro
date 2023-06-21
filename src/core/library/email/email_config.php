<?php

// EMAIL Constants
define('MAIL_DBUG', 0); // | 0 = off (for production use) | 1 = client messages | 2 = client and server messages |
define('MAIL_PORT', $_ENV["MAIL_PORT"]);  // Set the SMTP port number - likely to be 25, 465 or 587
define('MAIL_AUTH', $_ENV["MAIL_AUTH"]);
define('MAIL_SECR', $_ENV["MAIL_SECR"]);
define('MAIL_FROM', array("name"=> PROJECT_TITLE , "email" => $_ENV["MAIL_MAIL"]) );
