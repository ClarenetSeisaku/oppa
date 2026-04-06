(function (blocks, element, blockEditorOrEditor) {
  const el = element.createElement;
  const editor = blockEditorOrEditor || window.wp.editor;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/qanda-block", {
    title: "Q&Aブロック",
    icon: "editor-help",
    category: "original",
    description: "質問(Q)と回答(A)を複数追加できるブロックです。",

    attributes: {
      qandas: {
        type: "array",
        default: [
          { question: "", answer: "" },
        ],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { qandas } = attributes;

      // Q&A追加
      const addQanda = () => {
        const newQandas = [...qandas, { question: "", answer: "" }];
        setAttributes({ qandas: newQandas });
      };

      // Q&A削除
      const deleteQanda = (index) => {
        const newQandas = qandas.filter((_, i) => i !== index);
        setAttributes({ qandas: newQandas });
      };

      // 更新
      const updateQanda = (index, field, value) => {
        const newQandas = qandas.map((q, i) =>
          i === index ? { ...q, [field]: value } : q
        );
        setAttributes({ qandas: newQandas });
      };

      return el(
        "div",
        { className: "original_qanda_block original_block" },
        [

          // 各Q&Aボックス
          qandas.map((qanda, index) =>
            el(
              "div",
              {
                className: "qanda_box",
                key: index,
                style: {
                  border: "1px solid #ddd",
                  padding: "10px 15px 0",
                  marginBottom: "15px",
                  position: "relative",
                },
              },
              [
                el(
                  "h3",
                  {
                    style: {
                        display: "flex",
                        padding: "7px 20px",
                        background: "#F6F8FB",
                    }
                  },
                  null,
                  el("span", { className: "q_mark", style: { fontFamily: "Inter, sans-serif", fontWeight: "bold", color: "#244C9C" } }, "Q."),
                  el(RichText, {
                    tagName: "span",
                    value: qanda.question,
                    onChange: (value) => updateQanda(index, "question", value),
                    placeholder: "質問を入力",
                    style: { width: "100%", marginLeft: "8px" },
                  })
                ),
                el(RichText, {
                  tagName: "p",
                  value: qanda.answer,
                  onChange: (value) => updateQanda(index, "answer", value),
                  placeholder: "回答を入力",
                  style: { marginTop: "5px", fontWeight: "500", color: "#333", },
                }),
                el(
                  "button",
                  {
                    type: "button",
                    onClick: () => deleteQanda(index),
                    style: {
                      position: "absolute",
                      top: "8px",
                      right: "8px",
                      backgroundColor: "#dc3545",
                      color: "#fff",
                      border: "none",
                      borderRadius: "3px",
                      cursor: "pointer",
                      padding: "2px 8px",
                    },
                  },
                  "✖"
                ),
              ]
            )
          ),

          // 追加ボタン
          el(
            "button",
            {
              type: "button",
              onClick: addQanda,
              style: {
                backgroundColor: "#007cba",
                color: "white",
                padding: "6px 12px",
                border: "none",
                borderRadius: "4px",
                cursor: "pointer",
              },
            },
            "＋ Q&Aを追加"
          ),
        ]
      );
    },

    save: (props) => {
      const { attributes } = props;
      const { qandas } = attributes;

      return el(
        "div",
        { className: "original_qanda_block original_block" },
        qandas.map((qanda, index) =>
          el(
            "div",
            { className: "qanda_box", key: index },
            [
              el(
                "h3",
                null,
                el("span", {className: "q_mark"}, null, "Q."),
                el(RichText.Content, {
                  tagName: "span",
                  value: qanda.question,
                })
              ),
              el(RichText.Content, {
                tagName: "p",
                value: qanda.answer,
              }),
            ]
          )
        )
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
