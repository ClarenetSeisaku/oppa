(function (blocks, element, editor) {
  const el = element.createElement;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/comment-block", {
    title: "担当者コメントまたはお客様の声",
    icon: "admin-comments",
    category: "original",
    description: "見出しとコメントテキストを入力できるブロックです。",

    attributes: {
      head: { type: "string", default: "" },
      comment: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { head, comment } = attributes;

      return el(
        "div",
        { className: "original_comment_block original_block", style: { background: "#F6F8FB", padding: "40px" } },
        [
          el(RichText, {
            tagName: "p",
            className: "head",
            style: { margin: "0px", color: "#0F478C", fontSize: "30px", fontWeight: "700" },
            placeholder: "担当者コメントまたはお客様の声",
            value: head,
            onChange: (value) => setAttributes({ head: value }),
          }),
          el(RichText, {
            tagName: "p",
            className: "comment",
            style: { fontWeight: "500", color: "#333" },
            placeholder: "コメントを入力",
            value: comment,
            onChange: (value) => setAttributes({ comment: value }),
          }),
        ]
      );
    },

    save: (props) => {
      const { head, comment } = props.attributes;

      return el(
        "div",
        { className: "original_block original_comment_block" },
        [
          el(RichText.Content, { tagName: "p", className: "head", value: head }),
          el(RichText.Content, { tagName: "p", className: "comment", value: comment }),
        ]
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
