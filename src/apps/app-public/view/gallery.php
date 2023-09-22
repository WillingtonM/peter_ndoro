<div class="container pt-10 min-vh-100" style="min-height: 84vh;">
    <div style="padding: 30px;"></div>

    <div class="row">

        <?php if ($data['error']) : ?>
            <div class="col-12 shadow bg-white border-radius-xl text-center p-3">

                <p class="text-danger"> <?= $data['message'] ?> </p>

                <br>
                <p>
                    <a href="media?tab=?gallery" class="btn btn-secondary border-radius-lg"> Go back to Gallery </a>
                </p>

            </div>
        <?php else : ?>
            <div class="col-12 px-3 pt-3 bg-white shadow p-3" style="border-radius: 25px">
                <div class="col-12 pt-3">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <p class="m-0 p-0">
                            <a type="button" class="font-weight-bolder text-dark me-2" onclick="requestModal(post_modal[4], 'galleryModal', {'media_id':<?= $value['media_id'] ?>})">
                                <?= $value['media_title'] ?>
                            </a>
                        </p>
                        <p class="m-0 p-0"> <small class="text-dark text-xxs"><?= $myDateTime->format('F jS, Y') ?></small> </p>
                        <p class="font-weight-bold text-dark text-sm"><?= $value['media_content'] ?></p>
                    <?php else : ?>
                        <p class="m-0 p-0">
                            <span class="font-weight-bolder text-dark me-2 fs-5"> <?= $value['media_title'] ?> </span> <small class="text-dark text-xxs"><?= $myDateTime->format('F jS, Y') ?></small>
                        </p>
                        <p class="font-weight-bold text-dark text-sm"><?= $value['media_content'] ?></p>
                    <?php endif; ?>

                </div>
                <div class="col-12 mb-4">
                    <div class="row">
                        <?= global_imgs($img_dir, 'col-md-3', 12, 'square', $value['media_image'], $value['media_id']) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>

</div>