(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/original-ul-block", {
    title: "順序無しリスト",
    icon: "editor-ul",
    category: "original",
    description: "順序無しリストを作成できます。",

    attributes: {
      items: {
        type: "array",
        default: [
          { text: "" },
        ],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { items } = attributes;

      // テキスト更新
      const updateItem = (index, value) => {
        const newItems = items.map((item, i) =>
          i === index ? { ...item, text: value } : item
        );
        setAttributes({ items: newItems });
      };

      // アイテム追加
      const addItem = () => {
        setAttributes({ items: [...items, { text: "" }] });
      };

      // アイテム削除
      const deleteItem = (index) => {
        const newItems = items.filter((_, i) => i !== index);
        setAttributes({ items: newItems });
      };

      return el(
        "div",
        { className: "original_ul_block original_block" },
        [
          el(
            "ul",
            null,
            items.map((item, index) =>
              el(
                "li",
                { key: index, style: { position: "relative", listStyle: "none", fontWeight: "500", color: "#333" } },
                [
                  el("span", { className: "mark", style: { display: "inline-block", width: "8px", height: "8px", background: "#48A3C4", borderRadius: "50%", marginRight: "8px" } }),
                  el(RichText, {
                    tagName: "p",
                    placeholder: "リスト項目を入力",
                    value: item.text,
                    onChange: (value) => updateItem(index, value),
                    style: { display: "inline", margin: 0 },
                  }),
                  el(
                    "button",
                    {
                      type: "button",
                      onClick: () => deleteItem(index),
                      style: {
                        marginLeft: "10px",
                        backgroundColor: "#dc3545",
                        color: "#fff",
                        border: "none",
                        borderRadius: "3px",
                        padding: "2px 6px",
                        cursor: "pointer",
                      },
                    },
                    "✖"
                  ),
                ]
              )
            )
          ),

          // 追加ボタン
          el(
            Button,
            {
              isPrimary: true,
              onClick: addItem,
              style: { marginTop: "15px" },
            },
            "＋ 項目を追加"
          ),
        ]
      );
    },

    save: (props) => {
      const { items } = props.attributes;

      return el(
        "div",
        { className: "original_ul_block original_block" },
        el(
          "ul",
          null,
          items.map((item, index) =>
            el(
              "li",
              { key: index },
              [
                el("span", { className: "mark" }),
                el(RichText.Content, { tagName: "p", value: item.text }),
              ]
            )
          )
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
