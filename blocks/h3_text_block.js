(function (blocks, element, editor) {
  const el = element.createElement;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/h3-text-block", {
    title: "見出し（h3）",
    icon: "editor-textcolor",
    category: "original",
    description: "見出し（h3）を入力できるブロックです。",

    attributes: {
      heading: {
        type: "string",
        source: "html",
        selector: "h3",
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { heading } = attributes;

      return el(
        "div",
        { className: "original_h3_text_block original_block", style: { border: "1px solid #ddd" } },
        [
          el(RichText, {
            tagName: "h3",
            placeholder: "見出しを入力",
            value: heading,
            onChange: (value) => setAttributes({ heading: value }),
            style: {
              color: "#0F478C",
              fontSize: "30px",
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
        { className: "original_block original_h3_text_block" },
        [
          el(RichText.Content, { tagName: "h3", value: heading }),
        ]
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor
);
