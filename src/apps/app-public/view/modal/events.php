<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

<div class="row">
    <!-- <div class="col text-center">
        <img class="img text-center" src="<?= PROJECT_LOGO ?>" alt="<?= PROJECT_TITLE ?> Logo" width="150px" height="150px">
    </div>
    <br> -->
    <div class="col-12">
        <div class="text-center py-2">
            <h3 class="text-light" style="font-weight: bolder;"> Event Bookings </h3>
            <small class="m-0 alt2_color"> Complete the form below to make a booking </small>
        </div>
    </div>
    <br>
    <div class="col-12 p-3 shadow border-radius-xl bg-white/">
        <?php require_once $config['PARSERS_PATH'] . 'bookings' . DS . 'booking_form.php' ?>
    </div>
</div>

<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>


<script>
    $('.nav-modal').on('click', function() {
        change_bg()
    });
</script>