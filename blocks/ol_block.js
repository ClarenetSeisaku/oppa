(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/original-ol-block", {
    title: "番号付きリスト",
    icon: "editor-ol",
    category: "original",
    description: "番号付きリストを作成できます。",

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

      // 項目追加
      const addItem = () => {
        setAttributes({ items: [...items, { text: "" }] });
      };

      // 項目削除
      const deleteItem = (index) => {
        const newItems = items.filter((_, i) => i !== index);
        setAttributes({ items: newItems });
      };

      return el(
        "div",
        { className: "original_ol_block original_block" },
        [
          el(
            "ol",
            null,
            items.map((item, index) =>
              el(
                "li",
                { key: index, style: { marginBottom: "10px", position: "relative", listStyle: "none" } },
                [
                  el(
                    "span",
                    {
                      className: "num",
                      style: {
                        marginRight: "8px",
                        fontWeight: "500",
                      },
                    },
                    `${index + 1}.`
                  ),
                  el(RichText, {
                    tagName: "p",
                    placeholder: "リスト項目を入力",
                    value: item.text,
                    onChange: (value) => updateItem(index, value),
                    style: { display: "inline", margin: 0, fontWeight: "500" },
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
        { className: "original_ol_block original_block" },
        el(
          "ol",
          null,
          items.map((item, index) =>
            el(
              "li",
              { key: index },
              [
                el("span", { className: "num" }, `${index + 1}.`),
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
