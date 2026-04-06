(function (blocks, element, editor, components) {
  const el = element.createElement;

  const { RichText, URLInputButton, InspectorControls } = editor;

  const { PanelBody, ToggleControl } = components;

  const blockDir = `${myTheme.themeUrl}/blocks/`;

  blocks.registerBlockType("my-blocks/original-button-link-block", {
    title: "ボタンリンクブロック",

    icon: "button",

    category: "original",

    description: "任意のURLとテキストを設定できるボタンリンクブロックです。",

    attributes: {
      linkUrl: { type: "string", default: "" },

      linkText: { type: "string", default: "" },

      openInNewTab: { type: "boolean", default: false },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;

      const { linkUrl, linkText, openInNewTab } = attributes;

      return el(
        element.Fragment,

        null,

        // --- サイドバー設定 ---

        el(
          InspectorControls,

          null,

          el(
            PanelBody,

            { title: "リンク設定", initialOpen: true },

            el("p", null, "リンクURLを設定:"),

            el(URLInputButton, {
              url: linkUrl,

              onChange: (url) => setAttributes({ linkUrl: url }),
            }),

            el(ToggleControl, {
              className: "toggle_new_tab",

              label: "新しいタブで開く",

              checked: openInNewTab,

              onChange: (value) => setAttributes({ openInNewTab: value }),

              help: openInNewTab ? "リンクを新しいタブで開きます" : "リンクを同じタブで開きます",
            }),
          ),
        ),

        // --- エディタ表示部分 ---

        el(
          "div",

          { className: "original_button_link_block original_block" },

          // --- 説明文 ---

          el(
            "p",
            {
              style: {
                fontSize: "12px",

                color: "#888",

                marginBottom: "6px",
              },
            },
            "※リンクURLはサイドメニューから設定してください",
          ),

          el(
            "div",

            {
              className: "button_preview",

              // styleはblock_editor.cssに記述
            },

            [
              // テキスト編集

              el(RichText, {
                tagName: "span",

                value: linkText,

                placeholder: "ボタンテキストを入力",

                onChange: (value) => setAttributes({ linkText: value }),

                style: {
                  color: "#fff",
                },
              }),

              // 装飾マーク

              el("span", {
                className: "mark",

                style: {
                  position: "absolute",

                  top: "50%",

                  right: "2vw",

                  transform: "translateY(-50%)",

                  width: "22.5px",

                  height: "18px",

                  marginLeft: "6px",

                  background: `url(${blockDir}assets/img/simple_white_arrow.png) no-repeat center / cover`,
                },
              }),
            ],
          ),
        ),
      );
    },

    // --- 保存時 ---

    save: (props) => {
      const { linkUrl, linkText, openInNewTab } = props.attributes;

      const linkAttrs = { href: linkUrl || "#" };

      if (openInNewTab) {
        linkAttrs.target = "_blank";

        linkAttrs.rel = "noopener noreferrer";
      }

      return el(
        "div",

        { className: "original_button_link_block" },

        el(
          "a",

          linkAttrs,

          {
            className: "button_link",

            style: {
              position: "relative",

              display: "inline-block",

              minWidth: "395px",

              padding: "20px 100px",

              fontSize: "18px",

              fontWeight: "700",

              backgroundColor: "#0F478C",

              color: "#fff",

              textDecoration: "none",

              borderRadius: "70px",

              textAlign: "center",
            },
          },

          [
            el(RichText.Content, {
              tagName: "span",

              value: linkText,
            }),

            el("span", { className: "mark" }),
          ],
        ),
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor, window.wp.components);
