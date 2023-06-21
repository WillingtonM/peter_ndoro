<div class="col-12 col-sm-6 col-md-4 article_container my-1 p-1">
    <div class="shadow gallery_contents artclt_bg2 p-2 border-radius-xl/" style="border-radius: 25px;" >
        <?php if (isset($_SESSION['admin_id'])) : ?>
            <div class="w-100 pt-3 border-top border-light">
                <p class="m-0 p-0">
                    <a type="button" class="font-weight-bolder text-dark me-2" onclick="requestModal(post_modal[4], 'galleryModal', {'media_id':<?= $value['media_id'] ?>})">
                        <?= $value['media_title'] ?>
                    </a>
                </p>
                <p class="m-0 p-0"> <small class="text-dark text-xxs"><?= $myDateTime->format('F jS, Y') ?></small> </p>
                <p class="font-weight-bold text-dark text-sm"><?= $value['media_content'] ?></p>

            </div>
            <div class="w-100">
                <a type="button" class="" onclick="requestModal(post_modal[4], 'galleryModal', {'media_id':<?= $value['media_id'] ?>})">
                    <?= global_imgs($img_dir, 'col-12', 1, 'image', $value['media_image'], $value['media_id']) ?>
                </a>
            </div>
        <?php else : ?>
            <div class="w-100 pt-1 border-top border-light">

                <p class="m-0 p-0 hide_text_on_length">
                    <a href="gallery?p=<?= $value['media_image'] ?>&uid=<?= $value['media_id'] ?>" class="font-weight-bolder text-dark w-100 p-0 px-2 m-0">
                        <span class="font-weight-bolder text-dark hide_text_on_length/ p-0"> <?= $value['media_title'] ?> </span>
                    </a>
                </p>
                <small class="text-dark text-xxs p-0 px-2"><?= $myDateTime->format('jS M Y') ?></small>
            </div>
            <div class="w-100">
                <a href="gallery?p=<?= $value['media_image'] ?>&uid=<?= $value['media_id'] ?>">
                    <?= global_imgs($img_dir, 'col-12', 1, 'image', $value['media_image'], $value['media_id']) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>