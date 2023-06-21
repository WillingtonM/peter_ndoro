
<!-- Feedback Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-content" class="text-center"></div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="modalSupport" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true" style="background: rgba(2, 2, 2, 0.5) !important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #fff; border-radius: 25px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row/">
                    <div class="col text-center">
                        <img class="img text-center" src="<?= PROJECT_LOGO ?>" alt="<?= PROJECT_TITLE ?> Logo" width="150px" height="150px">
                    </div>
                    <br>
                    <div class="text-center text-secondary">
                        <p>Welcome to the admin support!</p>
                    </div>
                    <hr>
                    <div class="col-12">
                        <form class="" id="loginForm" style="border-radius: 7px;">
                            <div id="login_message" class="message"></div>

                            <div class="form-row align-items-center">
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text text-warning"><i class="fa fa-user"></i></span>
                                        <input type="username" autocomplete="username" class="form-control shadow-none" id="username" name="username" placeholder="Username" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row align-items-center">
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text text-warning"><i class="fas fa-unlock-alt"></i></span>
                                        <input type="password" autocomplete="password" class="form-control shadow-none" id="password" name="password" required>
                                    </div>
                                </div>
                            </div>

                            <button id="submitForm" type="button" class="btn btn-secondary btn-sm col-12" style="border-radius: 12px; font-weight: bolder;" onclick="postonly(path_action, {'login_username': $('#username').val(), 'login_password': $('#password').val()}, 'login_message');">Submit</button>

                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- comment user -->
<div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true" style="background: rgba(2, 2, 2, 0.5) !important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title text_default" id="ModalCenterTitle">User Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="col text-center">
                        <img class="img text-center" src="<?= PROJECT_LOGO ?>" alt="<?= PROJECT_TITLE ?> Logo" width="150px" height="150px">
                    </div>
                    <br>
                    <div class="text-center">
                        <br>
                        <small>Your username and email will be securely saved. You should use the same information for any future comments on this site.</small>
                    </div>
                    <hr>
                    <div class="col-12">
                        <form class="" id="loginFormUser" style="border-radius: 7px;">
                            <div id="message_err" class="message"></div>
                            <div class="form-group">
                                <label for="username">Full Name</label>
                                <input type="username" name="username" class="form-control" id="user_username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email" required>
                            </div>
                            <button id="submitFormUser" type="button" class="btn btn-warning btn-sm col-12" style="border-radius: 35px;" onclick="postonly(path_action, {'user_username': $('#user_username').val(), 'user_email': $('#user_email').val(), 'comment':$('#comment').val(), 'article': article_id}, 'message_err');">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>