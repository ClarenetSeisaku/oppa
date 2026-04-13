document.addEventListener("DOMContentLoaded", () => {
  // js-accordion クラスを持つブロックをすべて取得
  const accordions = document.querySelectorAll(".js-accordion");

  accordions.forEach((accordion) => {
    const head = accordion.querySelector(".sidebar_block__head");
    const body = accordion.querySelector(".sidebar_block__body");
    const icon = head.querySelector(".icon");

    // 初期状態の設定（HTMLに 'is-open' クラスがなければ閉じた状態にする）
    if (!accordion.classList.contains("is-open")) {
      body.style.maxHeight = "0px";
      icon.textContent = "＋"; // アイコンをプラスに
    } else {
      // 最初から開いておく設定（HTML側に is-open クラスがある場合）
      body.style.maxHeight = body.scrollHeight + "px";
      icon.textContent = "－";
    }

    // ヘッダーがクリックされた時の処理
    head.addEventListener("click", () => {
      // is-open クラスの付け外し
      accordion.classList.toggle("is-open");

      if (accordion.classList.contains("is-open")) {
        // 開く処理：中身の実際の高さ（scrollHeight）を取得して設定
        body.style.maxHeight = body.scrollHeight + "px";
        icon.textContent = "－";
      } else {
        // 閉じる処理：高さを0にする
        body.style.maxHeight = "0px";
        icon.textContent = "＋";
      }
    });
  });
});
