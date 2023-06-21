<?php $b_form_usr = ((isset($page) && $page == 'bookings') ? 'booking_form_user_pg' : 'booking_form_user') ?>
<?php $b_form_pne = ((isset($page) && $page == 'bookings') ? 'tab_pane_pg' : 'tab_pane') ?>
<?php $b_form_msg = ((isset($page) && $page == 'bookings') ? 'booking_form_message_pg' : 'booking_form_message') ?>
<?php $bookng_msg = ((isset($page) && $page == 'bookings') ? 'message_booking_pg' : 'message_booking') ?>

<div class="card-body p-3">

    <?php
    $hour           = date('H');
    $minute         = (date('i') > 30) ? '60' : '30';
    $time_round     = "$hour:$minute";

    $date_norm      = date("Y-m-d");

    $min_date       = date(DATE_FORMAT, strtotime($date_norm . ' + 9 hours'));
    $max_date       = date(DATE_FORMAT, strtotime($date_norm . ' + 16 hours'));

    $current_date   = date("Y-m-d H");
    // $current_date   = date(DATE_FORMAT, strtotime($current_date . ' + ' . $minute . ' minute'));
    $current_date   = date(DATE_FORMAT, strtotime($date_norm . ' ' . $time_round));
    $date_check     = ($min_date <= $current_date && $current_date <= $max_date) ? false : true;

    ?>

    <form id="<?= $b_form_usr ?>" class="form-row align-items-center">

        <!-- <div class="col">
            <p class="fs-5">
                Unfortunately, you may not be able to make an online booking at this time, please send us your event booking details using this email 
                <a href="mailto:bookings@<?= $_ENV['PROJECT_HOST'] ?>" class="text-warning font-weight-bold">bookings@<?= $_ENV['PROJECT_HOST'] ?></a>
            </p>
            <p class="fs-5">
                Include the following on your booking request:

                <ul class="list-group list-group-flush border-radius-xl">
                    <li class="list-group-item">Your full name</li>
                    <li class="list-group-item">Company name</li>
                    <li class="list-group-item">Contact details</li>
                    <li class="list-group-item">Event booking type (i.e., Moderator, MC or Podcast)</li>
                    <li class="list-group-item">Event description</li>
                    <li class="list-group-item">Event date(s)</li>
                    <li class="list-group-item">And any other related information </li>
                </ul>
            </p>
        </div> -->


        <input type="hidden" name="form_type" value="booking_form">
        <input type="hidden" name="event" value="<?= ((isset($event['event_id'])) ? $event['event_id'] : '') ?>">

        <div class="col-12">
            <div class="input-group mb-2">
                <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                <input type="text" class="form-control shadow-none" name="name" value="<?= (isset($event['event_user_name'])) ? $event['event_user_name'] : '' ?>" placeholder="Name" required>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group mb-2">
                <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                <input type="text" class="form-control shadow-none" name="last_name" value="<?= (isset($event['event_last_name'])) ? $event['event_last_name'] : '' ?>" placeholder="Last Name" required>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group mb-2">
                <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-envelope input_color"></i></span>
                <input type="email" class="form-control shadow-none" name="booking_email" value="<?= (isset($event['event_user_email'])) ? $event['event_user_email'] : '' ?>" placeholder="Email" required>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group mb-2">
                <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-phone input_color"></i></span>
                <input type="tel" class="form-control shadow-none" name="booking_phone" value="<?= (isset($event['event_user_phone'])) ? $event['event_user_phone'] : '' ?>" placeholder="Contact number">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group mb-2">
                <span class="input-group-text text-warning" style="border-right: none;"><i class="fa fa-building input_color"></i></span>
                <input type="text" class="form-control shadow-none" name="event_company_name" value="<?= (isset($event['event_company_name'])) ? $event['event_company_name'] : '' ?>" placeholder="Company name">
            </div>
        </div>
    </form>

    <hr class="horizontal dark mt-0">

    <h6 class="px-3 font-weight-bolder <?= (isset($modal_id)) ? 'text-light' : 'text-light' ?>"> Choose Service </h6>

    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-pills <?= (isset($modal_id)) ? 'nav-modal' : '' ?> nav-justified" id="pills-tab" role="tablist">
                <?php $tabbs_count = 0 ?>
                <?php foreach ($booking_navba as $key => $nav) : ?>
                    <?php $tabbs_count++ ?>
                    <?php if (isset($_SESSION['user_id']) && isset($event_type) && $key != $event_type) continue ?>

                    <li class="shadow nav-item font-weight-bold article_nav m-1 <?= (((isset($event_type) && $event_type == $key) || (!isset($event_type) && $tabbs_count == 1)) ? 'article_active' : '') ?>">
                        <a get-variable="tab" data-name="<?= $key ?>" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'active' : '') ?>" id="pills-<?= $key ?>-tab" data-bs-toggle="pill" href="#pills-<?= $key ?>" role="tab" aria-controls="pills-<?= $key ?>" aria-selected="<?= (((isset($_GET['tab']) && $_GET['tab'] == $key)  || empty($_GET['tab'])) ? 'true' : 'false') ?>">
                            <span class="border-weight-bolder"> <i class="<?= $nav['imgs'] ?>"> &nbsp; </i> <?= $nav['short'] ?> </span>
                            <hr class="horizontal dark mt-1 mb-0">
                            <h6 class="text-center sm_text text-xs font-weight-bold mb-0 h6_text"><?= $nav['long'] ?></h6>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="notif_tab">
                <?php $array_count = 0; ?>
                <?php foreach ($booking_navba as $key => $tabs) : ?>
                    <?php $array_count++; ?>
                    <?php if (isset($_SESSION['user_id']) && isset($event_type) && $key != $event_type) continue ?>

                    <form class="<?= $b_form_pne ?> tab-pane fade <?= (((isset($event_type) && $event_type == $key) || (!isset($event_type) && $array_count == 1)) ? 'show active' : '') ?>" id="pills-<?= $key ?>" role="tabpanel" aria-labelledby="pills-<?= $key ?>-tab">

                        <div class="row notif_content">
                            <div class="col-12 shadow bg-white border-radius-xl p-3">
                                <?php require_once $config['PARSERS_PATH'] . 'bookings' . DS . $key . '.php' ?>
                            </div>
                        </div>

                    </form>

                <?php endforeach; ?>

            </div>

        </div>
    </div>

    <form id="<?= $b_form_msg ?>" class="form-group mt-3">
        <div class="input-group mb-3">
            <span class="input-group-text text-warning" style="border-right: none;"><i class="far fa-comment-dots input_color"></i></span>
            <textarea class="form-control shadow-none" id="booking_message" name="booking_message" placeholder="Message ..." rows="4" required><?= ((isset($event['event_message'])) ? $event['event_message'] : '') ?></textarea>
        </div>
        <?php if (isset($_SESSION['user_id']) && isset($event)) : ?>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" name="booking_complete" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= ($event['event_processed'] == 1) ? 'checked' : '' ?> <label class="form-check-label" for="flexSwitchCheckChecked">Mark as Complete</label>
            </div>
        <?php endif; ?>
    </form>

    <div id="<?= $bookng_msg ?>" class="mt-3"></div>
    <button type="button" class="btn btn-light col-12 font-weight-bolder fs-6" style="border-radius: 12px; font-weight: bolder" onclick="postCheck('<?= $bookng_msg ?>', $('#<?= $b_form_usr ?>').serialize() + '&' + $('#<?= $b_form_msg ?>').serialize() + '&' + $('.<?= $b_form_pne ?>.tab-pane.active').serialize(), 0, true);"> <?= (isset($_SESSION['user_id']) ? 'Submit Booking Changes' : 'Submit Online Booking') ?> </button>
    <br>

    <div class="col-12 text-center">
        <small style="color: #999; font-size: .8rem;">
            Please note that any collected identifying information will be encrypted and stored in a password protected electronic format, thus you can rest assured that your identifying information will be securely stored
        </small>
    </div>
    <br>

</div>