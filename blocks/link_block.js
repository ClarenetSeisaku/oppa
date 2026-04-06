(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { Fragment } = element;
  const { RichText, URLInputButton, InspectorControls } = editor;
  const { PanelBody, ToggleControl } = components;
  const blockDir = `${myTheme.themeUrl}/blocks/`;

  blocks.registerBlockType("my-blocks/original-link-block", {
    title: "リンクブロック",
    icon: "admin-links",
    category: "original",
    description: "リンク先URLとテキストを設定できるブロックです。",

    attributes: {
      linkText: { type: "string", default: "" },
      linkUrl: { type: "string", default: "" },
      openInNewTab: { type: "boolean", default: false },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { linkText, linkUrl, openInNewTab } = attributes;

      return el(
        Fragment,
        null,

        // サイドバー（URL設定）
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "リンク設定", initialOpen: true },
            el("p", { style: { marginBottom: "20px" } }, "リンクURLを設定:"),
            el(URLInputButton, {
              url: linkUrl,
              onChange: (url) => setAttributes({ linkUrl: url }),
            }),
            el(ToggleControl, {
              className: "toggle_new_tab",
              label: "新しいタブで開く",
              checked: openInNewTab,
              onChange: (value) => setAttributes({ openInNewTab: value }),
              help: openInNewTab
                ? "リンクを新しいタブで開きます"
                : "リンクを同じタブで開きます",
            })
          )
        ),

        // ブロック本体
        el(
          "div",
          { className: "original_link_block" },
          // --- 説明文 ---
          el("p", {
            style: {
              fontSize: "12px",
              color: "#888",
            }
          }, "※リンクURLはサイドメニューから設定してください"),
          el(
            "p",
            {
                style: {
                    display: "flex",
                    alignItems: "center"
                }
            },
            el(RichText, {
              tagName: "span",
              className: "editable-link-text",
              value: linkText,
              onChange: (value) => setAttributes({ linkText: value }),
              placeholder: "リンクテキストを入力",
              style: {
                color: "#0F478C",
                fontWeight: "500",
                textDecoration: "underline",
                textUnderlineOffset: "8px",
                textDecorationThickness: "7%",
                cursor: "text",
              },
            }),
            el("span", {
              className: "mark",
              style: {
                width: "14px",
                height: "11px",
                marginLeft: "6px",
                background: `url(${blockDir}assets/img/simple_blue_arrow.png) no-repeat center / cover`,
                verticalAlign: "middle",
              },
            })
          )
        )
      );
    },

    save: (props) => {
      const { linkText, linkUrl, openInNewTab } = props.attributes;

      const linkAttrs = { href: linkUrl || "#" };
      if (openInNewTab) {
        linkAttrs.target = "_blank";
        linkAttrs.rel = "noopener noreferrer";
      }

      return el(
        "div",
        { className: "original_link_block" },
        el(
          "p",
          null,
          el("a", linkAttrs, linkText),
          el("span", { className: "mark" })
        )
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor,
  window.wp.components
);

