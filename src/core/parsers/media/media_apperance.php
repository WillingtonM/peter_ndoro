<?php if (isset($_SESSION['user_id'])) : ?>
    <div id="media_error_<?= $value['media_id'] ?>" class=""></div>
    <div class="row">
        <h5 class="col-12 font-weight-bolder p-0 px-4 pt-2">
            <a type="button" class="text-warning" onclick="requestModal(post_modal[16], 'mediaModal', {'media_id':<?= (int) $value['media_id'] ?>})">
                <?= $value['media_title'] ?>
            </a>
        </h5>
        <div class="col-12 py-0 px-4">
            <span class="fs-8">Published on: &nbsp; <small class="alt_dflt" style="padding-bottom: 5px; "><?= $media_date->format('F jS, Y') ?></small></span>
            <?php if (!empty($value['media_url'])) : ?>
                <span class=""> <small> Source: &nbsp; <b><?= $value['media_url'] ?></b> </small> </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="row card py-3 px-1 mx-0">
        <div class="col-12 py-2 px-1" style="border-radius: 25px">
            <div class="col-12" style="padding-top: 56.25%; height:fit-content">
                <?= $value['media_content'] ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row card bg-none shadow py-3 px-1 mx-0" style="background: none !important; background-color: none !important; border-radius: 25px;">
        <div class="col-12 py-2 px-3">
            <div class="col-12 px-3" style="padding-top: 56.25%; height:fit-content;">
                <?= $value['media_content'] ?>
            </div>
        </div>
    </div>
<?php endif; ?>