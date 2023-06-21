<div class="container">
  <div class="pad-col" style="padding: 39px;"><br><br></div>
  <br><br>
  <div class="row">
    <div id="contact_div/" class="col-12" style="min-height: 100vh;">
      <br>
      <h6 class="text-center alert alert-success" style="border-radius: 15px;"> <span class="" style="color: #555">Search results for</span> <i class="text-warning">"<?= $search ?>"</i> </h6>
      

      <div class="row">
        <?php if (is_array($req_res) || is_object($req_res)) : ?>
          <?php foreach ($req_res as $key => $value) : ?>
            <?php
            $artcl_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['article_publish_date']);
            $cnt_res     = get_article_visits_count($value['article_id']);
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3/ article_container" style="padding: 5px !important;">
              <div class="media_div article_contents artclt_bg1" style="padding: 17px 5px; border-radius: 25px; ">
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
                    <br>
                    <small class="text-muted">
                      <b class="text-warning"><?= $cnt_res ?></b> Article read<?= (($cnt_res > 0) ? 's' : '') ?>
                      &nbsp; | &nbsp; <b class="text-warning"><?= get_article_by_id($value['article_id'])['article_shares'] ?></b> Article shares
                    </small>

                  </div>
                  <div class="article_content hidden" style="padding-top: 5px; overflow: hidden">
                    <p style="font-size: .95rem;"><?= nl2br(short_paragrapth($value['article_content'], 250)) ?>... </p>
                    <a class="text-info" href="article?article=<?= $slugify->slugify($value['article_title']) ?>&slgid=<?= $value['article_id'] ?>&type=<?= $value['article_type'] ?>">Read More ... </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</div>