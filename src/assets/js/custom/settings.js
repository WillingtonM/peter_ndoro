"use strict";

$(function ($) {
  $('#img_cspture').on('click', function (e) {
    e.preventDefault();
    $('#post_image')[0].click();
  });
  $('#post_image').on('change', function (e) {
    if ($('#post_image').val()) {
      $('.fa-camera.fa-3x').css('color', '#03556b');
      file_data = new FormData();
      file_data.append('post_image', $("#post_image")[0].files[0]);
      file_data = $("#post_image")[0].files[0];
      console.log(file_data);
      postFile('account_message', 'post_image', file_data, 10, 'img_cspture');
    } else {
      $('#img_cspture').css('color', '');
    }
  });
});
$(function ($) {
  $('#eshop_img_cspture').on('click', function (e) {
    e.preventDefault();
    $('#eshop_post_image')[0].click();
  });
  $('#eshop_post_image').on('change', function (e) {
    if ($('#eshop_post_image').val()) {
      $('.fa-camera.fa-3x').css('color', '#03556b');
      file_data = new FormData();
      file_data.append('eshop_post_image', $("#eshop_post_image")[0].files[0]);
      file_data = $("#eshop_post_image")[0].files[0];
      console.log(file_data);
      postFile('account_message', 'eshop_post_image', file_data, 10, 'eshop_img_cspture');
    } else {
      $('#eshop_img_cspture').css('color', '');
    }
  });
}); // merchant settings

$(document).ready(function () {
  $('#member').keyup(function () {
    $('#srch_res_here').html(''); // $('#srch_res_here').show();

    srch_val = $(this).val();
    var data = $('#user_srchForm').serialize();

    if (srch_val != '' && srch_val != null && srch_val.length >= 2) {
      postCheck('srch_res_here', data, 13, true);
    }
  });
}); // members

$('input[name="member"]').change(function () {
  var src_val = $('#member').val();
  var inp_val = $(this).val();
  var cat_val = $('#srch_res_here option').filter(function () {
    return this.value == inp_val;
  }).data('value');
  /* if value doesn't match an option, cat_val will be undefined*/

  window.location.href = './members?u=' + cat_val + '&s=' + src_val;
}); // trading settings

$(".hour_select").on('input', function () {
  var val = this.value;
  var day = this.id;
  var dta = $('#' + day).attr('data');

  if (val == '24-hours') {
    $('.enddt_' + dta).hide();
  } else {
    $('.enddt_' + dta).show();
  }
});
$('.trade_hours').on('change', function () {
  var hid = this.id;
  var hval = this.value;

  if ($('#' + hid + ':checked').length > 0) {
    $('#hlabel_' + hval).text('Open');
  } else {
    $('#hlabel_' + hval).text('Closed');
  }
});
$('.delivery_methods').on('change', function () {
  var hid = this.id;
  var hval = this.value;

  if ($('#' + hid + ':checked').length > 0) {
    $('#dlabel_' + hval).text('Active');
  } else {
    $('#dlabel_' + hval).text('Disabled');
  }
}); // mobile authentication

$('.login_auth').on('change', function () {
  var hid = this.id;
  var hval = this.value;
  var act_txt = $('#' + hid + ':checked').length > 0 ? 'Enabled' : 'Disabled';
  $('#alabel_' + hval).text(act_txt);
  postCheck('auth_message', {
    'form_type': 'mobile_activate_auth',
    'form_active': 'active'
  }, 10);
}); // buy button activation

$('.publish_button').on('change', function () {
  var hid = this.id;
  var hval = this.value;
  var act_txt = $('#' + hid + ':checked').length > 0 ? 'Enabled' : 'Disabled';
  $('#alabel_' + hval).text(act_txt);
  postCheck('auth_message', {
    'form_type': 'mobile_activate_auth',
    'form_active': 'active'
  }, 10);
  postCheck('buybtn_msg', {
    'form_type': 'publish_button',
    'publish_button': $('#publish_button:checked').length
  }, 14);
}); // check confirmation code text limit
// check confirmation code text limit

$(".limit_text").keyup(function () {
  var maxChars = 6;

  if ($(this).val().length > maxChars) {
    $(this).val($(this).val().substr(0, maxChars));
  }
}); // email confirmation

var email_confirm = $('#email_confirm').length > 0 ? $('#email_confirm').val() : '';
var constant_timer = 15;
var update_sett = 1;

if (email_confirm == 'unconfirmed') {
  var constant_update_settings = function constant_update_settings() {
    setTimeout(constant_update_settings, 1000);

    if (constant_timer === 3) {
      constant_timer = 16;
      var data = {
        'email_confirm': true,
        'form_type': 'check_email_confirmed'
      };
      postCheck('message', data, 10);
      clearTimeout(constant_update_settings);
    }

    constant_timer--;
  };

  if (update_sett == 1) {
    constant_update_settings();
  }
} // ************************ functions


function postAction(url, data, res_id) {
  $('#' + res_id).html('');
  $.ajax({
    url: url,
    data: data,
    method: 'POST',
    success: function success(data) {
      console.log(data);

      if (is_json_string(data)) {
        var data = JSON.parse(data);
        var errs = data.error.error;
        var len = Object.keys(errs).length;
        var output = '';

        if (len > 0 && len != undefined) {
          $.each(errs, function (error, er) {
            output += er + ' &nbsp | &nbsp ';
          });
          $('#' + res_id).html(alert_msg(output));
        }

        if (data.data == 'remove') {
          if (res_id != '') {
            $('#' + res_id).html('');
          }
        } else if (data.data != '') {
          if (res_id != '') {
            $('#' + res_id).html(success_msg(data.data));
            $("#btclist").load(location.href + " #btclist");
          }
        }
      } else {
        if (res_id != '') {
          $('#' + res_id).html(data);
        }
      }
    },
    error: function error() {
      alert('Wrong');
    }
  });
}