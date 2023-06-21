<div class="container">
    <div class="row mb-3">
        <div class="col-12 mb-3/">
            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <?php $tabbs_count = 0 ?>
                <?php foreach ($admin_booking as $key => $nav) : ?>
                    <?php $tabbs_count++ ?>
                    <li class="shadow nav-item font-weight-bold article_nav m-1 <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'article_active' : '') ?>">
                        <a get-variable="tab" data-name="<?= $key ?>" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'active' : '') ?>" id="pills-<?= $key ?>-tab" data-bs-toggle="pill" href="#pills-<?= $key ?>" role="tab" aria-controls="pills-<?= $key ?>" aria-selected="<?= (((isset($_GET['tab']) && $_GET['tab'] == $key)  || empty($_GET['tab'])) ? 'true' : 'false') ?>">
                            <span class="border-weight-bolder"> <i class="<?= $nav['imgs'] ?>"> &nbsp; </i> <?= $nav['short'] ?> </span>
                            <hr class="horizontal dark mt-1 mb-0">
                            <h6 class="text-center sm_text text-xs font-weight-bold mb-0" style="color: #777;"><?= $nav['long'] ?></h6>
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
                <?php foreach ($admin_booking as $key => $tabs) : ?>
                    <?php $array_count++; ?>

                    <?php $bookings = ($key == 'processed') ? $processed_events : get_events_by_type($key) ?>

                    <div class="tab-pane fade <?= (((isset($_GET['tab']) && $_GET['tab'] == $key) || (!isset($_GET['tab']) && $array_count == 1)) ? 'show active' : '') ?>" id="pills-<?= $key ?>" role="tabpanel" aria-labelledby="pills-<?= $key ?>-tab">

                        <div class="row notif_content">

                            <div class="col-12 shadow bg-white border-radius-xl p-3">

                                <div class="card/ mb-4">
                                    <?php if ($key != 'processed') : ?>
                                        <div class="col-12 py-3 px-1">
                                            <a type="button" class="btn btn-sm/ btn-warning shadow-none article_nav article_active float-end/" onclick="requestModal(post_modal[9], post_modal[9], {'type':'<?= $key ?>'})"> <i class="fa-solid fa-calendar-check me-2"></i> <span> Add Event Booking </span> </a>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-12 py-3 px-1"></div>
                                    <?php endif; ?>

                                    <div class="col-12" id="user_messages"></div>

                                    <div class="card-body px-0 pt-0 pb-2 col-12">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr class="bg-light">
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">#</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name & Surname</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Event Date</th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php if (is_array($bookings) || is_object($bookings)) : ?>
                                                        <?php $count = 0 ?>

                                                        <?php foreach ($bookings as $value) : ?>
                                                            <?php $count++ ?>

                                                            <tr>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs font-weight-bold"> <?= $count ?> </span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-secondary text-sm font-weight-bold"><?= $value['event_user_name'] . ' ' . $value['event_last_name'] ?></span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"> <span class="text-primary font-weight-bolder"> <?= $value['event_company_name'] ?> </span> </p>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y, @ H:i', strtotime($value['event_host_date'])) ?></span>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <a type="buttton" class="cursor-pointer" onclick="requestModal(post_modal[9], post_modal[9], {'event_id': <?= ((isset($value['event_id'])) ? $value['event_id'] : '') ?>})"> <i class="fas fa-edit text-dark me-2"></i> Edit </a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- <div class="col-12 mb-3 px-4">
                                            <?php if (isset($_GET['booking']) && $_GET['booking'] == 'all') : ?>
                                                <a class="text-warning" href="?booking=min">View Minimal</a>
                                            <?php else : ?>
                                                <a class="text-warning" href="?booking=all">View All</a>
                                            <?php endif; ?>
                                        </div> -->

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>