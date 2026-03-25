//アドレスバーがあっても高さ100vh
var height = window.innerHeight;
document.documentElement.style.setProperty("--vh", height / 100 + "px");

$(function () {
  //スクロール時に行う処理
  $(window).scroll(function () {
    //header CHANGE
    if ($(window).scrollTop() > 50) {
      $("body").addClass("change_height");
    } else {
      $("body").removeClass("change_height");
    }

    //header CHANGE
    if ($(window).scrollTop() > 100) {
      $(".fixed-btn").addClass("sp_flow_btn");
    } else {
      $(".fixed-btn").removeClass("sp_flow_btn");
    }

    //animate
    $(".animate").each(function () {
      var hit = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var wHeight = $(window).height();
      var customTop = 100;

      if (typeof $(this).data("animate") !== "undefined") {
        customTop = $(this).data("animate");
      }

      if (hit + customTop < wHeight + scroll) {
        $(this).addClass("is-active");
      }
    });
  });
});

//tab

/*   $('.tab-list-item').on('click', function() {
    $('.tab-list-item, .tab-contents-item').removeClass('active');
    $(this).addClass('active');
    var index = $('.tab-list-item').index(this);
    $('.tab-contents-item').eq(index).addClass('active');
  }); */

//header hamburger menu/WAI-ARIA

$(function () {
  //const headerBreadPoint = window.matchMedia('screen and (min-width: 992px)');

  const $hamburger = $("#js-hamburger");
  const $gnav = $("#globalnav");
  const $header = $("#header");

  $hamburger.on("click", function () {
    const expanded = jQuery(this).attr("aria-expanded");

    if (expanded === "false") {
      $(this).attr("aria-expanded", true).attr("aria-label", "メニューを閉じる");
      $gnav.attr("aria-hidden", false);

      if ($(window).width() < 769) {
        $gnav.slideDown();
      }

      $header.addClass("open");
    } else {
      $(this).attr("aria-expanded", false).attr("aria-label", "メニューを開く");
      $gnav.attr("aria-hidden", true);

      if ($(window).width() < 769) {
        $gnav.slideUp();
      }

      $header.removeClass("open");
    }
  });
});

//gnav accordion
$(function () {
  $(".gnav .haschild").click(function () {
    $(this).next().slideToggle(500);
    $(this).addClass("active");
    $(".gnav .haschild").not($(this)).next().slideUp(500);
    return false;
  });
});
$("#header .globalnav .gnav li a").on("click", function () {
  $("#header .hamburger").click();
});

//pagetop
$(document).ready(function () {
  $(".pageTop").hide();
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      $(".pageTop").fadeIn("fast");
    } else {
      $(".pageTop").fadeOut("fast");
    }
  });
});
