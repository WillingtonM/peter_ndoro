"use strict";

var data = '',
    constant_data = {},
    mrchnt = 0;
var action_path = 'action/view/home?=';
var token = $('#token').val();
var post_type = ['action', 'modal'];
var post_urls = ['accounts', 'messages', 'images', 'files'];
var post_modal = ['login', 'media', 'article', 'academics', 'gallery', 'files', 'imgmodal', 'article_view', 'subscription', 'events', 'users', 'members', 'file_upload', 'service', 'modal_alert', 'video', 'appearance']; // var post_modal        = ['login','media','article', 'academics', 'gallery', 'files', 'imgmodal', 'article_view'];

var path_action = 'action/';
var path_modal = 'modal/';
var action_data = {
  'get_type': post_type[0],
  'token': token
};
var modal_data = {
  'get_type': post_type[1],
  'token': token
};
var post_data_default = 'url=' + post_urls[0] + '&get_type=' + post_type[0] + '&token=' + token;
var color_array = ['background: rgb(49, 62, 68, 1) !important', 'background: rgb(49, 62, 68, .8) !important', 'background: rgb(49, 62, 68, .6) !important'];
var window_width = window.innerWidth;
var window_height = window.innerHeight;
var practice_div = $('#practice').val(); // loader

$(window).on("load", function () {
  $(".loader-wrapper").fadeOut("slow");
  $('#container-1').css('opacity', 1);
  $(".loader-wrapper").remove();
});
$(document).ready(function () {
  // Navbar
  // check cookie
  // var cookie_res = getCookie('email_subscribe');
  // if (cookie_res != null) {
  //   // console.log(document.cookie);
  // } else {
  //   setTimeout( function() {
  //     $('#modalSubscribe').modal('toggle').fadeIn('5000');
  //   }, 1500);
  // }

  // $('.nav-item.dropdown > .nav-link').on('click', function () {
  //   window.location = $(this).attr('href');
  // });

  if (window_width <= 999) {
    $('#navbar').addClass('moved_bar');
  } // $.cookie('email_subscribe', 'true', { expires: -20*365 });
  // if ($('#site_type').length == 1) {
  //   $('a[href^="#"], a[href]:contains("#")').on('click', function (e) {
  //     e.preventDefault();
  //     var target = this.hash;
  //     var $target = $(target);
  //     $('html, body').animate({
  //       'scrollTop': $target.offset().top
  //     }, 1500, 'swing', function(){
  //       window.location.hash = target;
  //     })
  //   });
  // }


  var scrollTop = $(window).scrollTop();
  var elementOffset = $('#headnav').length > 0 ? $('#headnav').offset().top : 0; // var elementOffset = $('#headnav').offset().top;

  var distance = elementOffset - scrollTop;

  if (distance < 60 && window_width >= 991) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.slogan_card').addClass('slogan_card_sm');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
  } else if (window_width >= 991) {
    $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
    $('.name_ref').addClass('name_card').removeClass("name_card_small");
    $('.slogan_card').removeClass('slogan_card_sm');
  } else if (window_width) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.slogan_card').addClass('slogan_card_sm');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
  }

  if ($(window).scrollTop() > 60 && window_width >= 991) {
    $('#headnav').addClass('fixed-top').removeClass('topnavbar');
    $('.social_top').addClass('hidden');
    $('#navbarholder').addClass('media_navtop');
  } else if (window_width < 991) {
    $('#headnav').addClass('fixed-top').removeClass('topnavbar');
    $('.social_top').addClass('hidden');
    $('#navbarholder').addClass('media_navtop');
  }

  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 60 && window_width >= 991) {
      $('#navbar').addClass('moved_bar');
    } else if (window_width >= 991) {
      $('#navbar').removeClass('moved_bar');
    } else if (!$('#navbar').hasClass('moved_bar')) {
      $('#navbar').addClass('moved_bar');
    }

    if ($(window).scrollTop() > 60 && window_width >= 991) {
      $('#headnav').addClass('fixed-top').removeClass('topnavbar');
      $('.social_top').addClass('hidden');
      $('#navbarholder').addClass('media_navtop');
    } else if (window_width < 991) {
      $('#headnav').addClass('fixed-top').removeClass('topnavbar');
      $('.social_top').addClass('hidden');
      $('#navbarholder').addClass('media_navtop');
    }

    if ($(window).scrollTop() > 60 && window_width >= 991) {
      // $('#headnav').addClass('fixed-top').removeClass('topnavbar');
      $('.social_top').addClass('hidden');
      $('#navbarholder').addClass('media_navtop');
    } else if (window_width >= 991) {
      // $('#headnav').removeClass('fixed-top').addClass('topnavbar');
      $('.social_top').removeClass('hidden');
      $('#navbarholder').removeClass('media_navtop');
    }

    if ($(window).scrollTop() > 0 && window_width >= 991) {
      $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
      $('.slogan_card').addClass('slogan_card_sm');
      $('.name_ref').removeClass('name_card').addClass("name_card_small");
    } else if (window_width >= 991) {
      $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
      $('.name_ref').addClass('name_card').removeClass("name_card_small");
      $('.slogan_card').removeClass('slogan_card_sm');
    } else {
      $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
      $('.slogan_card').addClass('slogan_card_sm');
      $('.name_ref').removeClass('name_card').addClass("name_card_small");
    }
  });

  if (window_width <= 401) {
    $('#navbar-brand-img').hide();
    $('.name_ref').removeClass('name_card_main').addClass('name_card_main_left');
  } else {
    $('#navbar-brand-img').show();
    $('.name_ref').removeClass('name_card_main_left').addClass('name_card_main');
  }

  if (window_width <= 991) {
    $('.about_table').hide();
    $('.about_content').removeClass('col-10');
    $('.about_content').addClass('col-12');
    $('.about_main').show();
  } else {
    $('.about_table').show();
    $('.about_content').addClass('col-10');
    $('.about_content').removeClass('col-12');
    $('.about_main').hide();
    $('#' + practice_div).show();
  }

  if (window_width < 1270) {
    $('.dropdown-menu').removeClass('drop_menu');
  } else {
    $('.dropdown-menu').addClass('drop_menu');
  }

  $(".scroll-btn").click(function () {
    var id = $(this).attr('id');
    $('html, body').animate({
      scrollTop: $("#" + id + "-div").offset().top
    }, 2000);
  }); // Home page slider

  $('.carousel').carousel({
    interval: 10000,
    pause: "hover",
    touch: false,
    keyboard: false
  }); // Meet out team slider

  $('.carousel_slider').carousel({
    interval: 1000
  }); // Select the elements to be animated
  // in the first slide on page load

  var topLogoDiv = $('#top_logo_text_container').find('[data-animation ^= "animated"]');
  var $firstAnimatingElems = $('#carouselFade').find('.carousel-item:first').find('[data-animation ^= "animated"]'); // Apply the animation using the doAnimations()function

  doAnimations($firstAnimatingElems);
  $('#top_logo_text').hide();
  $('#carouselFade').on('slide.bs.carousel', function (e) {
    var curr = $(".active", e.target).index(); // Select the elements to be animated inside the active slide

    var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
    doAnimations($animatingElems);

    if (curr == 0) {
      $('#top_logo_text').show("drop", {
        direction: "down"
      }, 1000); // doAnimations(topLogoDiv);
    } else if (curr == 1) {// $('#top_logo_text').show(1000);
    } else if (curr == 2) {// $('#top_logo_text').show(1000);
    } else if (curr == 3) {// $('#top_logo_text').show(1000);
    } else if (curr == 4) {// $('#top_logo_text').show(1000);
    } else if (curr == 5) {
      $('#top_logo_text').hide("drop", {
        direction: "down"
      }, 1000);
    }
  }); // about animations

  var $firstAnimatingElems = $('#myTabContent').find('.tab-pane.active').find('[data-animation ^= "animated"]'); // Apply the animation using the doAnimations()function

  doAnimations($firstAnimatingElems);
  // $('#myTab').on('click', function (e) {
  //   var animelmnt = $("#myTabContent .active"); // Select the elements to be animated inside the active slide

  //   var $animatingElems = animelmnt.find("[data-animation ^= 'animated']");
  //   doAnimations($animatingElems);
  // });
  // $('#myTab a').on('click', function (e) {
  //   e.preventDefault();
  //   $(this).tab('show');
  // });

  if (window_width < 991) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
    $('.slogan_card').addClass('slogan_card_sm'); // $('#searchbar').removeClass('wrapper').addClass("wrapper_sm");
  } else {
    $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
    $('.name_ref').addClass('name_card').removeClass("name_card_small");
    $('.slogan_card').removeClass('slogan_card_sm'); // $('#searchbar').removeClass('wrapper_sm').addClass("wrapper");
  }

  $('#search_input').keypress(function (event) {
    var key = event.keyCode ? event.keyCode : event.which;

    if (key == 13) // the enter key code
      {
        $('.btn-area').click(); // return false;
      }
  }); // CKEditor

  $('#modalDiv').on('change', function (e) {
    if ($('#editor').length && $('#editor') != undefined) {
      ClassicEditor.create(document.querySelector('#editor')).then(function (editor) {// console.log( editor );
      })["catch"](function (error) {// console.error( error );
      });
    }
  });
  $(function ($) {
    $('#img_cspture').on('click', function (e) {
      e.preventDefault();
      $('#post_image')[0].click();
    });
    $('#post_image').on('change', function (e) {
      var file_data = new FormData();

      if ($('#post_image').val()) {
        $('.fa-camera.fa-3x').css('color', '#03556b');
        file_data.append('post_image', $("#post_image")[0].files[0]);
        file_data = $("#post_image")[0].files[0];
        postFile('account_message', 'post_image', file_data, 0);
      } else {
        $('#img_cspture').css('color', '');
      }
    });
  });

  if ($('#site_type').length == 0) {
    tinymce.init({
      selector: '#mytextarea',
      plugins: 'lists media table code image',
      toolbar: 'undo redo addcomment styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | showcomments casechange checklist code formatpainter pageembed permanentpen table image imagetools',
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Gracelin Baskaran',
      images_upload_url: action_path,
      images_upload_handler: function images_upload_handler(blobInfo, _success, failure) {
        var form_data = new FormData();
        form_data.append('file', blobInfo.blob(), blobInfo.filename());
        console.log(form_data);
        form_data.append('article_file', true);
        form_data.append('url', post_urls[0]);
        form_data.append('token', token);
        form_data.append('get_type', post_type[0]); // form_data.append('post_image', $("#"+img_id)[0].files[0]);

        console.log(form_data);
        $.ajax({
          url: path_action,
          method: "POST",
          data: form_data,
          processData: false,
          contentType: false,
          success: function success(data) {
            if (is_json_string(data)) {
              var data = JSON.parse(data);
              console.log(data);

              if (data.success) {
                _success(data.image);
              }
            } else {
              console.log(data);
            }
          },
          error: function error(XMLHttpRequest, textStatus, errorThrown) {
            alert('There was an error on your request ! : ' + XMLHttpRequest.statusText);
          }
        });
      }
    });
  }

  var Scrollbar = window.Scrollbar;
  var options = {
    'damping': 0.1
  }; // Scrollbar.init(document.querySelector('#body-div'), options);
});
$(window).resize(function () {
  window_width = window.innerWidth;
  var scrollTop = $(window).scrollTop();
  var elementOffset = $('#headnav').length > 0 ? $('#headnav').offset().top : 0; // var elementOffset = $('#headnav').offset().top;

  var distance = elementOffset - scrollTop;
  console.log(distance);

  if (distance < 60 && window_width >= 991) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.slogan_card').addClass('slogan_card_sm');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
    $('#navbar').addClass('moved_bar');
  } else if (window_width >= 991) {
    $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
    $('.name_ref').addClass('name_card').removeClass("name_card_small");
    $('.slogan_card').removeClass('slogan_card_sm');
    $('#navbar').removeClass('moved_bar');
  } else if (window_width) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.slogan_card').addClass('slogan_card_sm');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
    $('#navbar').addClass('moved_bar');
  }

  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 60 && window_width >= 991) {
      $('#navbar').addClass('moved_bar');
    } else if (window_width >= 991) {
      $('#navbar').removeClass('moved_bar');
    } else if (!$('#navbar').hasClass('moved_bar')) {
      $('#navbar').addClass('moved_bar');
    }

    if ($(window).scrollTop() > 60 && window_width >= 991) {
      // $('#headnav').addClass('fixed-top').removeClass('topnavbar');
      $('.social_top').addClass('hidden');
      $('#navbarholder').addClass('media_navtop');
    } else if (window_width >= 991) {
      // $('#headnav').removeClass('fixed-top').addClass('topnavbar');
      $('.social_top').removeClass('hidden');
      $('#navbarholder').removeClass('media_navtop');
    }

    if ($(window).scrollTop() > 0 && window_width >= 991) {
      $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
      $('.slogan_card').addClass('slogan_card_sm');
      $('.name_ref').removeClass('name_card').addClass("name_card_small");
      $('#navbar').addClass('moved_bar');
    } else if (window_width >= 991) {
      $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
      $('.name_ref').addClass('name_card').removeClass("name_card_small");
      $('.slogan_card').removeClass('slogan_card_sm');
      $('#navbar').removeClass('moved_bar');
    } else {
      $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
      $('.slogan_card').addClass('slogan_card_sm');
      $('.name_ref').removeClass('name_card').addClass("name_card_small");
      $('#navbar').addClass('moved_bar');
    }
  });

  if (window_width <= 401) {
    $('#navbar-brand-img').hide();
    $('.name_ref').removeClass('name_card_main').addClass('name_card_main_left');
  } else {
    $('#navbar-brand-img').show();
    $('.name_ref').removeClass('name_card_main_left').addClass('name_card_main');
  }

  if (window_width <= 991) {
    $('.about_table').hide();
    $('.about_content').removeClass('col-10');
    $('.about_content').addClass('col-12');
    $('.about_main').show();
  } else {
    $('.about_table').show();
    $('.about_content').addClass('col-10');
    $('.about_content').removeClass('col-12');
    $('.about_main').hide();
    $('#' + practice_div).show();
  }

  if (window_width < 991) {
    $('#navbar-brand-img').removeClass('brand-img').addClass('log-ease');
    $('.name_ref').removeClass('name_card').addClass("name_card_small");
    $('.slogan_card').addClass('slogan_card_sm'); // $('#searchbar').removeClass('wrapper').addClass("wrapper_sm");
    $('#navbar').addClass('moved_bar');

  } else {
    $('#navbar-brand-img').addClass('brand-img').removeClass('log-ease');
    $('.name_ref').addClass('name_card').removeClass("name_card_small");
    $('.slogan_card').removeClass('slogan_card_sm'); // $('#searchbar').removeClass('wrapper_sm').addClass("wrapper");
    $('#navbar').removeClass('moved_bar');
  }

  if (window_width < 1270) {
    $('.dropdown-menu').removeClass('drop_menu');
  } else {
    $('.dropdown-menu').addClass('drop_menu');
  }

  if (window_width < 840) {// console.log(window_width);
  } else {// $('#trln_text').show();
  } // console.log(window_width);

});
$(document).ready(function () {
  $('#product_image').change(function (e) {
    $('#form_img').submit();
    var files = $(this)[0].files; // console.log(files);

    if (files.length != 0) {
      var fileName = e.target.value.split('\\').pop();
      $('#label_span_1').text(fileName);
    }
  });
  $('#form_img').on('submit', function (e) {
    e.preventDefault();
    var data = new FormData($('#form_img')[0]);
    data.append('token', token);
    data.append('get_type', post_type[0]);
    data.append('url', post_urls[3]);
    $.ajax({
      url: path_action,
      method: 'POST',
      data: data,
      contentType: false,
      processData: false,
      success: function success(data) {
        data = JSON.parse(data);

        if (data.success == true) {
          window_load('form_img'); // $('#product_preview').html(data.data);
        } else {
          $('#modal_add_errors').html(alert_msg(data.error));
        }
      }
    });
  });
  var divHeight = $(".article_contents").height();
  $(".article_contents").mouseenter(function () {
    var artcl_id = $(this).prop('id');
    $('#' + artcl_id).addClass('article_contents_hov');
  }).mouseleave(function () {
    var artcl_id = $(this).prop('id');
    $('#' + artcl_id).removeClass('article_contents_hov');
  });
}); // var getWindowOptions = function() {
//   var width = 500;
//   var height = 350;
//   var left = (window.innerWidth / 2) - (width / 2);
//   var top = (window.innerHeight / 2) - (height / 2);
//   return [
//     'resizable,scrollbars,status',
//     'height=' + height,
//     'width=' + width,
//     'left=' + left,
//     'top=' + top,
//   ].join();
// };
// var twitterBtn = document.querySelector('.twitter-share-button');
// var text = encodeURIComponent($('#tweet_title').val());
// var shareUrl = 'https://twitter.com/intent/tweet?url=' + location.href + '&text=' + text;
// twitterBtn.href = shareUrl; // 1
//
// twitterBtn.addEventListener('click', function(e) {
//   e.preventDefault();
//   var win = window.open(shareUrl, 'ShareOnTwitter', getWindowOptions());
//   win.opener = null; // 2
// });

