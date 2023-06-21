<div class="container">
    <br>
    <!-- <div class="row"> -->

    <div class="col-12">
        <!-- <h6 class="alert alert-secondary bg-secondary" class="">
            <span style="color: #ddd;"> User Activities </span>
        </h6>
        <hr> -->
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs nav-justified" id="myTab" style="border: none;">
                    <?php foreach ($user_activities as $key => $article) : ?>
                        <?php $tabbs_count++ ?>
                        <li style="margin: 5px;" class="nav-item article_nav <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'article_active' : '') ?>" onclick="change_bg(parseInt(<?= $tabbs_count ?>) - 1);">
                            <a onclick="changeURL('<?= $key ?>')" class="nav-link <?= (((isset($_GET['tab']) && $_GET['tab'] ==  $key) || (!isset($_GET['tab']) && $tabbs_count == 1)) ? 'active' : '') ?>" id="<?= $key ?>-tab" data-toggle="tab" href="#<?= $key ?>" role="tab" aria-controls="<?= $key ?>" aria-selected="true">
                                <span style="font-weight: bolder;"> <i class="<?= $article['imgs'] ?>"></i> &nbsp; <?= $article['short'] ?> </span>
                                <!-- <h6 class="text-center sm_text" style="color: #777;"><?= $article['long'] ?></h6> -->
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        <!-- <div class="col float-right">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input class="form-control shadow-none" type="search" name="name" placeholder="Search ..." aria-label="Search ..." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button id="basic-addon2" class="input-group-text btn btn-outline-secondary my-2/ my-sm-0/ shadow-none" type="submit"> <i class="fas fa-search"></i> &nbsp; Search</button>
                        </div>
                    </div>
                    <input id="search_token" type="hidden" name="token" value="<?= get_token(); ?>">
                </form>
            </div> -->
        <br>

        <div class="tab-content col-12">


            <!-- all activities -->
            <div class="tab-pane <?= (((isset($_GET['tab']) && $_GET['tab'] == 'all') || (!isset($_GET['tab']))) ? 'active' : '') ?>" id="all" role="tabpanel" aria-labelledby="all-tab">

                <div class="row shadow-sm p-3 mb-5 bg-white rounded" style="border-radius: 15px !important;">

                    <?php
                    $intval             = 100;
                    $article_type       = 'guest';
                    $page_nmb           = (int) (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;

                    if (HOST_IS_LIVE) {
                        $cnt_sql        = "SELECT count(*) FROM notifications WHERE  notification_status = 1";
                        $cnt_dta        = [$article_type];
                        $artcl_count    = (int) prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3]);
                    }

                    $page_count         = ceil(($artcl_count / $intval));
                    $sql_pg_strt        = (int)($page_nmb - 1) * $intval;

                    if (HOST_IS_LIVE) {
                        $rgst_sql       = "SELECT * FROM notifications WHERE  notification_status = 1 ORDER BY notification_created_date DESC LIMIT $sql_pg_strt, $intval";
                        $rgst_dta       = [$article_type];
                        $nwsf_qry       = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
                    }

                    ?>

                    <div class="col-12"><br></div>
                    <div class="col-12" style="padding: 0; border: 1px solid #ddd; border-radius: 0 0 15px 15px;">

                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr class="">
                                    <th scope="col">User Name</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Activity Value</th>
                                    <th scope="col">Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_array($nwsf_qry) || is_object($nwsf_qry)) : ?>
                                    <?php $cnt = 0 ?>
                                    <?php foreach ($nwsf_qry as $key => $association) : ?>
                                        <?php $cnt++ ?>
                                        <?php $notif_msg = '' ?>
                                        <?php $database = $association['notification_database'] ?>
                                        <?php $dtbs_id  = $association['notification_database_id'] ?>
                                        <?php $dtbs_ind = str_replace(' ', '', $association['notification_message_index']) ?>
                                        <?php $dtbs_msg = (string) $association['notification_message'] ?>
                                        <?php $db_stmt  = substr_replace($database, "", -1) . '_id = ' . $dtbs_id ?>

                                        <?php if (!in_array($database, $allowed_db)) continue; ?>

                                        <?php $db_query = "SELECT * FROM $database WHERE $db_stmt LIMIT 1" ?>
                                        <?php $db_qry   = prep_exec($db_query, $rgst_dta, $sql_request_data[0]); ?>

                                        <?php $user     = get_user_by_id($association['user_id']) ?>

                                        <tr>
                                            <td> <span> <?= ((!empty($user['name'])) ? $user['name'] : '') ?> </span> </td>
                                            <?php if ($database == 'associations') : ?>
                                                <?php $dtbs_msg_type    = (($dtbs_msg == '1' || $dtbs_msg == '0') ? 'updt_' . (string) $dtbs_msg : $dtbs_msg); ?>
                                                <?php $activity         = $notifications_arr[$database][$dtbs_msg_type] ?>
                                                <?php $notif_msg        = $activity['sts'] . ': ' . $activity['msg']  ?>
                                                <td> <?= $activity['sts'] ?> </td>
                                                <td> <?= $activity['msg'] ?> </td>
                                            <?php elseif ($database == 'members') : ?>
                                                <?php $dtbs_msg_type    = (($dtbs_msg == 'insert') ? 'insert' : (($dtbs_ind  == 'update') ? 'update' : '')) ?>
                                                <?php if (!empty($dtbs_msg_type)) : ?>
                                                    <?php $activity     = $notifications_arr[$database][$dtbs_msg_type]['msg'] ?>

                                                <?php elseif ($dtbs_msg == 'remove') : ?>
                                                    <?php $activity     = $notifications_arr[$database][$dtbs_msg]['msg'] ?>
                                                <?php else : ?>
                                                    <?php $activity     = (isset($deceased_estates_msgs[$dtbs_ind])) ? $deceased_estates_msgs[$dtbs_ind]['notc'] : '' ?>
                                                <?php endif; ?>
                                                <?php $notif_msg        = (!empty($dtbs_msg_type) ? $dtbs_msg_type : ((!empty($activity)) ? 'update' : '')) . ': ' . $activity  ?>

                                                <td> <?= (!empty($dtbs_msg_type) ? $dtbs_msg_type : ((!empty($activity)) ? 'update' : '')) ?> </td>
                                                <td> <?= $activity ?> </td>
                                            <?php else : ?>
                                                <td></td>
                                                <td></td>
                                            <?php endif; ?>

                                            <td style="white-space: nowrap; width: 1"> <small> <?= ((!empty($association['notification_created_date'])) ? date("d-m-Y", strtotime($association['notification_created_date'])) : '') ?> </small> </td>
                                            <td style="white-space: nowrap; width: 1">
                                                <a type="button" class="btn btn-sm btn-info/ article_nav article_active" onclick="requestModal(post_modal[12], post_modal[12], {'usr':<?= $association['notification_id'] ?>, 'msg':'<?= $notif_msg ?>' })"> <small> <i class="fas fa-eye"></i> &nbsp; View</small> </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>

                    </div>

                    <br><br>
                </div>

                <div class="row">
                    <!-- paggination -->
                    <?php if ($page_count > 1) : ?>
                        <div class="col-12">
                            <br><br>
                            <nav aria-label="Page navigation text-secondary text-center/">
                                <ul class="pagination text-center/ float-right">
                                    <li class="page-item">
                                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (((int)$page_nmb - 1 <= 0) ? $page_nmb : $page_nmb - 1) ?>" <?= (($page_nmb - 1 <= 0) ? 'disabled' : '') ?> aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <?php for ($pg = 1; $pg <= $page_count; $pg++) : ?>
                                        <li class="page-item"><a class="page-link <?= (($pg == $page_nmb) ? 'text-danger' : 'text-secondary') ?>" href="?tab=<?= $article_type ?>&page=<?= $pg ?>"><?= $pg ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (($page_nmb >= $page_count) ? $page_nmb : $page_nmb + 1) ?>" <?= (($page_nmb >= $page_count) ? 'disabled' : '') ?> aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>


            </div>

            <!-- users activities -->
            <div class="tab-pane <?= ((isset($_GET['tab']) && $_GET['tab'] == 'users') ? 'active' : '') ?>" id="users" role="tabpanel" aria-labelledby="users-tab">

                <div class="row shadow-sm p-3 mb-5 bg-white rounded" style="border-radius: 15px !important;">

                    <?php
                    $intval             = 100;
                    $article_type       = 'guest';
                    $page_nmb           = (int) (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;

                    if (HOST_IS_LIVE) {
                        $cnt_sql        = "SELECT count(*) FROM users WHERE user_type != 'guest' AND user_status = 1";
                        $cnt_dta        = [];
                        $artcl_count    = (int) prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3]);
                    }

                    $page_count         = ceil(($artcl_count / $intval));
                    $sql_pg_strt        = (int)($page_nmb - 1) * $intval;

                    if (HOST_IS_LIVE) {
                        $rgst_sql       = "SELECT * FROM users WHERE user_type != 'guest' AND user_status = 1 ORDER BY date_created DESC LIMIT $sql_pg_strt, $intval";
                        $rgst_dta       = [];
                        $nwsf_qry       = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
                    }

                    ?>

                    <div class="col-12">
                        <button class="btn btn-sm btn-info/ article_nav article_active float-right" type="button" onclick="requestModal(post_modal[13], post_modal[13], {'graph':true})"> <i class="fas fa-user-plus"></i> &nbsp; User Graphical Activities </button>
                    </div>&nbsp;
                    <div class="col-12" style="padding: 0; border: 1px solid #ddd; border-radius: 0 0 15px 15px;">

                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr class="">
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_array($nwsf_qry) || is_object($nwsf_qry)) : ?>
                                    <?php $cnt = 0 ?>
                                    <?php foreach ($nwsf_qry as $key => $association) : ?>
                                        <?php $cnt++ ?>
                                        <tr>
                                            <td> <span> <?= ((!empty($association['name'])) ? $association['name'] . ' | ' : '') ?> <i> <?= $association['username']; ?></i> </span> </th>
                                            <td> <?= ((!empty($association['user_position'])) ? $association['user_position'] : '') ?> </td>
                                            <td class="float-right">
                                                <a class="btn btn-sm btn-info/ article_nav article_active" href="?tab=user&usr=<?= $association['username'] ?>"> <i class="fas fa-users-cog"></i> &nbsp; View Activities </a> &emsp;
                                                <!-- <a href="assign?usr=<?= $association['user_id'] ?>&usr_type=client&tab=client"> <span class="alt_dflt"> <i class="fas fa-clipboard-list"></i> &nbsp; Assign </span> </a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>

                    </div>

                    <br><br>
                </div>


            </div>

            <!-- user notification activities -->
            <div class="tab-pane <?= ((isset($_GET['tab']) && $_GET['tab'] == 'user') ? 'active' : '') ?>" id="user" role="tabpanel" aria-labelledby="user-tab">

                <div class="row shadow-sm p-3 mb-5 bg-white rounded" style="border-radius: 15px !important;">

                    <?php
                    $intval             = 60;
                    $db_dta             = [];
                    $username           = (isset($_GET['usr'])) ? $_GET['usr'] : '';
                    $user               = get_user_by_username($username);
                    $usr_id             = ($user) ? $user['user_id'] : '';

                    $article_type       = 'guest';
                    $page_nmb           = (int) (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;

                    if (HOST_IS_LIVE) {
                        $cnt_sql        = "SELECT count(*) FROM notifications WHERE user_id = ?  AND notification_status = 1";
                        $cnt_dta        = [$usr_id];
                        $artcl_count    = (int) prep_exec($cnt_sql, $cnt_dta, $sql_request_data[3]);
                    }

                    $page_count         = ceil(($artcl_count / $intval));
                    $sql_pg_strt        = (int)($page_nmb - 1) * $intval;

                    if (HOST_IS_LIVE) {
                        $rgst_sql       = "SELECT * FROM notifications WHERE user_id = ? AND notification_status = 1 ORDER BY notification_created_date DESC LIMIT $sql_pg_strt, $intval";
                        $rgst_dta       = [$usr_id];
                        $nwsf_qry       = prep_exec($rgst_sql, $rgst_dta, $sql_request_data[1]);
                    }

                    ?>

                    <?php if ($user) : ?>
                        <div class="col-12">
                            <br>
                            <h3 class="text-secondary"> <?= $user['name'] . ' ' . $user['last_name'] . 's' ?> <small> <i>( <?= $user['username'] ?> )</i> </small> &emsp; Activities</h3>
                            <br>
                        </div>
                        <div class="col-12" style="padding: 0; border: 1px solid #ddd; border-radius: 0 0 15px 15px;">

                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr class="">
                                        <th scope="col">Activity</th>
                                        <th scope="col">Activity Value</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (is_array($nwsf_qry) || is_object($nwsf_qry)) : ?>
                                        <?php $cnt = 0 ?>
                                        <?php foreach ($nwsf_qry as $key => $association) : ?>
                                            <?php $cnt++ ?>
                                            <?php $notif_msg = '' ?>
                                            <?php $database = $association['notification_database'] ?>
                                            <?php $dtbs_id  = $association['notification_database_id'] ?>
                                            <?php $dtbs_ind = str_replace(' ', '', $association['notification_message_index']) ?>
                                            <?php $dtbs_msg = (string) $association['notification_message'] ?>
                                            <?php $db_stmt  = substr_replace($database, "", -1) . '_id = ' . $dtbs_id ?>

                                            <?php if (!in_array($database, $allowed_db)) continue; ?>

                                            <?php $db_query = "SELECT * FROM $database WHERE $db_stmt LIMIT 1" ?>
                                            <?php $db_qry   = prep_exec($db_query, $rgst_dta, $sql_request_data[0]); ?>

                                            <?php $user     = get_user_by_id($association['user_id']) ?>

                                            <tr>
                                                <?php if ($database == 'associations') : ?>
                                                    <?php $dtbs_msg_type    = (($dtbs_msg == '1' || $dtbs_msg == '0') ? 'updt_' . (string) $dtbs_msg : $dtbs_msg); ?>
                                                    <?php $activity         = $notifications_arr[$database][$dtbs_msg_type] ?>
                                                    <?php $notif_msg        = $activity['sts'] . ': ' . $activity['msg']  ?>
                                                    <td> <?= $activity['sts'] ?> </td>
                                                    <td> <?= $activity['msg'] ?> </td>
                                                <?php elseif ($database == 'members') : ?>
                                                    <?php $dtbs_msg_type    = (($dtbs_msg == 'insert') ? 'insert' : (($dtbs_ind  == 'update') ? 'update' : '')) ?>
                                                    <?php if (!empty($dtbs_msg_type)) : ?>
                                                        <?php $activity     = $notifications_arr[$database][$dtbs_msg_type]['msg'] ?>

                                                    <?php else : ?>
                                                        <?php $activity     = (isset($deceased_estates_msgs[$dtbs_ind])) ? $deceased_estates_msgs[$dtbs_ind]['notc'] : '' ?>
                                                    <?php endif; ?>
                                                    <?php $notif_msg        = (!empty($dtbs_msg_type) ? $dtbs_msg_type : ((!empty($activity)) ? 'update' : '')) . ': ' . $activity  ?>

                                                    <td> <?= (!empty($dtbs_msg_type) ? $dtbs_msg_type : ((!empty($activity)) ? 'update' : '')) ?> </td>
                                                    <td> <?= $activity ?> </td>
                                                <?php else : ?>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>

                                                <td> <small> <?= ((!empty($association['notification_created_date'])) ? date("d-m-Y", strtotime($association['notification_created_date'])) : '') ?> </small> </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-info/ article_nav article_active" onclick="requestModal(post_modal[12], post_modal[12], {'usr':<?= $association['notification_id'] ?>, 'msg':'<?= $notif_msg ?>' })"> <small> <i class="fas fa-eye"></i> &nbsp; View</small> </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </tbody>
                            </table>

                        </div>
                        <br><br>
                    <?php else : ?>
                        <br><br>
                        <div class="col-12 alert alert-danger">
                            <h6> No user is selected </h6>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="row">
                    <!-- paggination -->
                    <?php if ($page_count > 1) : ?>
                        <div class="col-12">
                            <br><br>
                            <nav aria-label="Page navigation text-secondary text-center/">
                                <ul class="pagination text-center/ float-right">
                                    <li class="page-item">
                                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (((int)$page_nmb - 1 <= 0) ? $page_nmb : $page_nmb - 1) ?>" <?= (($page_nmb - 1 <= 0) ? 'disabled' : '') ?> aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <?php for ($pg = 1; $pg <= $page_count; $pg++) : ?>
                                        <li class="page-item"><a class="page-link <?= (($pg == $page_nmb) ? 'text-danger' : 'text-secondary') ?>" href="?tab=<?= $article_type ?>&page=<?= $pg ?>"><?= $pg ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link text-secondary" href="?tab=<?= $article_type ?>&page=<?= (($page_nmb >= $page_count) ? $page_nmb : $page_nmb + 1) ?>" <?= (($page_nmb >= $page_count) ? 'disabled' : '') ?> aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

    </div>

</div>