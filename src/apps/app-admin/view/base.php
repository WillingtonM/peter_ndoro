<?php require_once $header; ?>
<div id="container-1" class="container-<?=$page?>">
  <?php if ($page != 'login'): ?>
    <?php require_once $navbar; ?>
    <div id="body" class="" style="width: 100%;">
      <?php require_once $main_content; ?>
    </div>

  <?php elseif(!isset($_SESSION['user_id']) && ($page == 'login')): ?>

    <div id="body" class="text-center" style="margin: 0 auto; padding-top: 7%;">
      <?php require_once $main_content; ?>

    </div>
  <?php endif; ?>

  <?php require_once $footer; ?>

</div>

</body>
</html>
