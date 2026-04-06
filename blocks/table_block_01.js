(function (blocks, element, blockEditorOrEditor) {
  const el = element.createElement;

  // GutenbergのAPI両対応（wp.blockEditor または wp.editor）
  const editor = blockEditorOrEditor || window.wp.editor;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/table-block", {
    title: "テーブル_01",
    icon: "table-col-after",
    description: "各行に th（見出し）と td（内容）を持つテーブルブロックです。",
    category: "original",

    attributes: {
      rows: {
        type: "array",
        default: [{ header: "", content: "" }],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { rows } = attributes;

      // 行追加
      const addRow = () => {
        const newRows = [...rows, { header: "", content: "" }];
        setAttributes({ rows: newRows });
      };

      // 行削除
      const deleteRow = (index) => {
        const newRows = rows.filter((_, i) => i !== index);
        setAttributes({ rows: newRows });
      };

      // 各セル更新
      const updateRow = (index, field, value) => {
        const newRows = rows.map((row, i) => (i === index ? { ...row, [field]: value } : row));
        setAttributes({ rows: newRows });
      };

      return el("div", { className: "original_block", style: { margin: "40px 0" } }, [

        // テーブル要素
        el(
          "table",
          {
            className: "original_table_01",
            style: {
              width: "100%",
              borderCollapse: "collapse",
            },
          },
          el(
            "tbody",
            null,
            rows.map((row, index) =>
              el("tr", { key: index }, [
                // 見出しセル th
                el(
                  "th",
                  {
                    style: {
                      textAlign: "left",
                      borderTop: "1px solid #244C9C",
                      borderBottom: "1px solid #244C9C",
                      padding: "10px",
                      backgroundColor: "#F6F8FB",
                      width: "31.25%",
                    },
                  },
                  el(RichText, {
                    tagName: "span",
                    value: row.header,
                    onChange: (value) => updateRow(index, "header", value),
                    placeholder: "見出しを入力",
                  })
                ),

                // 内容セル td
                el(
                  "td",
                  {
                    style: {
                      position: "relative",
                      borderTop: "1px solid #D5DDE6",
                      borderBottom: "1px solid #D5DDE6",
                      padding: "10px",
                      width: "60%",
                    },
                  },
                  el(RichText, {
                    tagName: "span",
                    value: row.content,
                    onChange: (value) => updateRow(index, "content", value),
                    placeholder: "内容を入力",
                  }),
                  // 行削除ボタン
                  el(
                    "button",
                    {
                      type: "button",
                      onClick: () => deleteRow(index),
                      style: {
                        position: "absolute",
                        top: "50%",
                        right: "0",
                        transform: "translateY(-50%)",
                        backgroundColor: "#dc3545",
                        color: "white",
                        border: "none",
                        padding: "4px 8px",
                        borderRadius: "3px",
                        cursor: "pointer",
                      },
                    },
                    "✖"
                  )
                ),
              ])
            )
          )
        ),

        // 行追加ボタン
        el(
          "button",
          {
            type: "button",
            onClick: addRow,
            style: {
              marginTop: "10px",
              backgroundColor: "#007cba",
              color: "white",
              padding: "6px 12px",
              border: "none",
              borderRadius: "4px",
              cursor: "pointer",
            },
          },
          "＋ 行を追加"
        ),
      ]);
    },

    save: (props) => {
      const { attributes } = props;
      const { rows } = attributes;

      return el(
        "table",
        {
          className: "original_table_01 original_block",
        },
        el(
          "tbody",
          null,
          rows.map((row, index) =>
            el("tr", { key: index }, [
              el(
                "th",
                null,
                el(RichText.Content, {
                  tagName: "span",
                  value: row.header,
                })
              ),
              el(
                "td",
                null,
                el(RichText.Content, {
                  tagName: "span",
                  value: row.content,
                })
              ),
            ])
          )
        )
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
