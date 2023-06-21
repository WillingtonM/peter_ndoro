<div class="container">
  <br><br>
  <div class="row">
    <br>
    <div id="" class="media_div col-12" style="background-color: rgb(255, 255, 255, 1); padding-top: 25px; border-radius: 25px;">

      <form id="article_form_img" class="text-center" action="index.html" method="post">

        <div id="profile_img_form" class="text-center body_element" style="border: 1px solid #ddd; background-color: #eee; border-radius: 25px; padding: 5px;">
          <a id="img_cspture" class="btn" type="button" name="button">
            <img class="image" style="border-radius: 15px; border: 1px solid #ddd; height: 160px;" src="<?= ((isset($_GET['article_id'])) ? article_img($req_res['article_type'], $req_res['article_image'], 1) : '') ?>" alt="<?= ((isset($req_res) && $req_res != NULL) ? $req_res['article_title'] : '') ?>">
            &emsp;
            <i class="fas fa-camera fa-3x"></i>&emsp;
            <small>Upload profile image </small>
          </a> &emsp;
          <input id="post_image" type="file" name="post_image" accept="image/*" style="display: none;">
        </div>
      </form>
      <form id="article_form" class="" action="index.html" method="post">
        <br>
        <div class="clear-fix">
          <div id="file_uplod">

            <?php if (isset($req_res['article_file']) && !empty($req_res['article_file'])) : ?>
              <?php
              $file_name  = $req_res['article_file'];
              $file_parts = pathinfo($file_name);
              $fl_ext     = 'fa-file';
              $text_colr  = 'text-secondary';
              if (array_key_exists('extension', $file_parts)) {
                switch ($file_parts['extension']) {
                  case "pdf":
                    $fl_ext = 'fa-file-pdf';
                    $text_colr = 'text-danger';
                    break;
                  case "doc" || 'docx':
                    $fl_ext = 'fa-file-word';
                    $text_colr = 'text-primary';
                    break;
                  case "": // Handle file extension for files ending in '.'
                    $fl_ext = 'fa-file';
                  case NULL: // Handle no file extension
                    $fl_ext = 'fa-file';
                    break;
                }
              }
              ?>
              <span class="col-12 alt_dflt">File Attachment</span> &emsp;

              <h5 class="col-12">
                <a class="doc_anchor text-secondary" href="<?= ABS_FILES . $file_name ?>" style="padding-bottom: 15px !important;">
                  <i class="fa <?= $fl_ext . ' ' . $text_colr ?> " aria-hidden="true"></i> &nbsp; <?= $req_res['article_title'] ?>
                </a> &nbsp;
                <embed id="origin_file" src="<?= ABS_FILES . $file_name ?>#page=1&zoom=75" width="575" height="500" style="width: 100%; max-height: 300px; overflow-y: hidden !important; overflow: hidden;">

              </h5>

            <?php endif; ?>

          </div>
          <button type="button" class="btn btn-secondary shadow-none/ float-right/" style="color: #ddd; border-radius: 15px; padding: 5px 15px;" onclick="requestModal(post_modal[5], 'fileModal', {})"> Upload Files</button>
        </div>

        <div class="col-auto contact_radio"><br>
          <label for="contact">Article type</label>
          <br>
          <?php foreach ($article_array as $key => $article) : ?>
            <?php $count++ ?>
            <div class=" custom-control custom-radio">
              <input class="custom-control-input" type="radio" name="article_type" id="reasonRadio<?= $count ?>" value="<?= $key ?>" <?= ((($key == 'blog' && !isset($req_res['article_type'])) || (isset($req_res['article_type']) && $req_res['article_type'] == $key)) ? 'checked' : '') ?>>
              <label class="custom-control-label text-muted" for="reasonRadio<?= $count ?>"><?= $article ?></label>
            </div>&emsp;
          <?php endforeach; ?>

        </div>
        <br>

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-list-alt" aria-hidden="true"></i> </div>
            </div>
            <input type="text" name="article_title" value="<?= ((isset($req_res['article_title'])) ? $req_res['article_title'] : '') ?>" class="form-control shadow-none" id="article_title" placeholder="Article Title" required>
          </div>
          <small class="text-muted col">Article title</small>
        </div>&nbsp;

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-list-alt" aria-hidden="true"></i> </div>
            </div>
            <input type="text" name="article_link" value="<?= ((isset($req_res['article_link'])) ? $req_res['article_link'] : '') ?>" class="form-control shadow-none" id="article_link" placeholder="Article link" required>
          </div>
          <small class="text-muted col">Article Link</small>
        </div>&nbsp;

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-list-alt" aria-hidden="true"></i> </div>
            </div>
            <input type="text" name="article_publisher" value="<?= ((isset($req_res['article_publisher'])) ? $req_res['article_publisher'] : '') ?>" class="form-control shadow-none" id="article_publisher" placeholder="First publisher" required>
          </div>
          <small class="text-muted col">First publisher</small>
        </div>&nbsp;

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-list-alt" aria-hidden="true"></i> </div>
            </div>
            <input type="text" name="article_author" value="<?= ((isset($req_res['article_author'])) ? $req_res['article_author'] : '') ?>" class="form-control shadow-none" id="article_author" placeholder="Article authors" required>
          </div>
          <small class="text-muted col">Article Authors (Separate by a comma)</small>
        </div>&nbsp;

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-list-alt" aria-hidden="true"></i> </div>
            </div>
            <input type="text" name="article_source" value="<?= ((isset($req_res['article_source'])) ? $req_res['article_source'] : '') ?>" class="form-control shadow-none" id="article_source" placeholder="Article image source" required>
          </div>
          <small class="text-muted col">Article Image source</small>
        </div>&nbsp;

        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text text-default-cstm"> <i class="fa fa-calendar" aria-hidden="true"></i> </div>
            </div>
            <input type="date" name="article_publish_date" value="<?= ((isset($req_res['article_publish_date'])) ? date('Y-m-d', strtotime($req_res['article_publish_date'])) : '') ?>" class="form-control shadow-none" id="article_publish_date" placeholder="YYYY/mm/dd" required>
          </div>
          <small class="text-muted col">Article Published date</small>
        </div>&nbsp;

        <div class="col-auto/">
          <div id="" class="col-12">
            <textarea id="mytextarea" class="" name="" rows="8" cols="100" value="" placeholder="Article Content" style="border-radius: none !important;"><?= ((isset($req_res['article_content'])) ? htmlspecialchars($req_res['article_content']) : '') ?></textarea>
          </div>
          <small class="text-muted col">Article content</small>
        </div>&nbsp;
        <hr>
        <?php if (!isset($req_res)) : ?>
          <div class="col-auto">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input id="subscription_publish" name="subscription_publish" value="true" type="checkbox" checked>
              </div>
              <label class="form-check-label" for="cronjob"> &nbsp; Publish to subscribers</label>
            </div>
          </div>&nbsp;
        <?php endif; ?>

        <div class="col-auto">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input id="cronjob" name="cronjob" value="true" type="checkbox" <?= ((isset($req_res['article_cronjob']) && $req_res['article_cronjob'] == 1) ? 'checked' : '') ?>>
            </div>
            <label class="form-check-label" for="cronjob"> &nbsp; Schedule</label>
          </div>
        </div>&nbsp;

        <div class="col-12 form-group">
          <label for="date_of_birth">&nbsp; Schedule Date</label>
          <div class="form-row align-items-center">
            <div class="col-auto">
              <?php $date_days = range(1, 31, 1) ?>
              <!-- <?php echo (int) date('d', strtotime($req_res['article_cronjob_date'])); ?> -->
              <select class="form-control shadow-none" name="dob">
                <?php foreach ($date_days as $value) : ?>
                  <option value="<?= $value ?>" <?= ((isset($req_res['article_cronjob_date']) && (int) date('d', strtotime($req_res['article_cronjob_date'])) == $value) ? 'selected' : ((!isset($req_res['article_cronjob_date']) && empty($req_res['article_cronjob_date']) && $value == (int)date('d')) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>

            </div>

            <div class="col-auto">
              <select class="form-control shadow-none" name="mob">
                <?php foreach ($date_months as $key => $month) : ?>
                  <option value="<?= $key ?>" <?= ((isset($req_res['article_cronjob_date']) && (int) date('m', strtotime($req_res['article_cronjob_date'])) == $key) ? 'selected' : ((!isset($req_res['article_cronjob_date']) && empty($req_res['article_cronjob_date']) && $key == (int)date("m")) ? 'selected' : '')) ?>><?= $month ?></option>
                <?php endforeach; ?>
              </select>

            </div>

            <div class="col-auto">
              <?php $date_days = range(date("Y"), 1900, -1) ?>
              <select class="form-control shadow-none" name="yob">
                <?php foreach ($date_days as $value) : ?>
                  <option value="<?= $value ?>" <?= ((isset($req_res['article_cronjob_date']) && (int) date('Y', strtotime($req_res['article_cronjob_date'])) == $value) ? 'selected' : ((!isset($req_res['article_cronjob_date']) && empty($req_res['article_cronjob_date']) && $value == date("Y")) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            @ hour
            <div class="col-auto">
              <?php $date_days = range(1, 24, 1) ?>
              <select class="form-control shadow-none" name="hour">
                <?php foreach ($date_days as $value) : ?>
                  <option value="<?= $value ?>" <?= ((isset($req_res['article_cronjob_date']) && (int) date('d', strtotime($req_res['article_cronjob_date'])) == $value) ? 'selected' : ((!isset($req_res['article_cronjob_date']) && empty($req_res['article_cronjob_date']) && $value == 6) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>

            </div>

          </div>
        </div>

        <?php if ($article_id) : ?>
          <input id="article_id" type="hidden" name="article_id" value="<?= $article_id ?>">
        <?php endif; ?>

      </form>
      &nbsp;
      <div id="error_pop" class="error_pop col-12"></div>

      &nbsp;
      <div class="col-12">
        <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 11px;" onclick="modal_post()">Save changes</button>
        <button type="button" class="btn btn-sm btn-info" style="border-radius: 11px;" onclick="requestModal( post_modal[7], post_modal[7], $('#article_form').serialize() + '&article_content=' + encodeURIComponent(tinyMCE.get('mytextarea').getContent()), 1); ">View Article</button>

        <div class="float-right">
          <a href="./blog?<?= ($article_id) ? '&tab=' . $req_res['article_type'] : '' ?>" style="border-radius: 11px;" class="btn btn-warning float-right/ btn-sm">Cancel</a> &nbsp;
          <?php if (isset($article_id) && !empty($article_id)) : ?>
            <button type="button" class="btn btn-sm btn-danger float-right/" style="border-radius: 11px;" onclick="postonly('',{'article_id': <?= $article_id ?>, 'article_remove':true, 'article_type':'<?= $req_res['article_type'] ?>'})">Remove article</button>
          <?php endif; ?>
        </div>
        <br>
        <br><br><br>
      </div>

    </div>

  </div>



</div>