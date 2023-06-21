<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= (isset($_ENV['G_ANALYTIC'])) ? $_ENV['G_ANALYTIC'] : '' ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', '<?= (isset($_ENV['G_ANALYTIC'])) ? $_ENV['G_ANALYTIC'] : '' ?>');
  </script>
  <meta charset="UTF-8" />

  <title><?= ($page == 'article' && isset($req_res)) ? $req_res['article_title'] : strtoupper($page) . ' | ' . PROJECT_TITLE ?></title>
  <!-- <meta http-equiv="refresh" content="500"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="<?= PROJECT_TITLE . ' | ' . $_ENV['PROJECT_DSCPT'] ?>">
  <meta name="keywords" content="<?= $_ENV['PROJECT_DSCPT'] ?>">
  <meta name="note" content="">
  <meta name="subject" content="">
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
  <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
  <link rel="canonical" href="<?= host_url($_SERVER['REQUEST_URI']) ?>">

  <!-- Nucleo Icons -->
  <link href="./css/nucleo-icons.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/cd0ac0cda1.js" crossorigin="anonymous"></script>
  <link href="./css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./css/dashboard.css?v=1.0.3" rel="stylesheet" />

  <!-- animate -->
  <link rel="stylesheet" href="./css/animate.min.css">

  <!-- Custom css files -->
  <link rel="stylesheet" href="./css/master.min.css">

  <!-- custom css -->
  <?php $css_page_file = DIST_CSS_CUSTOM . $page . '.min.css' ?>
  <?php if (file_exists($css_page_file)) : ?>
    <link rel="stylesheet" href="<?= $css_page_file ?>">
  <?php endif; ?>

</head>