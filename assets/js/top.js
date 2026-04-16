// ===============================
// MV 動画 再生 / 停止ボタン
// ===============================
document.addEventListener("DOMContentLoaded", function () {
  const video = document.getElementById("heroVideo");
  const stopBtn = document.getElementById("stopBtn");

  // 要素が存在しないページ対策
  if (!video || !stopBtn) return;

  stopBtn.addEventListener("click", function () {
    if (video.paused) {
      video.play();
      stopBtn.classList.remove("is-play");
    } else {
      video.pause();
      video.currentTime = 0;
      stopBtn.classList.add("is-play");
    }
  });
});

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
          adaptiveHeight: true,
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

// -----------------------------
// topics タブ切り替え
// -----------------------------
document.querySelectorAll(".top_topics__tab").forEach((tab) => {
  tab.addEventListener("click", () => {
    const slug = tab.dataset.slug;

    document.querySelectorAll(".top_topics__card").forEach((card) => {
      if (slug === "all" || card.classList.contains("cat-" + slug)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});
