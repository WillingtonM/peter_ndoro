-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;


-- DROP TABLE IF EXISTS `users`;



-- ************************************** `users`

CREATE TABLE IF NOT EXISTS `users`
(
  `user_id`             bigint NOT NULL AUTO_INCREMENT ,
  `user_type_id`        bigint NULL ,
  `username`            varchar(45) NULL ,
  `email`               char(94) NULL ,
  `password`            varchar(255) NULL ,
  `name`                varchar(45) NULL ,
  `last_name`           varchar(45) NULL ,
  `contact_number`      varchar(45) NULL ,
  `alt_contact_number`  varchar(45) NULL ,
  `user_province`       varchar(45) NULL ,
  `user_position`       varchar(45) NULL ,
  `gender`              TINYTEXT NULL ,
  `last_seen`           datetime NULL ,
  `user_description`	  TEXT ,
  `user_status`         tinyint DEFAULT 1 ,
  `user_listpos`        tinyint DEFAULT 1 ,
  `user_type`           tinyint DEFAULT 1 ,
  `email_confirm`       tinyint DEFAULT 0  ,
  `email_confirm_code`  varchar(255) NULL ,
  `user_image`          varchar(45) DEFAULT 'profile.png' ,
  `pass_reset_code`     varchar(255) NULL ,
  `pass_reset_date`     datetime NULL ,
  `date_created`        datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `date_updated`        timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

PRIMARY KEY (`user_id`)
);


-- ************************************** `user_types`
-- DROP TABLE IF EXISTS `user_types`;

-- ************************************** `user_types`

CREATE TABLE IF NOT EXISTS `user_types`
(
  `user_type_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `user_type`    VARCHAR(45) NOT NULL ,
  `date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,

PRIMARY KEY (`user_type_id`)
);


-- ************************************** `articles`
-- DROP TABLE IF EXISTS `articles`;


-- ************************************** `articles`


-- CREATE TABLE IF NOT EXISTS `articles`
-- (
--  `article_id`             bigint NOT NULL AUTO_INCREMENT ,
--  `article_title`          varchar(255) NOT NULL ,
--  `article_type`           varchar(45) NOT NULL ,
--  `article_link`           varchar(255) NOT NULL ,
--  `article_publisher`      varchar(255) NULL ,
--  `article_content`        LONGTEXT NOT NULL ,
--  `article_source`         varchar(255) NOT NULL ,
--  `article_image`          varchar(255) NULL ,
--  `article_file`           varchar(255) NULL ,
--  `article_author`         varchar(255) NULL ,
--  `article_status`         tinyint NOT NULL DEFAULT 1 ,
--  `article_sent`           tinyint NOT NULL DEFAULT 0 ,
--  `article_cronjob`        tinyint NOT NULL DEFAULT 0 ,
--  `article_cronjob_status` tinyint NOT NULL DEFAULT 0 ,
--  `article_cronjob_date`   datetime NULL ,
--  `article_publish_date`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `article_date_created`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `article_date_updated`   timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
--  `user_id`                bigint NOT NULL ,
--  `article_shares`         int NOT NULL DEFAULT 0,

-- PRIMARY KEY (`article_id`),
-- KEY `fkIdx_1080` (`user_id`),
-- CONSTRAINT `FK_1080` FOREIGN KEY `fkIdx_1080` (`user_id`) REFERENCES `users` (`user_id`)
-- );


-- ***************************************************;

-- DROP TABLE IF EXISTS `article_comments`;
-- ************************************** `article_comments`

-- CREATE TABLE IF NOT EXISTS `article_comments`
-- (
--  `article_comment_id`           bigint NOT NULL AUTO_INCREMENT ,
--  `article_comment`              text NOT NULL ,
--  `article_comment_type`         tinyint NOT NULL DEFAULT 0 ,
--  `article_comment_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP  ,
--  `article_comment_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
--  `article_comment_status`       tinyint NOT NULL DEFAULT 1 ,
--  `comment_id`                   bigint NULL ,
--  `user_id`                      bigint NOT NULL ,
--  `article_id`                   bigint NOT NULL ,

-- PRIMARY KEY (`article_comment_id`),
-- KEY `fkIdx_1043` (`user_id`),
-- CONSTRAINT `FK_1043` FOREIGN KEY `fkIdx_1043` (`user_id`) REFERENCES `users` (`user_id`),
-- KEY `fkIdx_1050` (`article_id`),
-- CONSTRAINT `FK_1050` FOREIGN KEY `fkIdx_1050` (`article_id`) REFERENCES `articles` (`article_id`)
-- );




-- ***************************************************;
-- DROP TABLE IF EXISTS `feedback`;

-- ************************************** `feedback`

CREATE TABLE IF NOT EXISTS `feedback`
(
 `feedback_id`           bigint NOT NULL AUTO_INCREMENT ,
 `feedback_name`         varchar(255) NOT NULL ,
 `feedback_last_name`    varchar(255) NOT NULL ,
 `feedback_email`        varchar(255) NOT NULL ,
 `feedback_message`      text NOT NULL ,
 `feedback_status`       tinyint NOT NULL DEFAULT 1,
 `feedback_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `feedback_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

PRIMARY KEY (`feedback_id`)
);


-- ***************************************************;
-- DROP TABLE IF EXISTS `pages_content`;

-- ************************************** `pages_content`

-- CREATE TABLE IF NOT EXISTS `page_contents`
-- (
--  `page_content_id`           bigint NOT NULL AUTO_INCREMENT ,
--  `page_content_name`         varchar(255) NOT NULL ,
--  `page_content`              text NOT NULL ,
--  `page_content_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `page_content_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

-- PRIMARY KEY (`page_content_id`)
-- );


-- ***************************************************;
-- DROP TABLE IF EXISTS `email_subscription`;

-- ************************************** `email_subscription`

-- CREATE TABLE IF NOT EXISTS `email_subscription`
-- (
--  `subscription_id`           bigint NOT NULL AUTO_INCREMENT ,
--  `subscription_name`         varchar(255) NULL ,
--  `subscription_last_name`    varchar(255) NULL ,
--  `subscription_email`        varchar(255) NOT NULL ,
--  `subscription_token`        varchar(255),
--  `subscription_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `subscription_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
--  `subscription_edit`         tinyint NOT NULL DEFAULT 0 , 
--  `subscription_status`       tinyint NOT NULL DEFAULT 1 ,

-- PRIMARY KEY (`subscription_id`)
-- );



-- ***************************************************;
-- DROP TABLE IF EXISTS `events`;

-- ************************************** `events`

-- CREATE TABLE IF NOT EXISTS `events`
-- (
--  `event_id`               bigint NOT NULL AUTO_INCREMENT ,
--  `event_user_name`        varchar (255) NOT NULL ,
--  `event_last_name`        varchar (255) NOT NULL ,
--  `event_user_email`       varchar (255) NOT NULL ,
--  `event_user_contact`     varchar (255) NULL ,
--  `event_attendance`       tinytext NULL ,
--  `event_guests`           INTEGER NULL ,
--  `event_dietary`          text NULL ,
--  `event_dietary_message`  text NULL ,
--  `event_message`          text NOT NULL ,
--  `event_date_created`     datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `event_date_updated`     timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

-- PRIMARY KEY (`event_id`)
-- );


-- ***************************************************;
-- DROP TABLE IF EXISTS `events`;

-- ************************************** `events`

CREATE TABLE IF NOT EXISTS `events`
(
 `event_id`           bigint NOT NULL AUTO_INCREMENT ,
 `user_id`            bigint NULL ,
 `event_description`  text NULL ,
 `event_user_name`    varchar (255) NOT NULL ,
 `event_last_name`    varchar (255) NOT NULL ,
 `event_user_email`   varchar (255) NOT NULL ,
 `event_user_phone`   varchar (255) NULL ,
 `event_company_name` varchar (255) NULL ,
 `event_budget`       varchar (255) NULL ,
 `event_venue`        varchar (255) NULL ,
 `event_user_count`   INTEGER (11) NULL ,
 `event_price`        varchar (255) NULL ,
 `event_address`      text NULL ,
 `event_message`      text NULL ,
 `event_processed`    tinyint NOT NULL DEFAULT 0 ,
 `event_period`       tinytext NULL ,
 `event_type`         tinytext NULL ,
 `event_host_date`    datetime NULL DEFAULT CURRENT_TIMESTAMP ,
 `event_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `event_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

PRIMARY KEY (`event_id`),
KEY `fkIdx_1064` (`user_id`),
CONSTRAINT `FK_1064` FOREIGN KEY `fkIdx_1064` (`user_id`) REFERENCES `users` (`user_id`)
);


-- ***************************************************;
-- DROP TABLE IF EXISTS `services`;

-- ************************************** `services`

CREATE TABLE IF NOT EXISTS `services`
(
 `service_id`             bigint NOT NULL AUTO_INCREMENT ,
 `service_type`           varchar (255) NULL ,
 `service_trans_mode`     varchar (255) NULL ,
 `service_departure`      varchar (255) NULL ,
 `service_destination`    varchar (255) NULL ,
 `service_week_day`       varchar (45) NULL ,
 `service_departure_time` varchar (255) NULL ,
 `service_price`          INTEGER (11) NULL ,
 `service_message`        text NOT NULL ,
 `service_departure_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `service_date_created`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `service_date_updated`   timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

PRIMARY KEY (`service_id`)
);


-- ***************************************************;
-- DROP TABLE IF EXISTS  `media`;

-- ************************************** `media`

CREATE TABLE IF NOT EXISTS `media`
(
 `media_id`           bigint NOT NULL AUTO_INCREMENT ,
 `media_title`        varchar(255) NOT NULL ,
 `media_content`      text NOT NULL ,
 `media_type`         varchar(255) NULL ,
 `media_url`          varchar(255) NULL ,
 `media_image`        varchar(255) NULL ,
 `media_status`       tinyint NOT NULL DEFAULT 1 ,
 `media_publish_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `media_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `media_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  ,
 `user_id`            bigint NOT NULL ,

PRIMARY KEY (`media_id`),
KEY `fkIdx_1064` (`user_id`),
CONSTRAINT `FK_1065` FOREIGN KEY `fkIdx_1065` (`user_id`) REFERENCES `users` (`user_id`)
);



-- ***************************************************;
-- DROP TABLE IF EXISTS `article_visits`;



-- ************************************** `article_visits`

-- CREATE TABLE IF NOT EXISTS `article_visits`
-- (
--  `visit_id`           bigint NOT NULL AUTO_INCREMENT ,
--  `ip_address`         varchar(45) NOT NULL ,
--  `visit_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  `visit_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
--  `article_id`         bigint NOT NULL ,

-- PRIMARY KEY (`visit_id`),
-- KEY `fkIdx_1092` (`article_id`),
-- CONSTRAINT `FK_1092` FOREIGN KEY `fkIdx_1092` (`article_id`) REFERENCES `articles` (`article_id`)
-- );


-- ***************************************************;
-- DROP TABLE IF EXISTS `api_users`;

-- ************************************** `api_users`
CREATE TABLE IF NOT EXISTS `api_users`
(
 `api_user_id`          bigint NOT NULL AUTO_INCREMENT ,
 `user_id`              bigint NOT NULL ,
 `oauth_uid`            bigint NULL ,
 `oauth_provider`       varchar(140) NULL ,
 `username`             varchar(140) NULL ,
 `oauth_token`          varchar(255) NULL ,
 `oauth_token_secret`   varchar(255) NULL ,
 `first_name`           varchar(140) NULL ,
 `last_name`            varchar(140) NULL ,
 `user_email`           varchar(140) NULL ,
 `user_locale`          varchar(140) NULL ,
 `user_image`           varchar(140) NULL ,
 `user_link`            varchar(140) NULL ,
 `user_date_created`    datetime NULL ,
 `user_date_updated`    datetime NULL ,
 `user_status`          tinyint NOT NULL DEFAULT 1 ,

PRIMARY KEY (`api_user_id`)
);


-- ***************************************************;
-- DROP TABLE IF EXISTS `settings`;

-- ************************************** `settings`

CREATE TABLE IF NOT EXISTS `settings`
(
 `setting_id`           bigint NOT NULL AUTO_INCREMENT ,
 `user_id`              bigint NOT NULL ,
 `subscription_popup`   tinyint NOT NULL DEFAULT 0 ,
 `subscription_active`  tinyint NOT NULL DEFAULT 1 ,
 `article_email_length` tinyint NOT NULL DEFAULT 0 ,
 `setting_email_header` text NOT NULL ,
 `setting_email_footer` text NOT NULL ,
 `setting_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `setting_date_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

PRIMARY KEY (`setting_id`)
);


-- ************************************** `insert user_types`

INSERT INTO `user_types` (`user_type_id`, `user_type`) VALUES (1, 'admin'), (2, 'executive'), (3, 'coordinator'), (4, 'guest'), (5, 'staff')

ON DUPLICATE KEY UPDATE
user_type_id    = VALUES (user_type_id),
user_type       = VALUES (user_type)
;

-- ***************************************************;

INSERT INTO `users` (`user_id`, `user_type_id`, `username`, `email`, `password`, `name`, `last_name`, `last_seen`, `date_created`, `date_updated`, `user_status`) VALUES (1, 1, 'admin', 'info@tralon.co.za', '$2y$12$7ckh0OcRipJe7q2R0me/M.NPoPT6SyJIomXYXRD7skjT0TXg51RMu', 'Admin', '', '2020-01-02 06:55:27', '2020-01-02 00:00:00', '2020-01-02 00:00:00', 1)

ON DUPLICATE KEY UPDATE
username  = VALUES (username),
email     = VALUES (email),
password  = VALUES (password),
name      = VALUES (name),
last_name = VALUES (last_name)
;

-- ***************************************************;


INSERT INTO `users` (`user_id`, `user_type_id`, `username`, `email`, `password`, `name`, `last_name`, `last_seen`, `date_created`, `date_updated`, `user_status`) VALUES (2, 1, 'peterndoro', 'bookings@peterndoro.com', '$2y$12$gxjQlZkz7l0wc7JATeXOM.UgkZfPlKZGcqQKCiUAPC0qEsTXrxaBW', 'Peter', 'Ndoro', '2020-01-02 06:55:27', '2020-01-02 00:00:00', '2020-01-02 00:00:00', 1)

ON DUPLICATE KEY UPDATE
username  = VALUES (username),
email     = VALUES (email),
password  = VALUES (password),
name      = VALUES (name),
last_name = VALUES (last_name)
;
