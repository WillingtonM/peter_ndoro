<div class="container">

    <div class="row">
        <div class="col-12 border-radius-xl p-0">
            <div class="card mb-4 p-3">
                <div class="card-header pb-0">
                    <h3 class="text-secondary"> <span> Testimonials </span> </h3>
                    <!-- <hr> -->
                    <a type="button" class="btn btn-dark border-radius-lg float-end" onclick="requestModal(post_modal[17], post_modal[17], {})"> Add Testimonial</a>
                </div>
                <div class="card-body p-3">
                    <?php if (is_array($testimonial_data) || is_object($testimonial_data)) : ?>
                        <?php $count                = 0 ?>
                        
                        <?php foreach ($testimonial_data as $feedback) : ?>
                            <?php $count++ ?>
                            <?php $feedback_date    = DateTime::createFromFormat('Y-m-d H:i:s', $feedback['testimonial_date_created']); ?>

                            <div class="d-flex border/ border-bottom mt-3">
                                <div class="flex-shrink-0">
                                    <img id="image_profile" width="90" class="image" style="border-radius: 15px; border: 1px solid #ddd; width/: 100%; height: 90px;" src="<?= img_path(ABS_USER_PROFILE, $feedback['testimonial_image'], 1) ?>" alt="<?= ((isset($req_res) && $req_res != NULL) ? $req_res['article_title'] : '') ?>">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="text-dark">
                                        <strong> <?= $feedback['testimonial_name'] . ' ' . $feedback['testimonial_last_name'] ?> </strong>
                                    </h5>
                                    <ul class="list-inline">
                                        <li class="list-inline-item me-3"><i class="fa fa-calendar-o"></i> <?= $feedback_date->format('Y-M-d') ?> </li>
                                        <li class="list-inline-item text-dark"><i class="fa-solid fa-pencil me-1"></i> <a type="button" class="font-weight-bolder text-dark" onclick="requestModal(post_modal[17], post_modal[17], {'testimonial_id':<?= $feedback['testimonial_id'] ?>})"> Edit </a> </li>
                                    </ul>
                                    <p> <?= $feedback['testimonial_message'] ?> </p>
                                </div>
                            </div>

                        <?php endforeach; ?>
                            
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>