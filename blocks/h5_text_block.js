(function (blocks, element, editor) {
  const el = element.createElement;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/h5-text-block", {
    title: "見出し（h5）",
    icon: "editor-textcolor",
    category: "original",
    description: "見出し（h5）を入力できるブロックです。",

    attributes: {
      heading: {
        type: "string",
        source: "html",
        selector: "h5",
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { heading } = attributes;

      return el(
        "div",
        { className: "original_h5_text_block original_block", style: { border: "1px solid #ddd" } },
        [
          el(RichText, {
            tagName: "h5",
            placeholder: "見出しを入力",
            value: heading,
            onChange: (value) => setAttributes({ heading: value }),
            style: {
              color: "#000",
              fontSize: "20px",
              fontWeight: "700",
              marginBottom: "10px",
              paddingBottom: "5px",
              borderBottom: "1px solid #48A3C4"
            },
          }),
        ]
      );
    },

    save: (props) => {
      const { heading } = props.attributes;

      return el(
        "div",
        { className: "original_block original_h5_text_block" },
        [
          el(RichText.Content, { tagName: "h5", value: heading }),
        ]
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor
);
