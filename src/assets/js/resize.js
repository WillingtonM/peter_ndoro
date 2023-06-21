"use strict";

if (window_width <= 401) {} else {}

if (window_width <= 576) {
  $('.sidenav').removeClass('mt-6').addClass('my-6');
  $('.footer').show();
  $('#nav_items').hide();

  if ($('#navbar_search_div').is(':hidden')) {
    console.log("hidden search");
    $('#navbar_search_div').show();
  }
} else {
  $('.sidenav').removeClass('my-6').addClass('mt-6');
  $('.footer').hide();
  $('#nav_items').show();
  $('#navbar_search_div').hide();
}

if (window_width <= 991) {
  $('#trln_text').hide();
  $('#alt_search_btn').show();
} else {
  $('#trln_text').show();
  $('#alt_search_btn').hide();
  $('#navbar_search_div').show();
} // resize


$(window).resize(function () {
  window_width = window.innerWidth;

  if (window_width <= 442) {} else {}

  if (window_width <= 576) {
    $('.sidenav').removeClass('mt-6').addClass('my-6');
    $('.footer').show();
    $('#nav_items').hide();

    if ($('#navbar_search_div').is(':hidden')) {
      console.log("hidden search");
      $('#navbar_search_div').show();
    }
  } else {
    $('.sidenav').removeClass('my-6').addClass('mt-6');
    $('.footer').hide();
    $('#nav_items').show();
    $('#navbar_search_div').hide();
  }

  if (window_width <= 840) {} else {}

  if (window_width <= 991) {
    $('#trln_text').hide();
    $('#alt_search_btn').show();
  } else {
    $('#trln_text').show();
    $('#alt_search_btn').hide();
    $('#navbar_search_div').show();
  }
}); // 

$('#alt_search_btn').click(function () {
  $('#alt_search_btn').hide();
  $('#navbar_search_div').show();

  if (window_width <= 991) {
    $('#nav_items').hide();
  } else {
    $('#nav_items').show();
  }

  $('#global_search_id').focus();
});
$("#global_search_id").focus(function () {
  if (window_width <= 576) {
    $('#navbar_search_div').show();
    $("#logo_container").hide();
  }
});
$('#navbar_search_div').focusout(function () {
  if (window_width <= 576) {
    $('#alt_search_btn').hide();
    $('#navbar_search_div').show();
    $('#navbar_search_div').show();
  } else if (window_width <= 991) {
    $('#alt_search_btn').show();
    $('#navbar_search_div').hide();
  } else {}

  $('#nav_items').show();
});