<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

<div class="row mb-3">
  <div class="col-12">
    <ul class="nav nav-pills nav-justified" id="pills-tab-media" role="tablist">
      <?php $tabbs_count = 0 ?>
      <?php foreach ($media_appearance_nav as $key => $nav) : ?>
        <?php $tabbs_count++ ?>
        <li class="shadow nav-item font-weight-bold article_nav m-1 <?= (((isset($_GET['modal_tab']) && $_GET['modal_tab'] ==  $key) || (!isset($_GET['modal_tab']) && $tabbs_count == 1)) ? 'article_active' : '') ?>">
          <a get-variable="modal_tab" data-name="<?= $key ?>" class="nav-link <?= (((isset($_GET['modal_tab']) && $_GET['modal_tab'] ==  $key) || (!isset($_GET['modal_tab']) && $tabbs_count == 1)) ? 'active' : '') ?>" id="modal_pills-<?= $key ?>-modal_tab" data-bs-toggle="pill" href="#modal_pills-<?= $key ?>" role="tab" aria-controls="modal_pills-<?= $key ?>" aria-selected="<?= (((isset($_GET['modal_tab']) && $_GET['modal_tab'] == $key)  || empty($_GET['modal_tab'])) ? 'true' : 'false') ?>">
            <span class="border-weight-bolder"> <i class="<?= $nav['imgs'] ?>"> &nbsp; </i> <?= $nav['short'] ?> </span>
            <h6 class="text-center sm_text text-xs font-weight-bold mb-0" style="color: #777;"><?= $nav['long'] ?></h6>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<hr class="horizontal dark mt-1 mb-3">

<div class="row">
  <div class="col-12">
    <div class="tab-content" id="notif_tab_media">
      <?php $array_media_count = 0; ?>
      <?php foreach ($media_appearance_nav as $key => $tabs) : ?>
        <?php $array_media_count++; ?>

        <div class="tab-pane fade <?= (((isset($_GET['modal_tab']) && $_GET['modal_tab'] == $key) || (!isset($_GET['modal_tab']) && $array_media_count == 1)) ? 'show active' : '') ?>" id="modal_pills-<?= $key ?>" role="tabpanel" aria-labelledby="modal_pills-<?= $key ?>-modal_tab">
          <div class="row notif_content mb-3 bg-white border-radius-xl">
            <?php require_once $config['PARSERS_PATH'] . 'forms' . DS . $key . '.php' ?>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

  </div>
</div>

<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>