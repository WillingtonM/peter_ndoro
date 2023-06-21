<div class="col mb-3">
    <h6 class="text-secondary font-weight-bolder"> <span> Basic information </span> </h6>
</div>

<!-- Merchant Legal Name -->
<div class="col-auto mb-3">
    <div id="username_notif" class="control-label/"></div>
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-store"></i> </span>
        <input type="text" name="legal_name" class="form-control shadow-none" id="legal_name" placeholder="Merchant Legal Name" value="<?= ((isset($business)) ? $business['business_legal_name'] : '') ?>">
    </div>
    <small id="" class="form-text/ text-muted">
        Company legal/registration name <span class="me-2"></span> <i>e.g Company XYZ (Pty) Ltd</i>
    </small>
</div>

<!-- Business Trading Name -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-store"></i> </span>
        <input type="text" name="business_name" class="form-control shadow-none" id="business_name" placeholder="Business Name" value="<?= ((isset($business)) ? $business['business_name'] : '') ?>">
    </div>
    <small id="" class="form-text/ text-muted">
        Business trading name <span class="me-2"></span> <i>eg. Company XYZ</i>
    </small>
</div>

<!-- Business username -->
<div class="col-auto mb-3">
    <!-- <label class="sr-only/" for="business_username">Business username</label> -->
    <div class="input-group mb-0">
        <span class="input-group-text"> @ </span>
        <input type="text" class="form-control shadow-none" id="business_username" name="business_username" autocomplete="username" placeholder="Business username" value="<?= ((isset($business)) ? $business['business_username'] : '') ?>">
    </div>
    <small id="" class="form-text text-muted">
        Unique business username must be 6-18 characters long & no spaces between characters
    </small>
</div>

<!-- Enterprise Type -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-store"></i> </span>
        <input id="business_type_id" name="business_type" list="business_type" class="form-control shadow-none col-12" placeholder="Enterprise Type" value="<?= ((isset($business)) ? $business_types[$business['business_type']] : '') ?>">
    </div>
    <datalist id="business_type">
        <?php foreach ($business_types as $key => $value) : ?>
            <option data-value="<?= $key ?>"><?= $value ?></option>
        <?php endforeach; ?>
    </datalist>

    <small id="" class="form-text text-muted">
        Select business type
    </small>
</div>

<!-- Company Registration Number -->
<div class="col-auto mb-3">
    <!-- <label class="sr-only/" for="registration_number"> Company Registration Number </label> -->
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-building"></i> </span>
        <input type="text" class="form-control shadow-none" id="registration_number" name="registration_number" autocomplete="website" placeholder="Company Registration Number" value="<?= ((isset($business)) ? $business['business_registration_number'] : '') ?>">
    </div>
    <small id="" class="form-text text-muted">
        Business registration number
    </small>
</div>

<div class="col-auto mb-3">
    <div class="row g-3 mb-0">
        <div class="col-4 col-md-2">
            <div class="input-group">
                <span class="input-group-text"> <i class="fas fa-calendar-day"></i> </span>
                <?php $date_days = range(1, 31, 1) ?>
                <select class="form-control shadow-none" name="establishment_day">
                    <?php foreach ($date_days as $value) : ?>
                        <option value="<?= $value ?>" <?= ((isset($business['business_date_established']) && (int) date('d', strtotime($business['business_date_established'])) == $value) ? 'selected' : ((!isset($business['business_date_established']) && empty($business['business_date_established']) && $value == (int)date('d')) ? 'selected' : '')) ?>> <?= $value ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-4 col-md-2">
            <select class="form-control shadow-none" name="establishment_month">
                <?php foreach ($date_months as $key => $month) : ?>
                    <option value="<?= $key ?>" <?= ((isset($business['business_date_established']) && (int) date('m', strtotime($business['business_date_established'])) == $key) ? 'selected' : ((!isset($business['business_date_established']) && empty($business['business_date_established']) && $key == (int)date("m")) ? 'selected' : '')) ?>> <?= $month ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-4 col-md-2">
            <?php $date_days = range(date("Y"), 1900, -1) ?>
            <select class="form-control shadow-none" name="establishment_year">
                <?php foreach ($date_days as $value) : ?>
                    <option value="<?= $value ?>" <?= ((isset($business['business_date_established']) && (int) date('Y', strtotime($business['business_date_established'])) == $value) ? 'selected' : ((!isset($business['business_date_established']) && empty($business['business_date_established']) && $value == date("Y")) ? 'selected' : '')) ?>> <?= $value ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
    <small id="" class="form-text text-muted">
        Business Establishment date
    </small>
</div>

<div class="col mb-3">
    <h6 class="text-secondary"> <span class="font-weight-bolder"> Contact information </span> </h6>
</div>

<!-- Business Country -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="far fa-flag"></i> </span>
        <input id="mcht_country" name="business_country" list="business_country" class="form-control shadow-none col-12" placeholder="Business Country" value="<?= ((isset($business)) ? $countries_array[$business['business_country']] : '') ?>">
    </div>
    <datalist id="business_country">
        <?php foreach ($countries_array as $key =>  $country) : ?>
            <option data-value="<?= $key ?>"><?= $country ?></option>
        <?php endforeach; ?>
    </datalist>
    <small id="" class="form-text text-muted">
        Select country of business operation
    </small>
</div>

<!-- Business Email -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-envelope-open-text"></i> </span>
        <input type="email" class="form-control shadow-none" id="business_email" name="business_email" autocomplete="email" pattern="" placeholder="Business Email" value="<?= ((isset($business)) ? $business['business_email'] : '') ?>">
    </div>
    <small id="" class="form-text text-muted">
        Business email
    </small>
</div>
<!-- Business Phone -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-phone-volume"></i> </span>
        <input type="tel" class="form-control shadow-none" id="business_phone" name="business_phone" autocomplete="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="Business Phone" value="<?= ((isset($business)) ? $business['business_contact'] : '') ?>">
    </div>
    <small id="" class="form-text text-muted">
        Business phone number
    </small>
</div>
<!-- Business Website -->
<div class="col-auto mb-3">
    <div class="input-group mb-0">
        <span class="input-group-text"> <i class="fas fa-globe"></i> </span>
        <input type="url" class="form-control shadow-none" id="business_website" name="business_website" autocomplete="url" placeholder="Business Website" value="<?= ((isset($business)) ? $business['business_website'] : '') ?>">
    </div>
    <small id="" class="form-text text-muted">
        Business website if any <i>(optional)</i>
    </small>
</div>