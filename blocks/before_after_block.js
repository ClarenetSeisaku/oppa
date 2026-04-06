(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { MediaUpload, RichText } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/before-after-block", {
    title: "Before / After ブロック",
    icon: "image-flip-horizontal",
    category: "original",
    description: "改善前と改善後の画像・テキストを並べて表示します。",

    attributes: {
      beforeImageUrl: { type: "string", default: "" },
      beforeImageAlt: { type: "string", default: "" },
      beforeText: { type: "string", default: "" },
      afterImageUrl: { type: "string", default: "" },
      afterImageAlt: { type: "string", default: "" },
      afterText: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const {
        beforeImageUrl,
        beforeImageAlt,
        beforeText,
        afterImageUrl,
        afterImageAlt,
        afterText,
      } = attributes;

      // 画像選択処理
      const onSelectBeforeImage = (media) =>
        setAttributes({ beforeImageUrl: media.url, beforeImageAlt: media.alt });
      const onSelectAfterImage = (media) =>
        setAttributes({ afterImageUrl: media.url, afterImageAlt: media.alt });

      return el(
        "div",
        {
            className: "original_before_after_block original_block",
            // styleはblock_editor.cssに記述
        },
        [
          // --- 改善前 ---
          el(
            "div",
            { className: "before_box"},
            [
              el("p", { className: "before", style: { fontSize: "30px", fontWeight: "700", textAlign: "center", lineHeight: "120%" } }, "改善前"),

              el(MediaUpload, {
                onSelect: onSelectBeforeImage,
                allowedTypes: ["image"],
                render: ({ open }) =>
                  el(
                    "div",
                    {
                      onClick: open,
                      style: {
                        display: "flex",
                        cursor: "pointer",
                        justifyContent: "center",
                        border: "1px solid #ddd",
                      },
                    },
                    beforeImageUrl
                      ? el("img", {
                          src: beforeImageUrl,
                          alt: beforeImageAlt || "",
                          style: {
                            width: "100%",
                            objectFit: "cover",
                            aspectRatio: "688 / 458",
                          },
                        })
                      : el("span", null, "画像を選択")
                  ),
              }),

              el(RichText, {
                tagName: "p",
                className: "text",
                style: {
                    color: "#333",
                    fontWeight: "500"
                },
                placeholder: "改善前の説明を入力",
                value: beforeText,
                onChange: (value) => setAttributes({ beforeText: value }),
              }),
            ]
          ),

          // --- 改善後 ---
          el(
            "div",
            { className: "after_box" },
            [
              el("p", { className: "after", style: { color: "#0F478C", fontSize: "30px", fontWeight: "700", textAlign: "center", lineHeight: "120%" } }, "改善後"),

              el(MediaUpload, {
                onSelect: onSelectAfterImage,
                allowedTypes: ["image"],
                render: ({ open }) =>
                  el(
                    "div",
                    {
                      onClick: open,
                      style: {
                        display: "flex",
                        cursor: "pointer",
                        justifyContent: "center",
                        border: "1px solid #ddd",
                      },
                    },
                    afterImageUrl
                      ? el("img", {
                          src: afterImageUrl,
                          alt: afterImageAlt || "",
                          style: {
                            width: "100%",
                            objectFit: "cover",
                            aspectRatio: "688 / 458",
                          },
                        })
                      : el("span", null, "画像を選択")
                  ),
              }),

              el(RichText, {
                tagName: "p",
                className: "text",
                style: {
                    color: "#333",
                    fontWeight: "500"
                },
                placeholder: "改善後の説明を入力",
                value: afterText,
                onChange: (value) => setAttributes({ afterText: value }),
              }),
            ]
          ),
        ]
      );
    },

    save: (props) => {
      const {
        beforeImageUrl,
        beforeImageAlt,
        beforeText,
        afterImageUrl,
        afterImageAlt,
        afterText,
      } = props.attributes;

      return el(
        "div",
        { className: "original_block original_before_after_block" },
        [
          el("div", { className: "before_box" }, [
            el("p", { className: "before" }, "改善前"),
            beforeImageUrl &&
              el("img", { src: beforeImageUrl, alt: beforeImageAlt || "" }),
            el(RichText.Content, { tagName: "p", className: "text", value: beforeText }),
          ]),
          el("div", { className: "after_box" }, [
            el("p", { className: "after" }, "改善後"),
            afterImageUrl &&
              el("img", { src: afterImageUrl, alt: afterImageAlt || "" }),
            el(RichText.Content, { tagName: "p", className: "text", value: afterText }),
          ]),
        ]
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor,
  window.wp.components
);
