<div class="container">
  <br><br>
  <div class="row">
    <div id="" class="media_div col-12" style="background-color: rgb(255, 255, 255, 1); padding-top: 25px; border-radius: 25px;">
      <div class="row">
        <div class="col-12 text-center/">
          <a href="blog-article" class="btn btn-secondary shadow-none float-right"> Create Article</a>
          <br>
          <div class="col-12" style="padding: 15px 15px;">
            <ul class="nav nav-pills" id="myTab" role="tablist" style="background: rgb(49, 62, 68, .9) !important; width:fit-content; padding: 0px 25px; border-radius: 20px;">
              <?php $count = 0 ?>
              <?php foreach ($article_array as $key => $article) : ?>
                <?php $count++ ?>
                <li class="nav-item">
                  <a onclick="changeURL('<?= $key ?>')" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] == $key) || (!isset($_GET['tab']) && $count == 1)) ? 'active' : '') ?>" id="<?= $key ?>-tab" data-toggle="tab" href="#<?= $key ?>" role="tab" aria-controls="<?= $key ?>" aria-selected="true"><?= $article ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <hr>

          <div class="tab-content">
            <?php $count = 0 ?>
            <?php foreach ($article_array as $key => $article) : ?>
              <?php $count++ ?>
              <div class="tab-pane <?= (((isset($_GET['tab']) && $_GET['tab'] == $key) || (!isset($_GET['tab']) && $count == 1)) ? 'active' : '') ?>" id="<?= $key ?>" role="tabpanel" aria-labelledby="<?= $key ?>-tab">
                <ul class="ul_media">
                  <?php $req_res = get_article_by_type($key) ?>
                  <?php if (is_array($req_res) || is_object($req_res)) : ?>
                    <?php foreach ($req_res as $value) : ?>
                      <?php $artcl_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['article_publish_date']); ?>
                      

                      <li class="media row" style="border-bottom: 1px solid #d4af37; padding-bottom: 15px; padding-top: 17px;">
                        <div class="col-12 media-body">
                          <a href="blog-article?article_id=<?= (int) $value['article_id'] ?>&type=<?= $value['article_type'] ?>">
                            <img class="float-left img-thumbnail img-responsive" src="<?= article_img($value['article_type'], $value['article_image'], 1) ?>" alt="<?= $value['article_image'] ?>" style="width: 129px;">
                          </a>
                          <div class="float-right/" style="padding-left: 150px">
                            <h4 class="mt-0 mb-1">
                              <a href="blog-article?article_id=<?= (int) $value['article_id'] ?>&type=<?= $value['article_type'] ?>" class="text-warning">
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

                            <div class="col-12/" style="max-height: 60px; padding-top: 5px; overflow: hidden">
                              <div><?= nl2br($value['article_content']) ?> <?= (($value['article_content_count'] > 355) ? '...' : '') ?> </div>
                            </div>
                          </div>

                        </div>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </div> <!-- end of tab-content-->

        </div>
      </div>
      <br><br>
    </div>
  </div>
  <br><br>
</div>