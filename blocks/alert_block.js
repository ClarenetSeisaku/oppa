(function (blocks, element, editor) {
  const el = element.createElement;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/alert-box", {
    title: "注意ボックス",
    icon: "warning",
    category: "original",

    attributes: {
      text: {
        type: "string",
        default: "",
      },
    },

    edit: ({ attributes, setAttributes }) => {
      return el(
        "div",
        { className: "alert_box" },

        el(RichText, {
          tagName: "p",
          value: attributes.text,
          placeholder: "テキストを入力してください",
          onChange: (value) => setAttributes({ text: value }),
        }),
      );
    },

    save: ({ attributes }) => {
      return el(
        "div",
        { className: "alert_box" },

        el(RichText.Content, {
          tagName: "p",
          value: attributes.text,
        }),
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
