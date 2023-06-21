"use strict"; // ************************** General Functions

function alert_msg(msg) {
  var output = '';
  output += '<div class="alert alt_alert_warning" role="alert">'; // output += '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp; ';

  output += msg + '</div>';
  return output;
}

function success_msg(msg) {
  var output = '';
  output += '<div class="alert alt_alert_success" role="alert">';
  output += msg + '</div>';
  return output;
}
/* options| primary, secondary, info, danger, warning, success */
function message_alert(msg, type) {
  return '<div class="alert alt_alert_' + type + '" role="alert">' + msg + '</div>';
}

function data_err(data, id) {
  err_data = data.error;

  if (is_json_string(err_data)) {
    $.each(err_data, function (index, value) {
      $.each(value, function (ind, val) {
        $('#' + id).html(alert_msg(val));
      });
      console.log(index);
    });
  } else {
    console.log("there was an erro in JSON data");
  }
}

function validate_email(email) {
  var pattern = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
  return pattern.test(email);
}

function reloadWindow() {
  location.reload();
}

function requestModal(url, modal_id, data) {
  var form_type = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0; // console.log(modal_id);

  if (form_type == 1) {
    data = 'url=' + url + '&get_type=' + post_type[1] + '&token=' + token + '&' + data;
    console.log(data);
  } else {
    data = Object.assign({
      'url': url,
      'get_type': post_type[1],
      'token': token
    }, data);
  }

  console.log('url=' + url + '&get_type=' + post_type[1] + '&token=' + token);
  $.ajax({
    url: url,
    data: data,
    method: "POST",
    success: function success(data) {
      // console.log(data);
      $('#modalDiv').html(data);
      $('#' + modal_id).modal('toggle');
    },
    error: function error() {
      alert('error!');
    }
  });
}

function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);

  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else {
    begin += 2;
    var end = document.cookie.indexOf(";", begin);

    if (end == -1) {
      end = dc.length;
    }
  }

  return decodeURI(dc.substring(begin + prefix.length, end));
}

function cookieAction(name) {
  var temp = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var myCookie = getCookie(name);

  if (myCookie == null && temp == false) {
    var date = new Date();
    var minutes = 30;
    date.setTime(date.getTime() + minutes * 60 * 1000);
    $.cookie(name, 'true', {
      expires: 20 * 365
    });
  } else {
    $.cookie(name, 'true');
  }
}

function closeModalByID(id) {
  $('#' + id).modal('hide');
  setTimeout(function () {
    $('#' + id).remove();
    $('.script').remove();
  }, 200);
  $('.modal-backdrop').remove();
}

function window_load(res_id) {
  $("#" + res_id).load(location.href + " #" + res_id);
}

function on_enter(click, trigger) {
  $('#' + click).bind('keypress', function (e) {
    if (e.which == 13) {
      e.preventDefault;
      $('#' + trigger).trigger('click');
    }
  });
}

function imgUploadClick(trigerDiv) {
  $('#' + trigerDiv)[0].click();
}

function is_json_string(data) {
  try {
    JSON.parse(data);
    return true;
  } catch (e) {
    return false;
  }
} // ************************** Post Functions

function postCheck(htmlid, data) {
  var url_val = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
  var form_data_serialise = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
  var check_hash = htmlid.startsWith('#') ? true : false;
  var check_dots = htmlid.startsWith('.') ? true : false;
  var html_id_elem = check_hash || check_dots ? $(htmlid) : $('#' + htmlid);
  return function (data) {
    var ret = false,
        alt_at_id = '';
    var data = form_data_serialise ? data + '&url=' + post_urls[url_val] + '&get_type=' + post_type[0] + '&token=' + token : Object.assign({
      'url': post_urls[url_val],
      'get_type': post_type[0],
      'token': token
    }, data);
    $.ajax({
      url: path_action,
      method: "POST",
      data: data,
      success: function success(data) {
        console.log(data);

        if (is_json_string(data)) {
          data = JSON.parse(data);
          alt_at_id = data.hasOwnProperty('alt_id') ? data.alt_id : '';

          if (data.hasOwnProperty('update')) {
            if (data.update) {
              window.update_sett = 0;
              window_load(htmlid);
            }
          }

          if (data.hasOwnProperty('data_append')) {
            var type = data.hasOwnProperty('data_append_type') ? data.data_append_type : 'input';
            data_res_append(data.data_append, type);
          }

          if (data.hasOwnProperty('alert')) {
            var alert_dta = {
              'modal_msg': data['message'],
              'modal_err': data['error'],
              'modal_type': 'alert',
              'url': post_modal[24]
            };
            requestModal(htmlid, post_modal[24], alert_dta);
          } else if (data.url == 'refresh') {
            if (data.success == true && data.message != '') {
              html_id_elem.html(success_msg(data.message));
            }

            if (data.hasOwnProperty('delayed')) {
              var period = data.hasOwnProperty('seconds') ? data.seconds : 1000;
              setTimeout(function () {
                location.reload();
              }, period);
            } else {
              location.reload();
            }
          } else if (data.url == 'remove') {
            htmlid = alt_at_id != '' ? alt_at_id : htmlid;
            html_id_elem.remove();
          } else if (data.url == 'append') {
            html_id_elem.append(data.message);
          } else if (data.hasOwnProperty('url') && data.url != '') {
            if (data.hasOwnProperty('delayed')) {
              if (data.success == true && data.message != '') {
                html_id_elem.html(success_msg(data.message));
              }

              var period = data.hasOwnProperty('seconds') ? data.seconds : 1000;
              setTimeout(function () {
                window.location.href = data.url;
              }, period);
            } else if (data.hasOwnProperty('new_tab')) {
              var win = window.open(data.url, '_blank');

              if (win) {
                //Browser has allowed it to be opened
                win.focus();
              } else {
                window.location.href = data.url; //Browser has blocked it
                // alert('Please allow popups for this website');
              }
            } else {
              window.location.href = data.url;
            }
          } else if (data.hasOwnProperty('form_check')) {
            if (data.error == true && data.hasOwnProperty('form_id')) {
              var form_input = data.hasOwnProperty('form_input') ? data.form_input : 'input';

              if (form_input != 'input') {
                $('#' + form_input).addClass('is-invalid');
              } else {
                $('#' + data.form_id).siblings(form_input).addClass('is-invalid');
              }

              $('#' + data.form_id).html(data.message);
              $('#' + data.form_id).addClass('invalid-feedback').removeClass('valid-feedback');
              $('#' + data.form_id).show();
            } else if (data.error == true) {
              html_id_elem.html(alert_msg(data.message));
            }
          } else if (data.success == true && (data.append == true || data.prepend == true)) {
            if (html_id_elem.is(':hidden')) {
              html_id_elem.show();
            }

            if (data.prepend == true) {
              if ($('#msg_div').length > 0) {
                var msg_div = $('#msg_div');
                var init_h = msg_div[0].scrollHeight;
                $(data.data).prependTo('#' + htmlid);
                var final_h = msg_div[0].scrollHeight;
                msg_div.scrollTop(final_h - init_h);
              } else {
                $(data.data).prependTo('#' + htmlid);
              }
            } else if (data.data != '') {
              html_id_elem.append(data.data);
            }
          } else if (data.success == true && data.message != '') {
            html_id_elem.html(success_msg(data.message));
            ret = true;

            if (data.hasOwnProperty('delayed')) {
              var period = data.hasOwnProperty('seconds') ? data.seconds : 15000;
              html_id_elem.delay(period).fadeOut();
            }
          } else if (data.success == false && data.error == false && data.message != '') {
            html_id_elem.html(data.message);
            ret = true;
          } else if (data.error == true) {
            if (_typeof(data.message) == 'object' && data.message !== null) {
              data_err(data.message, htmlid);
            } else {
              html_id_elem.show();
              html_id_elem.html(alert_msg(data.message));

              if (data.hasOwnProperty('delayed')) {
                var period = data.hasOwnProperty('seconds') ? data.seconds : 15000;
                html_id_elem.delay(period).fadeOut();
              }
            }
          } else if (data.hasOwnProperty('data') && data.data != '' || data.hasOwnProperty('data') && data.hasOwnProperty('data_allow')) {
            if (data.data == '') {
              html_id_elem.html('');
            } else {}

            html_id_elem.html(data.data);
          }

          if (data.hasOwnProperty('modal')) {
            var modal_act = data.modal;
            var modal_id = data.hasOwnProperty('modal_id') ? data.modal_id : '';

            if (modal_id != '' && modal_act == 'close') {
              closeModalByID(modal_id);
            }
          }

          if (data.hasOwnProperty('remove_class')) {
            data_res_remove_class(data.remove_class);
          }

          if (data.hasOwnProperty('add_class')) {
            data_res_add_class(data.add_class);
          }
        } else {
          // location.reload();
        }
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
        var modal_alert = $('#modal_alert_check');

        if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
          requestModal(post_modal[24], post_modal[24], {
            'modal_err': true,
            'modal_msg': err_message
          });
          modal_alert.val(1);
        } else {}
      }
    }); // return ret;
  }(data);
}

function postFile(htmlid, img_id, data) {
  var url_val = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;
  form_data = new FormData();
  form_data.append('url', post_urls[url_val]);
  form_data.append('token', token);
  form_data.append('get_type', post_type[0]);
  form_data.append('post_image', $("#" + img_id)[0].files[0]);
  $.ajax({
    url: path_action,
    method: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function success(data) {
      if (is_json_string(data)) {
        data = JSON.parse(data);
        console.log(data);

        if (data.success == true) {
          if (data.image != '') {
            console.log(data.image);
            $('.image').src = data.image;
            $('.image').prop('src', data.image);
          }
        } else {}
      } else {
        console.log(data);
      }
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
      var modal_alert = $('#modal_alert_check');
      if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
        requestModal(post_modal[24], post_modal[24], {
          'modal_err': true,
          'modal_msg': err_message
        });
        modal_alert.val(1);
      } else {}
    }
  });
}

function postFile3(htmlid, form_id) {
  var url_val = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
  var alt_id = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : ''; // form_data = new FormData();

  var form_data = new FormData($('#' + form_id)[0]);
  var src = '.image';
  form_data.append('url', post_urls[url_val]);
  form_data.append('token', token);
  form_data.append('get_type', post_type[0]); 
  // form_data.append('post_image', $("#"+img_id)[0].files[0]);

  $.ajax({
    url: path_action,
    method: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function success(data) {
      if (is_json_string(data)) {
        data = JSON.parse(data);
        console.log(data);

        if (data.update) {
          window.update_sett = 0;
          $('#imgs_container').html(data.image);
        }

        if (data.success == true) {
          if (data.image != '') {
            console.log(data.image);

            if (htmlid != '') {
              src = '#' + htmlid + src;
            }

            $('.image').src = data.image;
            console.log(src);
            $(src).prop('src', data.image);
          }

          if (data.data != '') {
            console.log(data.data);
            $(alt_id).val(data.data);
          }
        } else {}
      } else {
        console.log(data);
      }
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
          var modal_alert = $('#modal_alert_check');
          if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
            requestModal(post_modal[24], post_modal[24], {
              'modal_err': true,
              'modal_msg': err_message
            });
            modal_alert.val(1);
          } else {}
    }
  });
}

function postFile4(htmlid, form_id) {
  var msg_div = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : ''; 
  var url_val = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;
  var alt_id  = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : ''; 
  
  var form_data = new FormData($('#' + form_id)[0]);
  
  var src = '.image';
  form_data.append('url', post_urls[url_val]);
  form_data.append('token', token);
  form_data.append('get_type', post_type[0]); 

  console.log(form_data);

  var check_hash    = msg_div.startsWith('#') ? true : false;
  var check_dots    = msg_div.startsWith('.') ? true : false;
  var html_id_elem  = check_hash || check_dots ? $(msg_div) : $('#' + msg_div);

  $.ajax({
    url: path_action,
    method: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function success(data) {
      if (is_json_string(data)) {
        data = JSON.parse(data);
        console.log(data);

        if (data.update) {
          window.update_sett = 0;
          $('#imgs_container').html(data.image);
        }

        if (data.success == true) {
          if (data.image != '') {
            console.log(data.image);

            if (htmlid != '') {
              src = '#' + htmlid + src;
            }

            $('.image').src = data.image;
            console.log(src);
            $(src).prop('src', data.image);
          }

          if (data.data != '') {
            console.log(data.data);
            $(alt_id).val(data.data);
          }
        } else if (data.error == true) {
          if (_typeof(data.message) == 'object' && data.message !== null) {
            data_err(data.message, htmlid);
          } else {
            html_id_elem.show();
            html_id_elem.html(alert_msg(data.message));

            if (data.hasOwnProperty('delayed')) {
              var period = data.hasOwnProperty('seconds') ? data.seconds : 15000;
              html_id_elem.delay(period).fadeOut();
            }
          }
        }
      } else {
        console.log(data);
      }
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
      var modal_alert = $('#modal_alert_check');
      if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
        requestModal(post_modal[24], post_modal[24], {
          'modal_err': true,
          'modal_msg': err_message
        });
        modal_alert.val(1);
      }
    }
  });
}

function postFile2(alt_input, form_id) {
  var img_id = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
  var url_val = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;
  var form_data = new FormData($('#product_form_img')[0]); // form_data = new FormData($('#'+form_id)[0]);

  var src = '.image';
  form_data.append('url', post_urls[url_val]);
  form_data.append('token', token);
  form_data.append('get_type', post_type[0]); // form_data.append('product_images', $("#product_images")[0].files[0]);

  if (alt_input != '') {
    form_data.append(alt_input, $('#' + alt_input).val());
  }

  console.log(form_data);
  $.ajax({
    url: path_action,
    method: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function success(data) {
      if (is_json_string(data)) {
        data = JSON.parse(data);
        console.log(data);

        if (data.update) {
          window.update_sett = 0; // window_load('imgs_container');

          $('#imgs_container').html(data.image);
        }

        if (data.error == true) {
          $('.multi_img_msg').html(alert_msg(data.message));
        } else if (data.success == true) {
          if (data.image != '') {
            console.log(data.image);

            if (img_id != '') {
              src = '#' + img_id + src;
            }

            $('.image').src = data.image;
            $(src).prop('src', data.image);
          }
        } else {}
      } else {
        console.log(data);
      }
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
      var modal_alert = $('#modal_alert_check');
      if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
        requestModal(post_modal[24], post_modal[24], {
          'modal_err': true,
          'modal_msg': err_message
        });
        modal_alert.val(1);
      } else {}
    }
  });
}

function postonly(url, data) {
  var html_id = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "feedbackErrors";
  $('#' + html_id).html('');
  data = Object.assign({
    'url': post_urls[0],
    'get_type': post_type[0],
    'token': token
  }, data);
  console.log(data);
  $.ajax({
    url: post_urls[0],
    method: "POST",
    data: data,
    success: function success(data) {
      console.log(data);

      if (is_json_string(data)) {
        data = JSON.parse(data);

        if (data.url == 'refresh') {
          location.reload();
        } else if (data.url != '') {
          console.log(data.url);
          window.location.href = data.url;
        } else if (data.success == true) {
          $('#' + html_id).html(success_msg(data.message));
        } else if (data.error != '') {
          $('#' + html_id).html(alert_msg(data.message));
        }
      } else {
        console.log(data);
      }
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
    var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
    var modal_alert = $('#modal_alert_check');
    if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
      requestModal(post_modal[24], post_modal[24], {
        'modal_err': true,
        'modal_msg': err_message
      });
      modal_alert.val(1);
    } else {}
    }
  });
}

function post_return_data(url, res_id, data) {
  console.log(data);
  data = Object.assign({
    'get_type': post_type[0],
    'token': token,
    'url': url
  }, data);
  console.log(data);
  $.ajax({
    url: path_action,
    method: "POST",
    data: data,
    success: function success(data) {
      if (is_json_string(data)) {
        console.log(data);
        data = JSON.parse(data);

        if (data.data == 'remove') {
          if (res_id != '') {
            $('#' + res_id).remove();
          } else {}
        } else if (data.data == 'refresh') {
          $("#" + res_id).load(location.href + " #" + res_id);
        } else if (data.data = 'url' && data.data != '') {
          window.location.replace('admin/index.php?' + data.value);
        } else if (data.success) {
          // $('#'+res_id).html(success_msg(data.message));
          $('#modal-content').html(success_msg(data.message));
          $('#modalCenter').modal('toggle');
        } else if (data.error != '') {
          if (res_id != '') {
            $('#' + res_id).html(alert_msg(data.error));
          } else {}
        } else {// location.reload();
        }
      } else {
        if (res_id != '') {
          $('#' + res_id).html(data);
        } // location.reload();

      }
    },
    error: function error() {
      alert('error!');
      console.log(data);
    }
  });
}

function post_refresh_data(url, return_div, data) {
  data = Object.assign({
    'get_type': post_type[0],
    'token': token
  }, data);
  $.ajax({
    url: path_action,
    method: "POST",
    data: data,
    success: function success(data) {
      console.log(data);
      window_load(return_div);
    },
    error: function error() {
      alert('error!');
      console.log(data);
    }
  });
} // ADMIN USER Login MODAL

function admin_login(mrchnt_id, user_id, mrchnt_name) {
  var data = Object.assign(modal_data, {
    "url": post_urls[10],
    "user_id": user_id,
    "mrchnt_id": mrchnt_id,
    'mrchnt_name': mrchnt_name
  });
  console.log(data);
  $.ajax({
    url: path_modal,
    method: "POST",
    data: data,
    success: function success(data) {
      console.log(data);
      $('body').append(data);
      $('#admin_modal').modal('toggle');
    },
    error: function error(data) {
      console.log(data);
      alert('error!');
    }
  });
}

function doAnimations(elems) {
  var animEndEv = 'webkitAnimationEnd animationend';
  elems.each(function () {
    var $this = $(this),
        $animationType = $this.data('animation'); // Add animate.css classes to
    // the elements to be animated
    // Remove animate.css classes
    // once the animation event has ended

    $this.addClass($animationType).one(animEndEv, function () {
      $this.removeClass($animationType);
    });
  });
}

function surveySubmit(htmlid, survey_id) {
  var consent_check = $('#' + survey_id + '_consent').is(":checked");
  console.log(consent_check);

  if (consent_check) {
    data = $('#' + survey_id).serialize();
    data = data + '&' + post_data_default + '&survey_submission=' + true;
    var usg = $('input[name="gender_user"]:checked').val();
    var usr = $('input[name="gender_request"]:checked').val();
    data = data + '&gender_user=' + usg + '&gender_request=' + usr;
    console.log(data);
    $.ajax({
      url: path_action,
      method: "POST",
      data: data,
      success: function success(data) {
        console.log(data);

        if (is_json_string(data)) {
          data = JSON.parse(data);

          if (data.success == true && data.error == false) {
            $('#' + htmlid).html(success_msg(data.message));
            ret = true;

            if (data.url != '') {// location.reload();
            }
          } else if (data.error = true) {
            $('#' + htmlid).html(alert_msg(data.message));
          }
        } else {// location.reload();
        }
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
        var modal_alert = $('#modal_alert_check');
        if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
          requestModal(post_modal[24], post_modal[24], {
            'modal_err': true,
            'modal_msg': err_message
          });
          modal_alert.val(1);
        } else {}
      }
    });
  } else {
    $('#' + htmlid).html(alert_msg("Please check the consent checkbox below to submit the survey"));
  }
}

function changeURL(param) {
  var get_var = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'tab';
  var url = new URL(window.location.href);
  var query_string = url.search;
  var search_params = new URLSearchParams(query_string); // var tab_list   = ['survey', 'disclaimer', 'results'];

  search_params.set(get_var, param); // change the search property of the main url

  url.search = search_params.toString(); // the new url string

  var new_url = url.toString(); // location.replace(new_url);

  window.history.pushState("", "Title", new_url);
}

function modal_post() {
  $('#error_pop').html("");
  var content = encodeURIComponent(tinyMCE.get('mytextarea').getContent()); // content = {'content':content};
  // content = JSON.stringify(content);
  // var content =  tinymce.getContent('mytextarea');

  var data_1 = $('#article_form').serialize(),
      image = $('#product_image').val(),
      artcle = $('#article_id').length;
  data_2 = new FormData($('#article_form_img')[0]);
  data_1 = post_data_default + '&' + data_1;
  data_1 = data_1 + '&article_content=' + content; // add info to data_2

  console.log(data_1);
  data_2.append('token', token);
  data_2.append('get_type', post_type[0]);
  data_2.append('url', post_urls[0]);
  image = $('#product_id').length != 0 || image != '' || media != 0 && media != undefined ? 1 : 0;

  if (image) {
    $.ajax({
      url: path_action,
      method: 'post',
      data: data_1,
      success: function success(data) {
        if (is_json_string(data)) {
          data = JSON.parse(data);
          console.log(data);

          if (data.success == true && image == 1 || $('#product_id').length != 0) {
            $('#error_pop').html(success_msg(data.message));
            $.ajax({
              url: path_action,
              method: 'post',
              data: data_2,
              processData: false,
              contentType: false,
              success: function success(data) {
                console.log(data);

                if (is_json_string(data)) {
                  data = JSON.parse(data);

                  if (data.success == true) {
                    $('#error_pop').html(success_msg(data.message)); // location.reload();
                  } else if (data.error == true) {
                    $('#error_pop').html(alert_msg(data.message));
                  }
                } else {
                  console.log(data);
                }
              },
              error: function error() {
                alert("Something went wrong");
              }
            });
          } else if (image == 1) {
            if (data.success == true) {
              location.reload();
            } else if (data.error == true) {
              $('#error_pop').html(alert_msg(data.message));
            }
          } else if (data.error == true) {
            $('#error_pop').html(alert_msg(data.message));
          }
        } else {
          console.log(data);
        }
      },
      error: function error() {
        alert("Something went wrong");
      }
    });
  } else {
    $('#error_pop').html(alert_msg('Please upload an image before submitting the form'));
  }
}

function media_post() {
  $('#error_pop').html("");
  var data_2 = new FormData($('#product_form_img')[0]);
  var data_1 = $('#mediaForm').serialize(),
      image = $('#file_doc').val(),
      media = $('#media_id').length;
  data_1 = post_data_default + '&' + data_1; // add info to data_2

  console.log(data_2);
  data_2.append('token', token);
  data_2.append('get_type', post_type[0]);
  data_2.append('url', post_urls[0]);
  image = $('#media_id').length != 0 || image != '' || media != 0 && media != undefined ? 1 : 0;

  if (image) {
    $.ajax({
      url: path_action,
      method: 'post',
      data: data_1,
      success: function success(data) {
        if (is_json_string(data)) {
          data = JSON.parse(data);
          console.log(data);
          var img_file = $('#file_doc').val();

          if (data.success == true && image == 1 && img_file != 0 && img_file != undefined) {
            $('#error_pop').html(success_msg(data.message));
            $.ajax({
              url: path_action,
              method: 'post',
              data: data_2,
              processData: false,
              contentType: false,
              success: function success(data) {
                console.log(data);

                if (is_json_string(data)) {
                  data = JSON.parse(data);

                  if (data.success == true) {
                    $('#error_pop').html(success_msg(data.message));
                    reloadWindow();
                    console.log("andizi");
                  } else if (data.error == true) {
                    $('#error_pop').html(alert_msg(data.message));
                  }
                } else {
                  console.log(data);
                }
              },
              error: function error() {
                alert("Something went wrong");
              }
            });
          } else if (image == 1) {
            if (data.success == true && data.url == 'refresh') {
              reloadWindow();
            } else if (data.error == true) {
              $('#error_pop').html(alert_msg(data.message));
            }
          } else if (data.error == true) {
            $('#error_pop').html(alert_msg(data.message));
          }
        } else {
          console.log(data);
        }
      },
      error: function error() {
        alert("Something went wrong");
      }
    });
  } else {
    $('#error_pop').html(alert_msg('Please upload an image before submitting the form'));
  }
}

function post_comment(post_id, htmlid) {
  var type = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'comment';
  islogged = $('#islogged').val();

  if (islogged) {
    var form_id = type == 'comment' ? 'commentForm_' : 'commentReForm_';
    form_id = form_id + post_id;
    var data = $('#' + form_id).serialize();
    console.log(data);
    data = data + '&' + post_data_default;
    console.log(data);
    $.ajax({
      url: path_action,
      method: "POST",
      data: data,
      success: function success(data) {

        if (is_json_string(data)) {
          data = JSON.parse(data);

          if (data.success == true && data.error == false) {
            $('#' + htmlid).html(success_msg(data.message));
            ret = true;
            if (data.url != '') {
              window_load(data.url);
            }
          } else if (data.error = true) {
            $('#' + htmlid).html(alert_msg(data.message));
          }
        } else {// location.reload();
        }
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        var err_message = 'There was an error on your request ! : ' + XMLHttpRequest.statusText;
        var modal_alert = $('#modal_alert_check');
        if (modal_alert.length > 0 && parseInt(modal_alert.val()) == 0) {
          requestModal(post_modal[24], post_modal[24], {
            'modal_err': true,
            'modal_msg': err_message
          });
          modal_alert.val(1);
        } else {}
      }
    });
  } else {
    window.article_id = post_id;
    $('#message').html('');
    $('#modalComment').modal('toggle');
  }
}

function search_res() {
  search_text = $('#search_input').val();

  if (search_text == '') {
    $('.wrapper').toggleClass('animate');
  } else {
    window.location.href = 'search?search=' + search_text;
  }
}

function srolltodiv(div) {
  this.preventDefault;
  $('html, body').animate({
    scrollTop: $("#" + div).offset().top
  }, 1500);
}

function shift_upld_file(modal_id) {
  $('#file_uplod').html($('#file_upld_cntnr').html());
  // closeModalByID(modal_id);
}