<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php require_once $header; ?>

<body id="body-div" class="g-sidenav-show">
  <input id="site_type" type="hidden" name="site_type" value="public">
  <input id="token" type="hidden" name="token" value="<?= get_token(); ?>">

  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>

  <!-- <div class="text-center booking-parent btn shadow-none" onclick="requestModal(post_modal[9], post_modal[9], {})">
    <center>
      <img src="<?= PROJECT_LOGO ?>" class="text-center" width="60" height="60" loading="lazy" alt="<?= PROJECT_TITLE ?>">
    </center>
    <div class="col w-100 side_btn_text border-radius-lg p-1">
      <a class="text-center booking-text cursor-pointer">
        <small class="font-weight-bolder">BOOKING</small>
      </a>
    </div>
  </div> -->

  <?php if (!in_array($page, $page_excludes) || (isset($_SESSION['user_id']) && $_SESSION['user_status'] == TRUE && in_array($page, $page_excludes))) : ?>
    <?php require_once $navbar; ?>
    <?php require_once $side_content; ?>
  <?php endif; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <div id="container-1" class="container-<?= $page ?>">
      <?php if (!in_array($page, $page_excludes) || (isset($_SESSION['user_id']) && $_SESSION['user_status'] == TRUE && in_array($page, $page_excludes))) : ?>
        <div id="body" class="body_div <?= ((isset($_SESSION['window_resize']) && $_SESSION['window_resize'] == true) ? 'body_toggle' : '') ?>" style="width/: 100%;">
          <?php require_once $main_content; ?>
        </div>
      <?php elseif (isset($_SESSION['user_id']) || (in_array($page, $page_excludes))) : ?>
        <div id="" class="container">
          <?php require_once $main_content; ?>
        </div>
      <?php endif; ?>

      <?php require_once $layout_path . 'modals.php'; ?>


      <div id="modalDiv" class="modalDiv" style="z-index: 99999;"></div>

      <footer class="footer/ fixed-bottom/ bg-white/ shadow pt-2" style="z-index: 1;">
        <div class="container">
          <?php require_once $footer; ?>
        </div>
      </footer>

    </div>

  </main>

  <!-- scripts -->
  <?php require_once $js_scripts ?>
</body>

</html>