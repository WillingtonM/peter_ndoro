    <!-- Modal -->
    <?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

    <div class="row">
        <div id="userformErrors" class="col-md-12"></div>
        <div class="col-12" id="form_member">
            <form id="userForm" class="form-horizontal" action="" method="POST">
                <div class="form-row align-items-center">
                    <div class="col-12">

                        <h5 class="modal-title"><?= (($usr_arr != null) ? '<i class="fa fa-users-cog"></i> &nbsp; deceased estate | <i class="text-danger">' . $usr_arr['member_surname_initials'] . '</i>' : '<i class="fa fa-user-plus"></i> &nbsp; Add deceased estate') ?></h5>


                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-warning"> <i class="fas fa-map-marker-alt input_color"></i> <small style="padding-left: 15px;"> <sup style="color: white;">*</sup> </small> </div>
                            </div>
                            <select id="location" name="location" value="" class="form-control shadow-none" <?= ((!$is_admin) ? 'disabled' : '') ?>>
                                <option value="">Select Region</option>
                                <?php foreach ($office_info as $key => $region) : ?>
                                    <?php if (($usr_arr != null && $usr_arr['member_location'] == $key) || $key == 'headoffice') : ?>
                                        <option value="<?= $key ?>" selected> <?= ucfirst($office_info[$key]['short']) ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $key ?>"><?= ucfirst($office_info[$key]['short']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> <small style="padding-left: 15px;"> <sup style="color: white;">*</sup> </small> </div>
                            </div>
                            <input id="name" type="text" name="name" value="<?= (($usr_arr != null) ? $usr_arr['member_name'] : '') ?>" class="form-control shadow-none" placeholder="Name" <?= ((!$is_admin) ? 'disabled' : '') ?>>
                            <!-- <small style="padding-left: 15px;">Name </small> -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> <small style="padding-left: 15px;"> <sup style="color: white;">*</sup> </small> </div>
                            </div>
                            <input id="surname" type="text" name="surname" value="<?= (($usr_arr != null) ? $usr_arr['member_surname'] : '') ?>" class="form-control shadow-none" placeholder="Surname" <?= ((!$is_admin) ? 'disabled' : '') ?>>
                            <!-- <small style="padding-left: 15px;">Surname</small> -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> <small style="padding-left: 15px;"> <sup style="color: red;">*</sup> </small> </div>
                            </div>
                            <input id="surname_initials" type="text" name="surname_initials" value="<?= (($usr_arr != null) ? $usr_arr['member_surname_initials'] : '') ?>" class="form-control shadow-none" placeholder="Surname Initials" <?= ((!$is_admin) ? 'disabled' : '') ?>>
                            <!-- <small style="padding-left: 15px;">Surname Initials <sup style="color: red;">*</sup> </small> -->
                        </div>
                    </div>
                    <br>

                    <div class="col-12">
                        <hr>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-warning"> <i class="fas fa-history input_color"></i> <small style="padding-left: 15px;"> <sup style="color: red;">*</sup> </small> </div>
                            </div>
                            <input id="reference" type="number" name="reference" value="<?= (($usr_arr != null) ? $usr_arr['member_reference'] : '') ?>" class="form-control shadow-none" placeholder="Reference Number" <?= ((!$is_admin) ? 'disabled' : '') ?>>
                        </div>
                    </div>

                </div>
                <?php if ($usr_arr != null) : ?>
                    <input type="hidden" name="post_user" value="<?= $user_id ?>">
                <?php endif; ?>
                <input type="hidden" name="form_type" value="member_add">

                <div id="member_err" class="col-12" style="padding: 9px 0px;"></div>

                <button class="btn btn-secondary btn-sm col-12" type="button" style="border-radius: 12px; font-weight: bolder;" onclick="postCheck('member_err', $('#userForm').serialize(), true);" <?= ((!$is_admin) ? 'disabled' : '') ?>> <?= (($usr_arr != null) ? 'Edit' : 'Add') ?> deceased estate </button>

            </form>

            <?php if ($usr_arr != null) : ?>
                <hr>
                <div id="member_table" class="row">
                    <form id="dataForm" class="col-12 form-horizontal" action="" method="POST">
                        <table id="member_table" class="col-12/ table table-striped">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col"> Date Updated </th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody class="member_body">

                                <?php $processed    = true ?>
                                <?php $trgtprcsd    = true ?>
                                <?php $new_procsd   = true ?>
                                <?php $cnt          = 0 ?>
                                <?php foreach ($deceased_estates as $key => $val) : ?>
                                    <?php $cnt++ ?>
                                    <tr id="member_row<?= $cnt ?>">
                                        <th scope="row">
                                            <div class="col-12">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-warning"> <i class="fa fa-calendar input_color"></i> </div>
                                                    </div>
                                                    <!-- <input type="date" id="<?= $key ?>" name="<?= $key ?>" value="<?= (($processed && !empty($usr_arr[$key])) ? date('Y-m-d', strtotime($usr_arr[$key])) : '') ?>" class="form-control form-sm shadow-none" placeholder="Date" <?= (($processed && !empty($usr_arr[$key])) ? '' : ((!$processed) ? 'disabled' : '')) ?>> -->
                                                    <!-- <input type="date" id="<?= $key ?>" name="<?= $key ?>" value="<?= (($processed && !empty($usr_arr[$key])) ? date('Y-m-d', strtotime($usr_arr[$key])) : '') ?>" class="form-control form-sm shadow-none" placeholder="Date" <?= (($processed && !empty($usr_arr[$key])) ? '' : '') ?>> -->
                                                    <input type="date" id="<?= $key ?>" name="<?= $key ?>" value="<?= (($processed && !empty($usr_arr[$key])) ? date('Y-m-d', strtotime($usr_arr[$key])) : '') ?>" class="form-control form-sm shadow-none" placeholder="Date" <?= (($processed && !empty($usr_arr[$key])) ? '' : ((!$new_procsd) ? 'disabled' : '')) ?>>

                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <!-- <input type="checkbox" name="check<?= $key ?>" value="<?= $key ?>" class="custom-control-input" id="check<?= $key ?>" <?= (($processed && !empty($usr_arr[$key])) ? 'checked disabled' : ((!$processed) ? 'disabled' : '')) ?>> -->
                                                <!-- <input type="checkbox" name="check<?= $key ?>" value="<?= $key ?>" class="custom-control-input" id="check<?= $key ?>" <?= (($processed && !empty($usr_arr[$key])) ? 'checked disabled' : '') ?>> -->
                                                <input type="checkbox" name="check<?= $key ?>" value="<?= $key ?>" class="custom-control-input" id="check<?= $key ?>" <?= (($processed && !empty($usr_arr[$key])) ? 'checked disabled' : ((!$new_procsd) ? 'disabled' : '')) ?>>
                                                <label class="custom-control-label" for="check<?= $key ?>"> <?= $val ?> </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $new_procsd = (empty($last_key) && $mbr_proc == 1) ? false : true ?>
                                    <?php $processed = (!$trgtprcsd || empty($last_key)) ? false : true ?>
                                    <?php $trgtprcsd = ($key == $last_key || $processed == false || empty($last_key)) ? false : true ?>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                        <input type="hidden" name="form_type" value="member_update">
                        <input type="hidden" name="member" value="<?= $user_id ?>">

                        <div id="data_err" class="col-12" style="padding: 9px 0px;"></div>
                        <button class="btn btn-secondary btn-sm col-12" type="button" style="border-radius: 12px; font-weight: bolder;" onclick="postCheck('data_err', $('#dataForm').serialize(), true);" <?= ((!$is_admin) ? '' : '') ?>> Update deceased estate date </button>
                        <div class="col-12" style="padding: 3px;"> </div>
                        <button class="btn btn-danger btn-sm col-12/ float-right" type="button" style="border-radius: 12px; font-weight: bolder;" onclick="postCheck('data_err', {'form_type':'remove_estate', 'user':'<?= $usr_arr['member_id'] ?>'});" <?= ((!$is_admin) ? '' : '') ?>> Remove deceased estate </button>

                    </form>
                </div>
            <?php endif; ?>




        </div>

    </div>
    <div class="col-12" id="error_pop"></div>

    <?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>