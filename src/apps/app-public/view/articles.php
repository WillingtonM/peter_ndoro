<div class="container">
  <div class="pad-col" style="padding: 39px;"><br><br></div>

  <div style="padding: 30px;"></div>

  <?php if ($data['error']) : ?>
    <div class="row">
      <div class="col-12 text-center">
        <div class="alert alert-warning">
          <h3 class="text-warning">There is Something wrong with your request</h3>
        </div>
      </div>
    </div>
  <?php else : ?>

    <div class="row">

      <div class="col-12">
        <ul class="nav nav-tabs nav-justified" id="myTab" style="border: none;">
          <?php foreach ($article_navba as $key => $article) : ?>
            <?php $tabbs_count++ ?>
            <li style="margin: 5px;" class="nav-item article_nav <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'article_active' : '') ?>" onclick="change_bg(parseInt(<?= $tabbs_count ?>) - 1);">
              <a onclick="changeURL('<?= $key ?>')" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'active' : '') ?>" id="<?= $key ?>-tab" data-toggle="tab" href="#<?= $key ?>" role="tab" aria-controls="<?= $key ?>" aria-selected="true">
                <span style="font-weight: bolder;"> <i class="far fa-newspaper <?= $article['imgs'] ?>"></i> &nbsp; <?= $article['short'] ?> </span>
                <h6 class="text-center sm_text" style="color: #777;"><?= $article['long'] ?></h6>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>

      </div>

      <div class="tab-content col-12" style="padding: 25px 0;">

        <?php foreach ($article_array as $key => $article) : ?>
          <?php $array_count++; ?>

          <div class="tab-pane <?= (((isset($_GET['tab']) && $_GET['tab'] == $key) || (!isset($_GET['tab']) && $array_count == 1)) ? 'active' : '') ?>" id="<?= $key ?>" role="tabpanel" aria-labelledby="<?= $key ?>-tab">
            <div class="row">
              <?php

              $article_type   = $key;
              $page_nmb       = (int) (isset($_GET['page']) && $_GET['page'] != '' && isset($_GET['tab']) && $_GET['tab'] == $article_type) ? $_GET['page'] : 1;

              if (HOST_IS_LIVE) {
                $cnt_sql      = "SELECT count(*) FROM articles WHERE article_status = 1 AND article_type = ?";
                $cnt_dta      = [$article_type];
                $artcl_count  = (int) prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3]);
              }

              $page_count     = ceil(($artcl_count / $intval));
              $sql_pg_strt    = (int)($page_nmb - 1) * $intval;

              if (HOST_IS_LIVE) {
                $rgst_sql     = "SELECT article_id, article_title, article_type, article_link, article_publisher, article_publish_date, article_content, article_source, article_image, article_author, article_status, article_date_created, user_id FROM articles WHERE article_type = ? AND article_status = 1 ORDER BY article_publish_date DESC LIMIT $sql_pg_strt, $intval";
                $rgst_dta     = [$article_type];
                $nwsf_qry     = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
              }

              ?>

              <?php if (is_array($nwsf_qry) || is_object($nwsf_qry)) : ?>
                <?php foreach ($nwsf_qry as $key => $value) : ?>
                <?php
                  $artcl_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['article_publish_date']);
                  $cnt_res     = get_article_visits_count($value['article_id']);
                ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3/ article_container" style="padding: 5px !important;">
                    <div class="media_div article_contents artclt_bg<?= $array_count ?>" style="padding: 17px 5px; border-radius: 25px; ">
                      <a class="text-center col-12" style="padding: 0;" href="article?article=<?= $slugify->slugify($value['article_title']) ?>&slgid=<?= $value['article_id'] ?>&type=<?= $value['article_type'] ?>">
                        <img class="img-thumbnail img-responsive/" src="<?= article_img($value['article_type'], $value['article_image'], 2) ?>" alt="<?= $value['article_title'] ?>" style="max-height: 229px; border: 1px solid #efefef; border-radius: 15px; display: block; margin: 0 auto;">
                      </a>
                      <div class="col-12" style="padding-top: 15px;">
                        <div class="" style="padding-bottom: 0px; border-left: 4px solid #777; padding-left: 15px;">
                          <h4 class="mt-0 mb-1">
                            <a class="text-secondary" href="article?article=<?= $slugify->slugify($value['article_title']) ?>&slgid=<?= $value['article_id'] ?>&type=<?= $value['article_type'] ?>">
                              <?= $value['article_title'] ?>
                            </a>
                          </h4>
                          <?php if (!empty($value['article_publisher']) && !empty($value['article_publisher'])) : ?>
                            <i class="text-muted"> First Published in <?= (isset($value['article_link']) && check_url($value['article_link'])) ? '<a href="' . $value['article_link'] . '" target="_blank" class="text-info"><b>' . $value['article_publisher'] . '</b></a>' : $value['article_publisher'] ?> on &nbsp; </i>
                          <?php elseif (!empty($value['article_type']) && $value['article_type'] == 'business_day') : ?>
                            <i class="text-muted"> <?= ($value['article_type'] == 'business_day') ? 'First Published in ' . ((!empty($value['article_link']) && check_url($value['article_link'])) ? '<a href="' . $value['article_link'] . '" target="_blank" class="text-info"><b>Business Day</b></a>' : '<b>Business Day</b>') . ' on' : 'Published on' ?> , &nbsp; </i>
                          <?php else : ?>
                            <i class="text-muted"> Published on &nbsp; </i>
                          <?php endif; ?>

                          <?php if (!empty($value['article_link']) && check_url($value['article_link'])) : ?>
                            <a href="<?= $value['article_link'] ?>" style="font-size/: 11px;" target="_blank" class="text-info"><?= $artcl_date->format('F jS, Y') ?></a>
                          <?php else : ?>
                            <span class="text-warning"> <?= $artcl_date->format('F jS, Y') ?></span>
                          <?php endif; ?>
                        </div>
                        <div class="article_content hidden" style="padding-top: 5px; overflow: hidden">
                          <p style="font-size: .95rem;"><?= nl2br(short_paragrapth(strip_tags($value['article_content']), 2500)) ?>... </p>
                          <a class="text-info" href="article?article=<?= $slugify->slugify($value['article_title']) ?>&slgid=<?= $value['article_id'] ?>&type=<?= $value['article_type'] ?>">Read More ... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>

              <br><br>
            </div>
            <div class="row">
              <!-- paggination -->
              <?php if ($page_count > 1) : ?>
                <div class="col-12">
                  <br><br>
                  <nav aria-label="Page navigation text-secondary text-center/">
                    <ul class="pagination text-center/ float-right">
                      <li class="page-item">
                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (((int)$page_nmb - 1 <= 0) ? $page_nmb : $page_nmb - 1) ?>" <?= (($page_nmb - 1 <= 0) ? 'disabled' : '') ?> aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <?php for ($pg = 1; $pg <= $page_count; $pg++) : ?>
                        <li class="page-item"><a class="page-link <?= (($pg == $page_nmb) ? 'text-danger' : 'text-secondary') ?>" href="?tab=<?= $article_type ?>&page=<?= $pg ?>"><?= $pg ?></a></li>
                      <?php endfor; ?>
                      <li class="page-item">
                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (($page_nmb >= $page_count) ? $page_nmb : $page_nmb + 1) ?>" <?= (($page_nmb >= $page_count) ? 'disabled' : '') ?> aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              <?php endif; ?>
            </div>
          </div>

        <?php endforeach; ?>

      </div>

    </div>

  <?php endif; ?>

  <br><br>

</div>