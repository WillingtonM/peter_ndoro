<div class="container-fluid" style="min-height: 86vh; background-image: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);">
    <div class="container">
        <br><br>

        <?php if ($member != null && $user_type != 'client') : ?>
            <div class="row">
                <div id="home-first" class="col-12">
                    <br><br>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="text-secondary" style="font-weight: normal;">
                                <span> Estate information for <b class="alt_dflt"><?= $member['member_surname_initials'] ?></b> </span>
                            </h1>

                            <!-- <span class="text-secondary" style="font-size: 2.5em; font-family: Italianno;"> &emsp; The home for marvelous properties &emsp; </span> -->
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

            <div class="alert alert-secondary col-12 text-center/" style="border-radius: 35px;">

                <div class="row" style="padding: 25px;"></div>
                <div class="col-row">
                    <div class="col-12 bg-white" style="padding: 0; border: 1px solid #aaa; border-radius: 15px; padding: 9px 15px;">

                        <table class="table table-sm table-borderless/ table-light">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary">
                                <tr>
                                    <th scope="row" class="col/ table-fit/" style="white-space: nowrap; width: 1%;">Name & Initials</th>
                                    <td class="col"> &nbsp; | &nbsp; <?= $member['member_surname_initials'] ?> </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col/ table-fit/" style="white-space: nowrap; width: 1%;">Office</th>
                                    <td class="col"> &nbsp; | &nbsp; <?= $office_info[$member['member_location']]['short'] ?> </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col/ table-fit/" style="white-space: nowrap; width: 1%;"> Reference Number </th>
                                    <td class="col"> &nbsp; | &nbsp; <?= $member['member_reference'] ?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="col-row">
                    <div class="col-12" style="padding: 0; border: 1px solid #aaa; border-radius: 15px; padding-top: 9px">

                        <table class="table table-striped table-light">
                            <thead>
                                <tr class="">
                                    <th scope="col">Task</th>
                                    <th scope="col">Date of Completion</th>
                                    <!-- <th scope="col">Current Status</th>
                                    <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody class="text-secondary">
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['consultation_date'] ?> </th>
                                    <td><?= ((!empty($member['consultation_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['consultation_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['executorship_letter_date'] ?> </th>
                                    <td><?= ((!empty($member['executorship_letter_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['executorship_letter_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['section_29_date'] ?> </th>
                                    <td><?= ((!empty($member['section_29_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['section_29_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['section_28_date'] ?> </th>
                                    <td><?= ((!empty($member['section_28_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['section_28_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['claims_lodged_date'] ?> </th>
                                    <td><?= ((!empty($member['claims_lodged_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['claims_lodged_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['ld_lodged_date'] ?> </th>
                                    <td><?= ((!empty($member['ld_lodged_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['ld_lodged_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['advertise_permission_date'] ?> </th>
                                    <td><?= ((!empty($member['advertise_permission_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['advertise_permission_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['section_35_date'] ?> </th>
                                    <td><?= ((!empty($member['section_35_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['section_35_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['conveyancers_file_refer'] ?> </th>
                                    <td><?= ((!empty($member['conveyancers_file_refer'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['conveyancers_file_refer'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['masters_fee_date'] ?> </th>
                                    <td><?= ((!empty($member['masters_fee_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['masters_fee_date'])) : 'NA') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"> <?= $deceased_estates['filing_notice_date'] ?> </th>
                                    <td><?= ((!empty($member['filing_notice_date'])) ? date(PRIMARY_DATE_FORMAT, strtotime($member['filing_notice_date'])) : 'NA') ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <br>
                    <hr>

                    <h6 class="text-info/ bg-secondary" style="color: #ddd; border-radius: 5px; padding: 5px;"> <i>Assigned applicants | Executors</i> </h6>
                    <?php if (is_array($clients) || is_object($clients)) : ?>
                        <table class="table table-striped table-sm">
                            <tbody>
                                <?php foreach ($clients as $key => $client) : ?>
                                    <tr id="memb_row_<?= $key ?>">
                                        <th scope="row">
                                            <span class="btn"> <?= ((!empty($client['name'])) ? $client['name'] . ' | ' : '') ?> <i> <?= $client['username'] ?> </i> </span>
                                        </th>
                                        <td>
                                            <div class="float-right">
                                                <!-- <a type="button" class="btn btn-danger/ float-right text-secondary" onclick="postCheck('memb_row_<?= $key ?>', {'user':<?= $client['user_id'] ?>, 'member':<?= $user_id ?>, 'form_type':'remove_member' } )"> <i class="fas fa-trash text-danger"></i> &nbsp; unlink </a> -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h6 class="text-danger"> There is no data to display </h6>
                    <?php endif; ?>
                </div>
                <br>
            </div>
            <br>
        <?php elseif ($member != null && $user_type == 'client') : ?>

        <?php endif; ?>

    </div>
</div>