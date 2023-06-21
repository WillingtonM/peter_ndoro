"use strict"; // Post functions **************************************************************

function passResetPost() {
  var data = {},
      err = '',
      ret = false;
  var reset_code = $('#reset_code').val();
  var password_confirm = $('#passwordconfirm').val();
  var userkey = $('#userkey').val();
  var username = $('#username').val();
  var password = $('#password').val();
  var user_type = $('#user_type').val();
  var merchant = $('#merchant').val();
  var user = $('#user').val();

  if (password == '') {
    err = "Password field is empty";
  } else if (password_confirm == '') {
    err = "Password confirmation field is empty";
  } else if (password_confirm != password) {
    err = "Your new password and confirmation password do not match";
  }

  if (err == '') {
    data = {
      'form_type': 'passreset_confirm',
      'login_form': false,
      'reset_code': reset_code,
      'username': username,
      'password': password,
      'userkey': userkey,
      'user_type': user_type,
      'merchant': merchant,
      'user': user,
      'password_confirm': password_confirm
    };
    postCheck('login_message', data, 11);
  } else {
    $('#login_message').html(alert_msg(err));
  }
}

function passResetEmail(email) {
  var err = '';

  if (email != '') {
    console.log("hello");

    if (validate_email(email)) {
      data = {
        'form_type': 'passreset',
        'email': email
      };
      console.log("check");
      console.log(data);
      postCheck('login_message', data, 11);
    } else {
      err = "Invalid email, please enter valid email";
    }
  } else {
    err = "Email is blank, please provide valid email";
  }

  if (err != '') {
    console.log("console.error;");
    $('#login_message').html(alert_msg(err));
  } else {// $('.message').html('');
  }
}

function login() {
  var user = {},
      password_confirm = '',
      email = '',
      valid_email = '';
  var username = $('#username').val();
  var password = $('#password').val();
  var logintype = $('#logintype').val();
  var form1 = {
    'url': post_urls[11],
    'login_form': 'login',
    'password': password,
    'logintype': logintype
  };
  $('#login_message').html('');

  if (logintype == 0 && $('#passresetConfirm').length == 0) {
    email = $('#email').val();
    user = {
      'email': email,
      'username': username
    };
  } else if (validate_email(username)) {
    user = {
      'email': username
    };
  } else {
    user = {
      'username': username
    };
  }

  data = Object.assign({
    'get_type': post_type[0],
    'token': token
  }, form1, user);
  console.log(data);
  email = $('#email').val();
  valid_email = validate_email(email) ? true : false;

  if ($('#passresetConfirm').length != undefined && $('#passresetConfirm').length != 0) {
    // console.log("passreset confirmation");
    passResetPost();
  } else if ($('#passresetInpt').val() == 'true' || $('#passresetInpt').val() == true) {
    console.log("passreset");
    passResetEmail(email);
  } else if (username == '' || password == '' || logintype == 0 && email == '' || logintype == 0 && valid_email == false) {
    var err_usrname = username == '' ? "Username field is empty !" : "";
    var err_usrpass = password == '' ? "Password field is empty !" : "";
    var err_usrmail = email == '' ? "Email field is empty !" : !valid_email ? "Your email is invalid !" : "";
    var err = err_usrname != "" ? err_usrname : err_usrpass != "" ? err_usrpass : err_usrmail;
    $('.message').html(alert_msg(err));
  } else {
    $('.message').html('');
    postCheck('login_message', data, 2);
    jQuery.ajax({
      url: path_action,
      method: 'POST',
      data: data,
      success: function success(data) {
        console.log(data);

        if (is_json_string(data)) {
          data = JSON.parse(data);
          console.log(data);

          if (data.error == false && data.success == true) {
            if (data.url != '') {
              window.location.href = data.url;
            } else {
              location.reload();
            }
          } else {
            $('.message').html(alert_msg(data.message));
          }
        } else {// location.reload();
        }
      },
      error: function error() {
        alert('Connection Error');
      }
    });
  }
} // TODO:


function sign_up() {
  var username = $('#username').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var admin = $('#admin').val();
  var franchiseId = $('#franchise_val').val();
  console.log(username, password, email);

  if (password.length >= 8) {
    password_check = 1;
  } else {
    $('#notice').html(alert_msg('Password too short'));
  }

  if (username == '' && user_check == 0 || email == '' && email_check == 0 || password == '' && email_check == 0) {
    $('#notice').html(alert_msg('All fields are required'));
  } else {
    $('#notice').html('');
    var url = 'includes/action/signin.php';
    var data1 = $('#UsernameForm').serialize();
    var data2 = $('#emailForm').serialize();
    var data3 = $('#passwordForm').serialize();
    var data4 = $('#franchiseForm').serialize(); // console.log(data4);

    var data5 = $('#submitForm').serialize();
    console.log(user_check, email_check, password_check);

    if (user_check == 1 && email_check == 1 && password_check == 1) {
      var data = data1 + '&' + data2 + '&' + data3;
      console.log(french_check, ' french'); // if(($('#franchise_val').val().length>0) && french_check == 1){

      if ($('#franchise_val').length > 0 && french_check == 1) {
        data = data + '&' + data4 + '&' + data5;
      } else {
        data = data + '&' + data5;
      }

      console.log(data);
      jQuery.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function success(data) {
          console.log(data);
          data = JSON.parse(data); // console.log(data);

          if (data.data == '' && data.error == '') {
            location.reload();
          } else {
            $('#notice').html(alert_msg(data.error));
          }
        },
        error: function error() {
          alert("Connection Error");
        }
      });
    } else {
      $('#notice').html(alert_msg('Please note that your inputs are incorrect'));
    }
  }
} // TODO:


function log_() {
  var url = parsers_path + 'signin_form.php';
  var data = {
    'signin_form': 'form_up'
  };
  jQuery.ajax({
    url: url,
    method: 'POST',
    data: data,
    success: function success(data) {
      console.log(data);

      if (data != null || data != '') {
        $('.modal-body').html(data);
      }
    },
    error: function error() {
      alert('Connection Error');
    }
  });
} // General login functions *****************************************************


function changeLogin() {
  $('#login_message').html('');
  var logintype = $('#logintype').val();
  $('#passreset').toggle();

  if ($('#emailDiv').hasClass('hidden')) {
    $('#emailDiv').removeClass('hidden');
    $('#isLoggedBtn').text("Create Account");
    $('.q_accnt').text("Already have an account ?");
    $('.change_accnt').text("Login");
  } else {
    $('#emailDiv').addClass('hidden');
    $('#isLoggedBtn').text("Login");
    $('.q_accnt').text("You dont's have an account ?");
    $('.change_accnt').text("Create account");
  }

  if (logintype == 0 && $('#emailDiv').hasClass('hidden')) {
    $('#logintype').val(1);
  } else if (logintype == 1) {
    $('#logintype').val(0);
  } else {// console.log("kkkkkk");
  }
}

function passReset() {
  var msg = '';
  $('#login_message').html('');

  if ($('#emailDiv').hasClass('hidden')) {
    msg = "Provide your account email";
    $('.message').html(message_alert(msg, 'warning'));
    $('#emailDiv').removeClass('hidden');
    $('#usernameDiv').toggle();
    $('#passwordDiv').toggle();
    $('#resetText').text('Cancel');
    $('#isLoggedBtn').text('Request password reset');
    $('#passresetInpt').val(true);
    $('#accnttypeDiv').hide();
  } else {
    $('#emailDiv').addClass('hidden');
    $('#usernameDiv').toggle();
    $('#passwordDiv').toggle();
    $('#resetText').text('forgot your username/password ?');
    $('#isLoggedBtn').text('Login');
    $('.message').html('');
    $('#passresetInpt').val(false);
    $('#accnttypeDiv').show();
  }
} // on_enter('loginForm', 'isLoggedBtn', true);