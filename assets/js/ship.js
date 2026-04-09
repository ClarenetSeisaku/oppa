document.querySelectorAll(".js-youtube").forEach((el) => {
  el.addEventListener("click", function () {
    const id = this.dataset.id;

    this.classList.add("is-play"); // ← これ追加

    this.innerHTML = `
      <iframe 
        src="https://www.youtube.com/embed/${id}?autoplay=1"
        frameborder="0"
        allow="autoplay; encrypted-media"
        allowfullscreen
      ></iframe>
    `;
  });
});

//スクロールヒント
jQuery(document).ready(function ($) {
  new ScrollHint(".js-scrollable");
});
