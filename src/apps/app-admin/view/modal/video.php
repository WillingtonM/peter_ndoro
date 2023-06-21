<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>
<div class="row">
  <div class="col-12 shadow p-3 mb-3 bg-white rounded">
    <sapn class="font-weight-bolder text-center text-secondary ps-3"><?= (isset($req_res) && !empty($req_res)) ? 'Edit' : 'Add' ?> Video</sapn>
  </div>
</div>

<?php require_once $config['PARSERS_PATH'] . 'forms' .DS . 'media_video.php' ?>

<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>
