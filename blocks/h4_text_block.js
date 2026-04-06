(function (blocks, element, editor) {
  const el = element.createElement;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/h4-text-block", {
    title: "見出し（h4）",
    icon: "editor-textcolor",
    category: "original",
    description: "見出し（h4）を入力できるブロックです。",

    attributes: {
      heading: {
        type: "string",
        source: "html",
        selector: "h4",
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { heading } = attributes;

      return el(
        "div",
        { className: "original_h4_text_block original_block", style: { border: "1px solid #ddd" } },
        [
          el(RichText, {
            tagName: "h4",
            placeholder: "見出しを入力",
            value: heading,
            onChange: (value) => setAttributes({ heading: value }),
            style: {
              padding: "10px 20px",
              color: "#fff",
              background: "#244C9C",
              fontSize: "24px",
              fontWeight: "700",
              marginBottom: "10px",
            },
          }),
        ]
      );
    },

    save: (props) => {
      const { heading } = props.attributes;

      return el(
        "div",
        { className: "original_block original_h4_text_block" },
        [
          el(RichText.Content, { tagName: "h4", value: heading }),
        ]
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor
);