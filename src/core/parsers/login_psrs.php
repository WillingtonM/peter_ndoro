<div class="panel panel-info">

  <div class="panel-heading/">
    <h3 class="panel-title text-center mb-6">
      <a href="./" class="text-center">
        <img src="<?= PROJECT_LOGO ?>" width="65px" style="position: relative;" alt="<?= PROJECT_TITLE . ' Logo' ?>">
        <span class="trln_text" style="position: relative; font-size: 3rem; top: 10px;">
          <b style="color: #b90102;">Pick</b><b style="color: #03556b;">tick</b>
        </span>
      </a>
    </h3>
    <p class="text-center mb-3">
      <a href="./" class="text-info">
        <span>Login or create account later</span>
      </a>
    </p>
  </div>

  <div id="login_form_div" class="panel-body col-12 bg-light border-radius-xl p-3">

    <div id="login_message" class="message">
      <div class="<?= (((isset($data['message']) && !empty($data['message']))) ? 'alert alert-warning' : '') ?>">
        <?= ((isset($data['message'])) ? $data['message'] : '') ?>
      </div>
    </div>

    <form class="form-horizontal loginForm" method="POST" id="loginForm">
      <input id="logintype" type="hidden" name="logintype" value="<?= $is_login ?>">
      <input id="passresetInpt" type="hidden" name="passreset" value="false">

      <?php if (isset($data['success']) && $data['success'] == true) : ?>
        <input id="passresetConfirm" type="hidden" name="passreset_confirm" value="1">
        <input id="reset_code" type="hidden" name="reset_code" value="<?= $token ?>">
        <input id="user_type" type="hidden" name="user_type" value="<?= $user_type ?>">
        <input id="userkey" type="hidden" name="userkey" value="<?= $userkey ?>">
        <?php if ($user_type == 'admin') : ?>
          <input id="merchant" type="hidden" name="merchant" value="<?= $merchant_id ?>">
          <input id="user" type="hidden" name="user" value="<?= ((isset($_GET['user'])) ? sanitize($_GET['user']) : null) ?>">
        <?php endif; ?>
      <?php endif; ?>

      <div id="usernameDiv" class="input-group mb-1">
        <span class="input-group-text" id="username-1" style="border-right: none;"><i class="fas fa-user"></i> </span>
        <input id="username" type="text" class="form-control shadow-none col-12" autocomplete="username" placeholder="Username" value="<?= ((isset($username)) ? $username : '') ?>" aria-label="username-1" aria-describedby="username-1" <?= ((isset($username) && $username != '' && $data['success']) ? 'disabled' : '') ?>>
      </div>
      <?php if (isset($user_text) && !empty($user_text)) : ?>
        <div class="mb-3" style="font-size: smaller; padding-left: 53px !important; text-align: left;"> <span style="padding-left: 0 !important; font-size: 1em"> <?= $user_text ?> </span> </div>
      <?php endif; ?>

      <div id="emailDiv" class="input-group mb-3 <?= (($is_login) ? 'hidden' : '') ?>">
        <span class="input-group-text" id="email-1" style="border-right: none;"><i class="fas fa-envelope"></i> </span>
        <input id="email" type="email" class="form-control shadow-none" placeholder="Email" aria-label="email-1" aria-describedby="email-1" autocomplete="username">
      </div>

      <!-- Password form -->
      <div id="passwordDiv" class="input-group mb-3">
        <span class="input-group-text" id="password-1" style="border-right: none;"><i class="fas fa-lock"></i> </span>
        <input id="password" type="password" class="form-control shadow-none" autocomplete="current-password" placeholder="<?= ((isset($data['success']) && $data['success'] == true) ? 'New ' : '') ?>Password" aria-label="password-1" aria-describedby="password-1">
        <span class="input-group-text" onclick="show_pwd('password')"> <i class="fas fa-eye"></i> </span>
      </div>

      <!-- Password confirmation -->
      <?php if (isset($data['success']) && $data['success'] == true) : ?>
        <div id="passwordConfirmDiv" class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="passwordconfirm-1" style="border-right: none;"><i class="fas fa-lock"></i> </span>
          </div>
          <input id="passwordconfirm" type="password" class="form-control shadow-none" autocomplete="new-password" placeholder="Confirm Password" aria-label="passwordconfirm-1" aria-describedby="passwordconfirm-1">
        </div>
      <?php endif; ?>

      <div id="isLogged" class="form-group text-center mb-3">
        <button class="btn btn-dark shadow-none/ isLoggedBtn border-radius-lg" type="button" style="width: 100%;" onclick="login()">
          <span id="isLoggedBtn" style="font-weight: bolder;">
            <?= (($is_login) ? ((isset($data['success']) && $data['success'] == true) ? 'Reset Password' : 'Login') : 'Create Account') ?>
          </span>
        </button>
      </div>

      <!-- Password reset -->
      <div id="passreset" class="form-group p-3 mb-3 text-center <?= ((!$is_login || $passreset) ? 'hidden' : '') ?>">
        <a type="button" class="shadow-none float-right text-info" onclick="passReset()">
          <small id="resetText" class="text-dark font-weight-bold">Forgot your username or password ?</small>
        </a>
      </div>

    </form>
  </div>

  <div id="accnttypeDiv" class="col-12 mb-5/ py-4">
    <div id="accountSignin" class="logintype">
      <center>
        <?php if ($is_login || $passreset) : ?>
          <span class="q_accnt text-secondary">You dont's have an account?</span> &nbsp;
          <a type="button" class="change_accnt text-info shadow-none" onclick="changeLogin();">
            <span class="text-info fs-5 font-weight-bolder">Create account</span>
          </a>

        <?php elseif (!$is_login || $passreset) : ?>
          <span class="q_accnt text-secondary">Already have an account ?</span> &nbsp;
          <a type="button" class="change_accnt text-info shadow-none" onclick="changeLogin();">
            <span class="text-info fs-4 font-weight-bolder">Login</span>
          </a>

        <?php endif; ?>

      </center>
    </div>

    <?php if (isset($data['success']) && $data['success'] == true) : ?>
      <div class="text-center">
          <a type="button" class="btn shadow-none" href="./login" style="font-size: 1.2rem;">
            <span class="text-info font-weight-bold">
              Login or Create an account ?
            </span>
          </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  $('.loginForm').bind('keypress', function(e) {
    if (e.which == 13) {
      e.preventDefault;
      $('.isLoggedBtn').trigger('click');
    }
  });
</script>