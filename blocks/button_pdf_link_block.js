(function (blocks, element, editor, components) {
  const el = element.createElement;

  const { RichText, URLInputButton, InspectorControls } = editor;
  const { PanelBody } = components;

  const blockDir = `${myTheme.themeUrl}/blocks/`;

  blocks.registerBlockType("my-blocks/original-button-pdf-block", {
    title: "PDFボタンリンク",

    icon: "media-document",

    category: "original",

    description: "PDFファイル専用のボタンリンクです。",

    attributes: {
      linkUrl: { type: "string", default: "" },
      linkText: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { linkUrl, linkText } = attributes;

      return el(
        element.Fragment,
        null,

        // --- サイドバー ---
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "PDF設定", initialOpen: true },

            el("p", null, "PDFのURLを設定:"),
            el(URLInputButton, {
              url: linkUrl,
              onChange: (url) => setAttributes({ linkUrl: url }),
            }),
          ),
        ),

        // --- エディタ ---
        el(
          "div",
          { className: "original_button_link_block original_block is-pdf" },

          el(
            "p",
            {
              style: {
                fontSize: "12px",
                color: "#888",
                marginBottom: "6px",
              },
            },
            "※PDFリンクを設定してください",
          ),

          el(
            "div",
            { className: "button_preview is-pdf" },

            [
              el(RichText, {
                tagName: "span",
                value: linkText,
                placeholder: "ボタンテキストを入力",
                onChange: (value) => setAttributes({ linkText: value }),
                style: { color: "#fff" },
              }),

              el("span", {
                className: "mark",
                style: {
                  position: "absolute",
                  top: "50%",
                  right: "2vw",
                  transform: "translateY(-50%)",
                  width: "22px",
                  height: "22px",
                  background: `url(${blockDir}assets/img/pdf_icon_white.svg) no-repeat center / contain`,
                },
              }),
            ],
          ),
        ),
      );
    },

    save: (props) => {
      const { linkUrl, linkText } = props.attributes;

      return el(
        "div",
        { className: "original_button_link_block is-pdf" },

        el(
          "a",
          {
            href: linkUrl || "#",
            className: "button_link is-pdf",
            target: "_blank",
            rel: "noopener noreferrer",
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
