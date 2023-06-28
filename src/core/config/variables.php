<?php
// sql execution statement types
$app_links          = array('', 'home', 'users', 'blog', 'blog-article', 'media', 'contact', 'logout', 'academics', 'about', 'search', 'test', 'confirmation', 'confirm', 'subscriptions');
$sql_request_data   = array('fetchcolumn', 'fetchall', 'execute', 'countrows');
$page_excludes      = array('login', 'logout', 'passreset', 'terms', 'policy', 'confirm', 'settings', 'resetpass');
$project_status     = array('production' => true, 'development' => true, 'staging' => true);
$question_types     = array('radio', 'text', 'full_text');
$image_modify_paths = array('', 'sqaure', 'rect');
$media_types        = array('video');
$article_types      = array('blog', 'article');
$article_array      = array('article' => 'Authored publications', 'blog' => 'Blog');
$media_array        = array('appearance' => 'Media Appearances', 'gallery' => 'Gallery', 'file' => 'Files');

$admin_emails = array(
  'admin' => array(
    'name'  => $_ENV['MAIL_USER'],
    'mail'  => $_ENV['MAIL_MAIL'],
  ),
  'fifi' => array(
    'name'  => 'Fifi Peters',
    'mail'  => 'bookings@misspeters.com',
  ),
  'alt' => array(
    'name'  => 'Admin',
    'mail'  => 'admin@misspeters.com',
  ),
'will' => array(
    'name'  => 'Admin',
    'mail'  => 'will.mhlanga@tralon.co.za',
  ),
);

$admin_pages = array(
  // 'users' => array(
  //   'short' => 'Users',
  //   'long'  => 'Manage users',
  //   'imgs'  => 'fas fa-users',
  //   // 'imgs'  => 'user_profile.png',
  //   'type'  => 'img',
  //   'link'  => 'users',
  //   'anim'  => 'zoomInLeft'
  // ),
  // 'subscriptions' => array(
  //   'short' => 'Subscriptions',
  //   'long'  => 'Manage Subscriptions',
  //   'imgs'  => 'fas fa-email',
  //   // 'imgs'  => 'user_profile.png',
  //   'type'  => 'img',
  //   'link'  => 'users',
  //   'anim'  => 'zoomInLeft'
  // ),
  // 'blog' => array(
  //   'short' => 'Articles & Blogs',
  //   'long'  => 'Manage articles, publications and blogs',
  //   'imgs'  => 'fas fa-blog',
  //   // 'imgs'  => 'user_profile.png',
  //   'type'  => 'img',
  //   'link'  => 'about',
  //   'anim'  => 'zoomInLeft'
  // ),
  'feedback' => array(
    'short' => 'Feedback',
    'long'  => 'Manage User Feedback',
    'imgs'  => 'fa-solid fa-rss',
    // 'imgs'  => 'publications.png',
    'type'  => 'img',
    'link'  => 'feedback',
    'anim'  => 'zoomInUp'
  ),
  // 'events' => array(
  //   'short' => 'Events',
  //   'long'  => 'Manage Events',
  //   'imgs'  => 'fab fa-calendar',
  //   // 'imgs'  => 'publications.png',
  //   'type'  => 'img',
  //   'link'  => 'articles?tab=article',
  //   'anim'  => 'zoomInUp'
  // ),
  'bookings' => array(
    'short' => 'Bookings',
    'long'  => 'Manage Bookings',
    'imgs'  => 'fas fa-calendar-alt',
    // 'imgs'  => 'publications.png',
    'type'  => 'img',
    'link'  => 'bookings',
    'anim'  => 'zoomInUp'
  ),
  'media' => array(
    'short' => 'Media',
    'long'  => 'Gallery, Files & Videos',
    'imgs'  => 'fas fa-photo-video',
    // 'imgs'  => 'blog.png',
    'type'  => 'img',
    'link'  => 'media',
    'anim'  => 'zoomInRight'
  ),
  // 'pages' => array(
  //   'short' => 'Pages',
  //   'long'  => 'Manage Pages ',
  //   'imgs'  => 'fas fa-edit',
  //   // 'imgs'  => 'blog.png',
  //   'type'  => 'img',
  //   'link'  => 'articles?tab=blog',
  //   'anim'  => 'zoomInRight'
  // ),
);

// pages
$pages_nav      = array(
  'home' => array(
    'short' => 'Home Page',
    'long'  => 'Published policy briefs, journal articles, op-eds and research blogs',
    'imgs'  => 'fas fa-home',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'contact' => array(
    'short' => 'Contact Page',
    'long'  => 'Weekly economic analysis & insights',
    'imgs'  => 'fas fa-id-card',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  )
);

$home_array         = array(
  'journalist' => array(
    'short' => 'Media & Journalism',
    'long'  => 'Learn more <b> <a href="./about"> here </a> </b> and view his Media & Journalism <b> <a href="./media?tab=appearance"> here </a> </b>',
    'font'  => 'fa-solid fa-newspaper',
    'imgs'  => 'user_profile.png',
    'type'  => 'img',
    'link'  => 'media',
    'anim'  => 'slideInLeft',
    'wait'  => '0',
  ),
  'galery' => array(
    'short' => 'MC, Webinar, Panel Facilitator',
    'long'  => 'Learn more <b> <a href="./about"> here </a> </b> and view his gallery <b> <a href="./media?tab=gallery"> here </a> </b>',
    'font'  => 'fa-solid fa-chalkboard-user',
    'imgs'  => 'publications.png',
    'type'  => 'img',
    'link'  => 'media?tab=gallery',
    'anim'  => 'slideInUp',
    'wait'  => '1',
  ),
  'podcast' => array(
    'short' => 'Podcast',
    'long'  => 'Learn more <b> <a href="./about"> here </a> </b> and view his Podcasts <b> <a href="./media?tab=podcast"> here </a> </b>',
    'font'  => 'fa-solid fa-podcast',
    'imgs'  => 'podcast-pic.png',
    'type'  => 'img',
    'link'  => 'media?tab=podcast',
    'anim'  => 'slideInRight',
    'wait'  => '0',
  ),
);

$services_navba      = array(
  'speaker' => array(
    'short' => 'Conference Speaker',
    'long'  => 'Conference Speaker services',
    'imgs'  => 'fa-solid fa-building',
    'type'  => 'font',
    'anim'  => 'pulse',
    'wait'  => '1',
  ),
  'moderator' => array(
    'short' => 'Moderator',
    'long'  => 'Moderator and facilitation services',
    'imgs'  => 'fa-solid fa-building',
    'type'  => 'font',
    'anim'  => 'pulse',
    'wait'  => '1',
  ),
  'mc' => array(
    'short' => 'MC | <small> <i class="text-xm">Master of Ceremonies</i> </small>',
    'long'  => 'MC | <small> <i class="text-xm">Master of Ceremonies</i> </small>',
    'imgs'  => 'fa-solid fa-microphone-lines',
    'type'  => 'font',
    'anim'  => 'pulse',
    'wait'  => '1',
  ),
);

$article_navba      = array(
  'article' => array(
    'short' => 'Authored publications',
    'long'  => 'Published policy briefs, journal articles, op-eds and research blogs',
    'imgs'  => 'fab fa-leanpub',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'blog' => array(
    'short' => 'Blog',
    'long'  => 'Weekly economic analysis & insights',
    'imgs'  => 'fas fa-blog',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  )
);

// contact tabs
$contact_tabs         = array(
  'client' => array(
    'short' => 'Client Inquiries',
    'long'  => '',
    'font'  => 'fa-solid fa-circle-info',
    'imgs'  => '/icons/articles-white.png',
    'type'  => 'img',
    'link'  => '',
    'call'  => '+27 00 000 0000',
    'wapp'  => '27 00 000 0000',
    'mail'  => 'info@'.$_ENV['PROJECT_HOST'],
    'site'  => $_ENV['PROJECT_HOST'],
    'anim'  => 'slideInUp',
    'wait'  => '1',
  ),
  'media' => array(
    'short' => 'Media Inquiries',
    'long'  => '',
    'font'  => 'fa-solid fa-newspaper',
    'imgs'  => '/icons/media-white.png',
    'type'  => 'img',
    'link'  => '',
    'call'  => '+27 21 879 3035',
    'wapp'  => '27 21 879 3035',
    'mail'  => 'media@'.$_ENV['PROJECT_HOST'],
    'site'  => $_ENV['PROJECT_HOST'],
    'anim'  => 'slideInUp',
    'wait'  => '2',
  ), 
  'business' => array(
    'short' => 'Business Related',
    'long'  => '',
    'font'  => 'fa-solid fa-address-book',
    'imgs'  => '/icons/newsletter-white.png',
    'type'  => 'img',
    'link'  => '',
    'call'  => '+27 21 879 3035',
    'wapp'  => '27 21 879 3035',
    'mail'  => 'business@'.$_ENV['PROJECT_HOST'],
    'site'  => $_ENV['PROJECT_HOST'],
    'anim'  => 'slideInUp',
    'wait'  => '3',
  ),
  'recruitment' => array(
    'short' => 'Recruitment Related',
    'long'  => '',
    'font'  => 'fa-solid fa-briefcase',
    'imgs'  => '/icons/newsletter-white.png',
    'type'  => 'img',
    'link'  => '',
    'call'  => '+27 21 879 3035',
    'wapp'  => '27 21 879 3035',
    'mail'  => 'jobs@'.$_ENV['PROJECT_HOST'],
    'site'  => $_ENV['PROJECT_HOST'],
    'anim'  => 'slideInUp',
    'wait'  => '4',
  ),
);

$booking_navba      = array(
  'moderator' => array(
    'short' => 'Moderator',
    'long'  => 'Moderator Bookings',
    'imgs'  => 'fas fa-chalkboard-teacher',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'mc' => array(
    'short' => 'MC',
    'long'  => 'MC Bookings',
    'imgs'  => 'fab fa-teamspeak',
    // 'imgs'  => 'fab fa-uncharted',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),
  'speaker' => array(
    'short' => 'Conference Speaker',
    'long'  => 'Conference Speaker Bookings',
    'imgs'  => 'fas fa-microphone-alt',
    // 'imgs'  => 'fab fa-uncharted',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),

);

$admin_booking      = array(
  'moderator' => array(
    'short' => 'Moderator',
    'long'  => 'Moderator Bookings',
    'imgs'  => 'fas fa-chalkboard-teacher',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'mc' => array(
    'short' => 'MC',
    'long'  => 'MC Bookings',
    'imgs'  => 'fab fa-teamspeak',
    // 'imgs'  => 'fab fa-uncharted',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),
  'processed' => array(
    'short' => 'Processed',
    'long'  => 'Processed Bookings',
    'imgs'  => 'fas fa-clipboard-check',
    // 'imgs'  => 'fab fa-uncharted',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),

);

$navbar_media      = array(
  'appearance' => array(
    'short' => 'Media & Journalism',
    'long'  => 'Media, Journalism & TV Appearances ',
    'imgs'  => 'fa-solid fa-newspaper',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'podcast' => array(
    'short' => 'Podcasts',
    'long'  => 'Published podcasts',
    'imgs'  => 'fa-solid fa-podcast',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'gallery' => array(
    'short' => 'MC, Moderator Gallery',
    'long'  => 'MC, Speaker and Moderator Gallery',
    'imgs'  => 'fa-solid fa-camera-retro',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),
);

$media_navba      = array(
  'appearance' => array(
    'short' => 'TV Appearances',
    'long'  => 'Journalism, MC & Moderation',
    'imgs'  => 'fa-solid fa-newspaper',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'podcast' => array(
    'short' => 'Podcasts',
    'long'  => 'Published podcasts',
    'imgs'  => 'fa-solid fa-podcast',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'gallery' => array(
    'short' => 'Gallery',
    'long'  => 'Media Gallery',
    'imgs'  => 'fa-solid fa-camera-retro',
    'type'  => 'font',
    'anim'  => 'zoomInLeft'
  ),
);

$media_appearance_nav = array(
  'media_appearance' => array(
    'short' => 'TV & Podcasts',
    'long'  => 'TV Appearances and Podcats',
    'imgs'  => 'fa-solid fa-podcast',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
  'media_video' => array(
    'short' => 'Videos',
    'long'  => 'Published podcasts',
    'imgs'  => 'fa-solid fa-video',
    'type'  => 'font',
    'anim'  => 'zoomInUp'
  ),
);

// dietary
$dietary_list = array(
  'none'        => 'None',
  'vegetarian'  => 'Vegetarian',
  'vegan'       => 'Vegan',
  'gluten'      => 'Gluten-free',
  'dairy'       => 'Dairy-free',
  'other'       => 'Other (Please elaborate below)',
);

// social media
$social_media = array(
  'intagram'  => array(
    'name' => 'instagram',
    'user' => '',
    'font' => 'fab fa-instagram',
    'link' => 'https://www.instagram.com/peterndoro_/',
    'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/instagram.png',
  ),
  'linkedin'  => array(
    'name' => 'linkedin',
    'user' => '',
    'font' => 'fa-brands fa-linkedin-in',
    'link' => 'https://twitter.com/peterndoro',
    'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/linkedin.png',
  ),
  'twitter'   => array(
    'name' => 'twitter',
    'user' => '',
    'font' => 'fab fa-twitter',
    'link' => 'https://twitter.com/peterndoro',
    'lnk2' => 'https://' . $_ENV['PROJECT_HOST'] . '/img/other/twitter.png',
  ),
);

// months
$date_months = array(
  "1"   => "January",
  "2"   => "Febuary",
  "3"   => "March",
  "4"   => "April",
  "5"   => "May",
  "6"   => "June",
  "7"   => "July",
  "8"   => "August",
  "9"   => "September",
  "10"  => "October",
  "11"  => "November",
  "12"  => "December",
);

// countries
$countries_array = array(
  "AF" => "Afghanistan",
  "AL" => "Albania",
  "DZ" => "Algeria",
  "AS" => "American Samoa",
  "AD" => "Andorra",
  "AO" => "Angola",
  "AI" => "Anguilla",
  "AQ" => "Antarctica",
  "AG" => "Antigua and Barbuda",
  "AR" => "Argentina",
  "AM" => "Armenia",
  "AW" => "Aruba",
  "AU" => "Australia",
  "AT" => "Austria",
  "AZ" => "Azerbaijan",
  "BS" => "Bahamas",
  "BH" => "Bahrain",
  "BD" => "Bangladesh",
  "BB" => "Barbados",
  "BY" => "Belarus",
  "BE" => "Belgium",
  "BZ" => "Belize",
  "BJ" => "Benin",
  "BM" => "Bermuda",
  "BT" => "Bhutan",
  "BO" => "Bolivia",
  "BA" => "Bosnia and Herzegowina",
  "BW" => "Botswana",
  "BV" => "Bouvet Island",
  "BR" => "Brazil",
  "IO" => "British Indian Ocean Territory",
  "BN" => "Brunei Darussalam",
  "BG" => "Bulgaria",
  "BF" => "Burkina Faso",
  "BI" => "Burundi",
  "KH" => "Cambodia",
  "CM" => "Cameroon",
  "CA" => "Canada",
  "CV" => "Cape Verde",
  "KY" => "Cayman Islands",
  "CF" => "Central African Republic",
  "TD" => "Chad",
  "CL" => "Chile",
  "CN" => "China",
  "CX" => "Christmas Island",
  "CC" => "Cocos (Keeling) Islands",
  "CO" => "Colombia",
  "KM" => "Comoros",
  "CG" => "Congo",
  "CD" => "Congo, the Democratic Republic of the",
  "CK" => "Cook Islands",
  "CR" => "Costa Rica",
  "CI" => "Cote d'Ivoire",
  "HR" => "Croatia (Hrvatska)",
  "CU" => "Cuba",
  "CY" => "Cyprus",
  "CZ" => "Czech Republic",
  "DK" => "Denmark",
  "DJ" => "Djibouti",
  "DM" => "Dominica",
  "DO" => "Dominican Republic",
  "TP" => "East Timor",
  "EC" => "Ecuador",
  "EG" => "Egypt",
  "SV" => "El Salvador",
  "GQ" => "Equatorial Guinea",
  "ER" => "Eritrea",
  "EE" => "Estonia",
  "ET" => "Ethiopia",
  "FK" => "Falkland Islands (Malvinas)",
  "FO" => "Faroe Islands",
  "FJ" => "Fiji",
  "FI" => "Finland",
  "FR" => "France",
  "FX" => "France, Metropolitan",
  "GF" => "French Guiana",
  "PF" => "French Polynesia",
  "TF" => "French Southern Territories",
  "GA" => "Gabon",
  "GM" => "Gambia",
  "GE" => "Georgia",
  "DE" => "Germany",
  "GH" => "Ghana",
  "GI" => "Gibraltar",
  "GR" => "Greece",
  "GL" => "Greenland",
  "GD" => "Grenada",
  "GP" => "Guadeloupe",
  "GU" => "Guam",
  "GT" => "Guatemala",
  "GN" => "Guinea",
  "GW" => "Guinea-Bissau",
  "GY" => "Guyana",
  "HT" => "Haiti",
  "HM" => "Heard and Mc Donald Islands",
  "VA" => "Holy See (Vatican City State)",
  "HN" => "Honduras",
  "HK" => "Hong Kong",
  "HU" => "Hungary",
  "IS" => "Iceland",
  "IN" => "India",
  "ID" => "Indonesia",
  "IR" => "Iran (Islamic Republic of)",
  "IQ" => "Iraq",
  "IE" => "Ireland",
  "IL" => "Israel",
  "IT" => "Italy",
  "JM" => "Jamaica",
  "JP" => "Japan",
  "JO" => "Jordan",
  "KZ" => "Kazakhstan",
  "KE" => "Kenya",
  "KI" => "Kiribati",
  "KP" => "Korea, Democratic People's Republic of",
  "KR" => "Korea, Republic of",
  "KW" => "Kuwait",
  "KG" => "Kyrgyzstan",
  "LA" => "Lao People's Democratic Republic",
  "LV" => "Latvia",
  "LB" => "Lebanon",
  "LS" => "Lesotho",
  "LR" => "Liberia",
  "LY" => "Libyan Arab Jamahiriya",
  "LI" => "Liechtenstein",
  "LT" => "Lithuania",
  "LU" => "Luxembourg",
  "MO" => "Macau",
  "MK" => "Macedonia, The Former Yugoslav Republic of",
  "MG" => "Madagascar",
  "MW" => "Malawi",
  "MY" => "Malaysia",
  "MV" => "Maldives",
  "ML" => "Mali",
  "MT" => "Malta",
  "MH" => "Marshall Islands",
  "MQ" => "Martinique",
  "MR" => "Mauritania",
  "MU" => "Mauritius",
  "YT" => "Mayotte",
  "MX" => "Mexico",
  "FM" => "Micronesia, Federated States of",
  "MD" => "Moldova, Republic of",
  "MC" => "Monaco",
  "MN" => "Mongolia",
  "MS" => "Montserrat",
  "MA" => "Morocco",
  "MZ" => "Mozambique",
  "MM" => "Myanmar",
  "NA" => "Namibia",
  "NR" => "Nauru",
  "NP" => "Nepal",
  "NL" => "Netherlands",
  "AN" => "Netherlands Antilles",
  "NC" => "New Caledonia",
  "NZ" => "New Zealand",
  "NI" => "Nicaragua",
  "NE" => "Niger",
  "NG" => "Nigeria",
  "NU" => "Niue",
  "NF" => "Norfolk Island",
  "MP" => "Northern Mariana Islands",
  "NO" => "Norway",
  "OM" => "Oman",
  "PK" => "Pakistan",
  "PW" => "Palau",
  "PA" => "Panama",
  "PG" => "Papua New Guinea",
  "PY" => "Paraguay",
  "PE" => "Peru",
  "PH" => "Philippines",
  "PN" => "Pitcairn",
  "PL" => "Poland",
  "PT" => "Portugal",
  "PR" => "Puerto Rico",
  "QA" => "Qatar",
  "RE" => "Reunion",
  "RO" => "Romania",
  "RU" => "Russian Federation",
  "RW" => "Rwanda",
  "KN" => "Saint Kitts and Nevis",
  "LC" => "Saint LUCIA",
  "VC" => "Saint Vincent and the Grenadines",
  "WS" => "Samoa",
  "SM" => "San Marino",
  "ST" => "Sao Tome and Principe",
  "SA" => "Saudi Arabia",
  "SN" => "Senegal",
  "SC" => "Seychelles",
  "SL" => "Sierra Leone",
  "SG" => "Singapore",
  "SK" => "Slovakia (Slovak Republic)",
  "SI" => "Slovenia",
  "SB" => "Solomon Islands",
  "SO" => "Somalia",
  "ZA" => "South Africa",
  "GS" => "South Georgia and the South Sandwich Islands",
  "ES" => "Spain",
  "LK" => "Sri Lanka",
  "SH" => "St. Helena",
  "PM" => "St. Pierre and Miquelon",
  "SD" => "Sudan",
  "SR" => "Suriname",
  "SJ" => "Svalbard and Jan Mayen Islands",
  "SZ" => "Swaziland",
  "SE" => "Sweden",
  "CH" => "Switzerland",
  "SY" => "Syrian Arab Republic",
  "TW" => "Taiwan, Province of China",
  "TJ" => "Tajikistan",
  "TZ" => "Tanzania, United Republic of",
  "TH" => "Thailand",
  "TG" => "Togo",
  "TK" => "Tokelau",
  "TO" => "Tonga",
  "TT" => "Trinidad and Tobago",
  "TN" => "Tunisia",
  "TR" => "Turkey",
  "TM" => "Turkmenistan",
  "TC" => "Turks and Caicos Islands",
  "TV" => "Tuvalu",
  "UG" => "Uganda",
  "UA" => "Ukraine",
  "AE" => "United Arab Emirates",
  "GB" => "United Kingdom",
  "US" => "United States",
  "UM" => "United States Minor Outlying Islands",
  "UY" => "Uruguay",
  "UZ" => "Uzbekistan",
  "VU" => "Vanuatu",
  "VE" => "Venezuela",
  "VN" => "Viet Nam",
  "VG" => "Virgin Islands (British)",
  "VI" => "Virgin Islands (U.S.)",
  "WF" => "Wallis and Futuna Islands",
  "EH" => "Western Sahara",
  "YE" => "Yemen",
  "YU" => "Yugoslavia",
  "ZM" => "Zambia",
  "ZW" => "Zimbabwe"
);
