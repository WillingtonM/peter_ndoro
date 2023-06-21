<div class="container pt-12 min-vh-100">

    <div class="row shadow border-radius-xl/ bg-white/ bookings-container" style="background-color: rgb(0, 0, 0, .5); padding-top: 25px; border-radius: 35px;">

        <div class="col-12 mt-4">
            <div class="text-center py-2">
                <h3 class="text-light font-weight-bolder"> Event Bookings </h3>
                <small class="m-0 text-light "> Complete the form below to make a booking </small>
            </div>
        </div>
        <div class="col-12 col-md-2"></div>
        <div class="col-12 col-md-8 p-3">
            <?php require_once $config['PARSERS_PATH'] . 'bookings' . DS . 'booking_form.php' ?>
        </div>
        <div class="col-12 col-md-2"></div>
    </div>

</div>