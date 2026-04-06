(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { MediaUpload, InspectorControls } = editor;
  const { Button, PanelBody, TextControl } = components;

  blocks.registerBlockType("my-blocks/original-img-block", {
    title: "画像ブロック",
    icon: "format-image",
    category: "original",
    description: "メディアライブラリから画像を選択して表示するブロックです。",

    attributes: {
      imgUrl: { type: "string", default: "" },
      altText: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { imgUrl, altText } = attributes;

      return el(
        element.Fragment,
        null,

        // --- サイドバー設定 ---
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "画像設定", initialOpen: true },
            el(TextControl, {
              label: "代替テキスト（alt属性）",
              value: altText,
              onChange: (value) => setAttributes({ altText: value }),
              placeholder: "画像の説明を入力",
            })
          )
        ),

        // --- ブロック本体 ---
        el(
          "div",
          { className: "original._block original_img_block", style: { textAlign: "center" } },
          imgUrl
            ? el("img", { src: imgUrl, alt: altText })
            : el(
                MediaUpload,
                {
                  onSelect: (media) =>
                    setAttributes({
                      imgUrl: media.url,
                      altText: media.alt || "",
                    }),
                  allowedTypes: ["image"],
                  render: ({ open }) =>
                    el(
                      Button,
                      {
                        onClick: open,
                        variant: "primary",
                      },
                      "画像を選択"
                    ),
                }
              )
        )
      );
    },

    save: (props) => {
      const { imgUrl, altText } = props.attributes;
      return el(
        "div",
        { className: "original_block original_img_block" },
        el("img", { src: imgUrl || "", alt: altText || "" })
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor,
  window.wp.components
);
