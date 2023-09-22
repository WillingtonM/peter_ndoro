<input type="hidden" name="booking_type" value="<?= $key ?>">

<div class="row form-row align-items-center">
    <div class="col-12 col-lg-6/ mb-3">
        <label for="event_description" class="form-label px-2 font-weight-bolder"> Description</label>
        <div class="input-group mb-2">
            <span class="input-group-text text-dark bg-light" style="border-right: none;"><i class="fa-regular fa-clipboard input_color"></i></span>
            <textarea class="form-control shadow-none bg-light" id="event_description" name="event_description" placeholder="Description ..." rows="2" required> <?= ((isset($event['event_description'])) ? $event['event_description'] : '') ?></textarea>
        </div>
    </div>

</div>

<div class="form-group">

    <label for="date_of_birth" class="form-label px-2 font-weight-bolder"> Date & Time</label>

    <div class="row g-3 align-items-center">

        <div class="col-auto">
            <?php $date_days = range(1, 31, 1) ?>
            &nbsp; <span class="me-2">Day</span>
            <?php $d_date = ($date_check) ? date('d', strtotime($current_date . ' + 24 hours')) : date('d') ?>
            <?php $event_day =  (isset($event)) ? date('d', strtotime($event['event_host_date'])) : '' ?>
            <select class="form-control shadow-none bg-light" name="dob">
                <?php foreach ($date_days as $value) : ?>
                    <option value="<?= $value ?>" <?= ((isset($event) && $event_day == $value) ? 'selected' : (($value == $d_date) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-sm">
            &nbsp; <span class="me-2">Month</span>
            <?php $event_m =  (isset($event)) ? date('F', strtotime($event['event_host_date'])) : '' ?>
            <select class="form-control shadow-none bg-light" name="mob">
                <?php $m_date = ($date_check) ? date('F', strtotime($current_date . ' + 24 hours')) : date('F') ?>
                <?php foreach ($date_months as $key => $month) : ?>
                    <option value="<?= $key ?>" <?= ((isset($event) && $event_m == $month) ? 'selected' : (($month == $m_date) ? 'selected' : '')) ?>><?= $month ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-sm">
            <?php $event_y =  (isset($event)) ? date('Y', strtotime($event['event_host_date'])) : '' ?>
            <?php $y_date = date("Y") ?>
            <?php $date_days = range($y_date, date("Y", strtotime($y_date . '+ 3 years')), +1) ?>
            <?php $oy_date = ($date_check) ? date('Y', strtotime($current_date . ' + 24 hours')) : date('Y') ?>
            &nbsp; <span class="me-2">Year</span>
            <select class="form-control shadow-none bg-light" name="yob">
                <?php foreach ($date_days as $value) : ?>
                    <option value="<?= $value ?>" <?= ((isset($event) && $event_y == $value) ? 'selected' : (($value == $oy_date) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-sm">
            &nbsp; <span class="me-2">Time</span>
            <?php $event_t      = (isset($event)) ? date('G:i A', strtotime($event['event_host_date'])) : '' ?>
            <?php $t_date       = ($date_check) ? date('H:i', strtotime($current_date . ' + 24 hours')) : date('H:i') ?>
            <?php $current_time = date('H:i', strtotime($current_date)); ?>
            <?php $current_time = date('G:i A', strtotime($current_time)); ?>
            <?php $date_days    = create_time_range("00:00", "23:00", "30 mins", "24") ?>
            <select class="form-control shadow-none bg-light" name="tod">
                <?php foreach ($date_days as $value) : ?>
                    <option value="<?= $value ?>" <?= ((isset($event) && $event_t == $value) ? 'selected' : (((isset($service['service_departure_time']) && $service['service_departure_time'] == $value) || ($value == $current_time)) ? 'selected' : '')) ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-12 mb-3">
        <label for="booking_user_count" class="form-label px-2 font-weight-bolder"> Expected number of attendees </label>
        <div class="input-group mb-2">
            <span class="input-group-text bg-light text-dark" style="border-right: none;"> <i class="fas fa-users input_color"></i> </span>
            <input type="number" class="form-control shadow-none bg-light" name="booking_user_count" placeholder="Expected number of attendees" min="0" value="<?= ((isset($event['event_user_count'])) ? $event['event_user_count'] : '') ?>" required>
        </div>
    </div>

</div>