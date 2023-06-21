"use strict";

function sidebarToggle() {
  if ($('.sidenav_toggle').length > 0) {
    $('#sidenav_wrapper').removeClass('sidenav_toggle');
    $('#body').removeClass('body_toggle');

    if (window_width >= 991) {
      document.getElementById("body").style.marginLeft = "250px";
    }

    postonly(path_action, {
      'window_resize': false
    });
    console.log("false");
  } else {
    $('#sidenav_wrapper').addClass('sidenav_toggle');
    $('#body').addClass('body_toggle'); // $('#body').css("margin-left", "75px");

    if (window_width >= 991) {
      document.getElementById("body").style.marginLeft = "75px";
    }

    postonly(path_action, {
      'window_resize': true
    });
  }
}