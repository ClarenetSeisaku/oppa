$(document).ready(function () {

  $(".top_topics__slider")
    .on("init afterChange", function () {
      $(this).find(".slick-slide").removeAttr("id");
    })
    .slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      variableWidth: true,
      prevArrow: $(".js-prev"),
      nextArrow: $(".js-next"),
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            variableWidth: false,
          },
        },
      ],
    });

});

// -----------------------------
// pickup slide（SPのみ slick）
// -----------------------------
var $slider = $(".top_seminars__cards");

function sliderToggle() {
  if (!$slider.length) return;

  if (window.innerWidth < 769) {
    if (!$slider.hasClass("slick-initialized")) {
      $slider
        .on("init afterChange", function () {
          $(this).find(".slick-slide").removeAttr("id");
        })
        .slick({
          slidesToShow: 1,
          arrows: true,
          dots: false,
          prevArrow: $(".seminars__js-prev"),
          nextArrow: $(".seminars__js-next"),
        });
    }
  } else {
    if ($slider.hasClass("slick-initialized")) {
      $slider.slick("unslick");
    }
  }
}

sliderToggle();

$(window).on("resize", function () {
  sliderToggle();
});

/* matchHeightで高さ調整 */
$(function () {
  $(".top_seminars__card-title").matchHeight();
});
