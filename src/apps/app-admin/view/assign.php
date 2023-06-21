<div class="container">
    <br><br>

    <div class="row">

        <div class="col-12">
            <ul class="nav nav-tabs nav-justified" id="myTab" style="border: none;">
                <li style="margin: 5px;" class="nav-item article_nav <?= (((isset($_GET['tab']) && $_GET['tab'] ==  'client') || (!isset($_GET['tab']))) ? 'article_active' : '') ?>" onclick="change_bg(parseInt(0));">
                    <a onclick="changeURL('client')" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  'client') || (!isset($_GET['tab']))) ? 'active' : '') ?>" id="client-tab" data-toggle="tab" href="#client" role="tab" aria-controls="client" aria-selected="true">
                        <span style="font-weight: bolder;"> <i class="fas fa-user-friends"></i> &nbsp; Client Assignment </span>
                        <!-- <h6 class="text-center sm_text" style="color: #777;"> </h6> -->
                    </a>
                </li>

                <li style="margin: 5px;" class="nav-item article_nav <?= (((isset($_GET['tab']) && $_GET['tab'] ==  'member')) ? 'article_active' : '') ?>" onclick="change_bg(parseInt(1));">
                    <a onclick="changeURL('member')" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  'member')) ? 'active' : '') ?>" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">
                        <span style="font-weight: bolder;"> <i class="fas fa-book-dead"></i> &nbsp; Deceased Estate Assignment </span>
                        <!-- <h6 class="text-center sm_text" style="color: #777;">  </h6> -->
                    </a>
                </li>
            </ul>

        </div>

        <div class="tab-content col-12" style="padding: 25px 0;">

            <div class="tab-pane <?= (((isset($_GET['tab']) && $_GET['tab'] == 'client') || !isset($_GET['tab'])) ? 'active' : '') ?>" id="client" role="tabpanel" aria-labelledby="client-tab">
                <div class="row">

                    <div class="col-12 article_container" style="padding: 5px !important;">
                        <div class="row/ media_div article_contents/ artclt_bg1" style="padding: 17px 5px; border-radius: 25px; ">
                            <h3 class="col-12 article_active" style="padding-left: 40px;">
                                <span class="">
                                    <i class="fas fa-user-friends fa-2x alt2_color"></i> <b style="font-weight:bolder; color: #d2ac67"> &emsp; Client Assignment </b>
                                </span>
                                <!-- <h6 class="sm_text" style="color: #777; padding-left: 120px"> &emsp; <?= $article['long'] ?></h6> -->
                                <hr>
                            </h3>
                            <div class="col-12" style="padding-top: 15px;">

                                <?php if ($user_type == 'client') : ?>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="shadow-sm p-3 mb-5 bg-white rounded" style="background-color: #fff; border-radius: 15px !important;">
                                                <h5 class="text-center/ text-secondary"> <span> <?= ((!empty($user['name'])) ? $user['name'] . ' | ' : '') ?> <?= $user['username'] ?> </span> </h5>
                                                <hr>
                                                <h6 class="text-info/ bg-secondary" style="color: #ddd; border-radius: 5px; padding: 5px;"> <i>Assigned Deceased Estate</i> </h6>

                                                <?php if (is_array($clients) || is_object($clients)) : ?>
                                                    <table class="table table-striped table-sm">
                                                        <tbody>
                                                            <?php foreach ($clients as $key => $client) : ?>
                                                                <tr id="clnt_row_<?= $key ?>">
                                                                    <th scope="row">
                                                                        <a href="./view?usr=<?= $client['member_id'] ?>&usr_type=member">
                                                                            <span class="text-secondary"> <?= ((!empty($client['name'])) ? $client['name'] . ' | ' : '') ?> <?= $client['member_surname_initials'] ?> </span>
                                                                        </a>
                                                                    </th>
                                                                    <td>
                                                                        <div class="float-right">
                                                                            <button type="button" class="btn btn-danger/ btn-sm float-right text-secondary" onclick="postCheck('clnt_row_<?= $key ?>', {'member':<?= $client['member_id'] ?>, 'user':<?= $user_id ?>, 'form_type':'remove_member' } )" <?= ((!$is_admin) ? 'disabled' : '') ?>> <i class="fas fa-trash text-danger"></i> &nbsp; unlink </button>
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

                                        </div>

                                        <div class="col-md-6">

                                            <div class="shadow-sm p-3 mb-5 bg-white rounded" style="background-color: #fff; border-radius: 15px !important;">

                                                <form action="" method="GET">
                                                    <div class="input-group mb-3">
                                                        <input class="form-control shadow-none" type="search" name="name" value="<?= ((isset($search) && !empty($search)) ? $search : '') ?>" placeholder="Search ..." aria-label="Search ..." aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button id="basic-addon2" class="input-group-text btn btn-outline-secondary my-2/ my-sm-0/ shadow-none" type="submit"> <i class="fas fa-search"></i> &nbsp; Search</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="token" value="<?= get_token(); ?>">
                                                    <input type="hidden" name="usr" value="<?= $user_id ?>">
                                                    <input type="hidden" name="usr_type" value="<?= $user_type ?>">
                                                    <input type="hidden" name="tab" value="<?= $crrnt_tab ?>">

                                                </form>

                                                <!-- <hr> -->
                                                <h6 class="text-info/ alt_dflt"> <i> Deceased estate search results</i> </h6>
                                                <div id="clnt_search_err" style="padding-top: 15px;"></div>
                                                <?php if (is_array($req_res) || is_object($req_res)) : ?>
                                                    <?php foreach ($req_res as $key => $result) : ?>
                                                        <?php $user_check = get_member_by_user_id($user['user_id'], $result['member_id'], false) ?>
                                                        <?php $user_check = (($user_check && $user_check['association_status'] == 1) ? true : false) ?>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-top: 1px; padding-bottom: 1px;">
                                                                <a href="view?usr=<?= $result['member_id'] ?>&usr_type=member"> <span> <?= $result['member_surname_initials'] ?> </span> </a>
                                                                <button type="button" class="btn btn-secondary btn-sm float-right <?= (($user_check) ? 'disabled' : '') ?>" style="color: #ddd" onclick="postCheck('clnt_search_err', {'form_type':'search_assign', 'user_type':'member', 'member':<?= $result['member_id'] ?>, 'user':<?= $user_id ?>})" <?= ((!$is_admin) ? 'disabled' : '') ?> <?= ((!$is_admin) ? 'disabled' : '') ?>> <i class="fas fa-puzzle-piece"></i> &nbsp; Assign </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <br>
                                                    <h6 class="text-danger"> There is no search results to display ... </h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <h5 class="text-center alert alert-secondary" style="font-weight: normal;">
                                        <br>
                                        Please select or search Applicants | Executors from <a href="./clients" class="text-info/ alt_dflt"> here ... </a>
                                        <br>
                                    </h5>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <br><br>
                </div>

            </div>

            <div class="tab-pane <?= (((isset($_GET['tab']) && $_GET['tab'] == 'member')) ? 'active' : '') ?>" id="member" role="tabpanel" aria-labelledby="member-tab">
                <div class="row">

                    <div class="col-12 article_container" style="padding: 5px !important;">
                        <div class="row/ media_div article_contents/ artclt_bg2" style="padding: 17px 5px; border-radius: 25px; ">
                            <h3 class="col-12 article_active" style="padding-left: 40px;">
                                <span class="">
                                    <i class="fas fa-book-dead fa-2x alt2_color"></i> <b style="font-weight:bolder; color: #d2ac67"> &emsp; Deceased Estate Assignment </b>
                                </span>
                                <!-- <h6 class="sm_text" style="color: #777; padding-left: 120px"> &emsp; </h6> -->
                                <hr>
                            </h3>
                            <div class="col-12" style="padding-top: 15px;">

                                <?php if ($user_type == 'member') : ?>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="shadow-sm p-3 mb-5 bg-white rounded" style="background-color: #fff; border-radius: 15px !important;">
                                                <h5 class="text-center/ text-secondary"> <?= (($user_type == 'client') ? $user['username'] : $user['member_surname_initials']) ?> </h5>
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
                                                                            <button type="button" class="btn btn-danger/ float-right text-secondary" onclick="postCheck('memb_row_<?= $key ?>', {'user':<?= $client['user_id'] ?>, 'member':<?= $user_id ?>, 'form_type':'remove_member' } )" <?= ((!$is_admin) ? 'disabled' : '') ?> <?= ((!$is_admin) ? 'disabled' : '') ?>> <i class="fas fa-trash text-danger"></i> &nbsp; unlink </button>
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

                                        </div>

                                        <div class="col-md-6">

                                            <div class="shadow-sm p-3 mb-5 bg-white rounded" style="background-color: #fff; border-radius: 15px !important;">

                                                <form action="?usr=<?= $user_id ?>&usr_type=<?= $user_type ?>>" method="GET">
                                                    <div class="input-group mb-3">
                                                        <input class="form-control shadow-none" type="search" name="name" value="<?= ((isset($search) && !empty($search)) ? $search : '') ?>" placeholder="Search ..." aria-label="Search ..." aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button id="basic-addon2" class="input-group-text btn btn-outline-secondary my-2/ my-sm-0/ shadow-none" type="submit"> <i class="fas fa-search"></i> &nbsp; Search</button>
                                                        </div>
                                                    </div>
                                                    <input id="search_token" type="hidden" name="token" value="<?= get_token(); ?>">
                                                    <input id="search_usr" type="hidden" name="usr" value="<?= $user_id ?>">
                                                    <input id="usr_type" type="hidden" name="usr_type" value="<?= $user_type ?>">
                                                    <input id="tab" type="hidden" name="tab" value="<?= $crrnt_tab ?>">

                                                </form>

                                                <!-- <hr> -->
                                                <h6 class="text-info/ alt_dflt"> <i> Applicant | Executor search results</i> </h6>
                                                <div id="search_err" style="padding-top: 15px;"></div>
                                                <?php if (is_array($req_res) || is_object($req_res)) : ?>
                                                    <?php foreach ($req_res as $key => $result) : ?>
                                                        <?php $user_check = get_member_by_user_id($result['user_id'], $user['member_id'], false) ?>
                                                        <?php $user_check = (($user_check && $user_check['association_status'] == 1) ? true : false) ?>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-top: 1px; padding-bottom: 1px;">
                                                                <button class="btn btn-sm shadow-none"> <span> <?= ((!empty($result['name'])) ? $result['name'] . ' | ' : '') ?> <?= $result['username'] ?> </span> </button>
                                                                <button type="button" class="btn btn-secondary btn-sm float-right <?= (($user_check) ? 'disabled' : '') ?>" style="color: #ddd" <?= (($is_admin) ? 'onclick="postCheck(\'search_err\', {\'form_type\':\'search_assign\', \'user_type\':\'client\', \'user\': ' . $result['user_id'] . ', \'member\':' . $user_id . '})"' : '') ?> <?= ((!$is_admin) ? 'disabled' : '') ?>> <i class="fas fa-puzzle-piece"></i> &nbsp; Assign </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <br>
                                                    <h6 class="text-danger"> There is no search results to display ... </h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <h5 class="text-center alert alert-secondary" style="font-weight: normal;">
                                        <br>
                                        Please select or search Deceased estate from <a href="./estates" class="text-info/ alt_dflt"> here ... </a>
                                        <br>
                                    </h5>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <br><br>
                </div>

            </div>

        </div>

    </div>



    <br><br>
</div>