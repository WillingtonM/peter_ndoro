<div class="container">
    <br><br>

    <div class="row">
        <div id="" class="media_div col-12" style="background-color: rgb(255, 255, 255, 1); padding-top: 35px; border-radius: 25px;">
            <div class="row">

                <div class="col-12">
                    <button type="button" class="btn btn-sm btn-warning shadow-none article_nav article_active float-right" onclick="requestModal(post_modal[10], post_modal[10], {})" style="padding: 5px 15px;" <?= ((!$is_admin) ? 'disabled' : '') ?>> <i class="fas fa-user-plus"></i> &nbsp; Create User</button>
                    <br>&nbsp;
                    <hr>
                </div>

                <br>
                <div class="col-12" id="users_message"></div>
                <div class="col-12">
                    <ul class="row/">

                        <?php if (is_array($usr_qry) || is_object($usr_qry)) : ?>
                            <?php foreach ($usr_qry as $key => $usr) : ?>
                                <?php $image = (($usr != null) ? img_path(ABS_USER_PROFILE, $usr['user_image'], 1) : '') ?>
                                <?php $ful_name = $usr['name'] . ' ' . $usr['last_name'] ?>
                                <?php $usr_name = $usr['username'] ?>
                                <?php $usr_pstn = $usr['user_position'] ?>

                                <li class="row" id="user_<?= $usr['user_id'] ?>" style="padding-bottom: 3px; border-bottom: 1px solid #ddd;">
                                    <div class="col-12">

                                        <div class="img_container/ float-left" style="width: 50px; height: 100%;">

                                            <div class="col-12/ img_circle_contain/" style="padding: 2px; border: 1px solid #ddd; border-radius: 50px; background: #fff;">
                                                <a type="button" class="btn/">
                                                    <img src="<?= $image ?>" alt="" style="border: 1px solid #efef; border-radius: 47px; width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile_details/" style="padding-left: 45px; position:relative;">
                                            <div class="col-12">
                                                <a type="button" class="btn/">
                                                    <span style="color: #555555; font-size: .9em;"> <b><?= $ful_name ?></b> </span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a type="button" class="btn/">
                                                    <small style="color: #777777;">@<?= $usr_name ?></small>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <span class="alt_dflt"> <?= $usr_pstn ?> </span>
                                            </div>

                                            <div id="nav_tabs" class="float-right" style="position: absolute; top: 6px; right: 15px;">
                                                <button type="button" class="btn btn-danger/ article_nav article_active/ btn-sm float-right shadow-none" name="button" onclick="postCheck( 'users_message', {'user_id' : parseInt(<?= $usr['user_id'] ?>), 'edit_user': 'edit'})" style="padding: 5px 15px;" <?= ((!$is_admin) ? 'disabled' : '') ?>> <span class="text-danger"> <i class="fas fa-trash-alt"></i> &nbsp; remove </span> </button>
                                                <button type="button" class="btn btn-danger/ article_nav article_active btn-sm float-right shadow-none" name="button" onclick="requestModal(post_modal[10], post_modal[10],  {'user_id': <?= $usr['user_id'] ?>})" style="padding: 5px 15px;" <?= ((!$is_admin) ? 'disabled' : '') ?>> <span><i class="fas fa-user-edit"></i> &nbsp; Edit </span> </button>
                                            </div>
                                        </div>


                                    </div>

                                </li><br>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>