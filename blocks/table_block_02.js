(function (blocks, element, blockEditorOrEditor) {
  const el = element.createElement;

  // GutenbergのAPI両対応
  const editor = blockEditorOrEditor || window.wp.editor;
  const { RichText } = editor;

  blocks.registerBlockType("my-blocks/table-block-02", {
    title: "テーブル_02（2列）",
    icon: "table-col-after",
    description: "左右に2つのテーブルが並ぶブロックです。",
    category: "original",

    attributes: {
      leftRows: {
        type: "array",
        default: [{ header: "", content: "" }],
      },
      rightRows: {
        type: "array",
        default: [{ header: "", content: "" }],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { leftRows, rightRows } = attributes;

      // 行追加・削除・更新の共通関数
      const addRow = (side) => {
        const key = side === "left" ? "leftRows" : "rightRows";
        const newRows = [...attributes[key], { header: "", content: "" }];
        setAttributes({ [key]: newRows });
      };

      const deleteRow = (side, index) => {
        const key = side === "left" ? "leftRows" : "rightRows";
        const newRows = attributes[key].filter((_, i) => i !== index);
        setAttributes({ [key]: newRows });
      };

      const updateRow = (side, index, field, value) => {
        const key = side === "left" ? "leftRows" : "rightRows";
        const newRows = attributes[key].map((row, i) =>
          i === index ? { ...row, [field]: value } : row
        );
        setAttributes({ [key]: newRows });
      };

      // テーブル生成関数
      const renderTable = (side, rows) =>
        el(
          "div",
          {
            className: "table",
            style: {
              width: "50%",
              boxSizing: "border-box",
              padding: "0 30px 0 0",
            },
          },
          [
            el(
              "table",
              {
                className: "original_table_02",
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
                        onChange: (value) =>
                          updateRow(side, index, "header", value),
                        placeholder: "見出しを入力",
                      })
                    ),
                    el(
                      "td",
                      {
                        style: {
                          position: "relative",
                          borderTop: "1px solid #D5DDE6",
                          borderBottom: "1px solid #D5DDE6",
                          padding: "10px",
                          width: "68.75%",
                        },
                      },
                      el(RichText, {
                        tagName: "span",
                        value: row.content,
                        onChange: (value) =>
                          updateRow(side, index, "content", value),
                        placeholder: "内容を入力",
                      }),
                      el(
                        "button",
                        {
                          type: "button",
                          onClick: () => deleteRow(side, index),
                          style: {
                            position: "absolute",
                            top: "50%",
                            left: "calc(100% + 5px)",
                            transform: "translateY(-50%)",
                            backgroundColor: "#dc3545",
                            color: "white",
                            border: "none",
                            padding: "2px 6px",
                            borderRadius: "3px",
                            cursor: "pointer",
                            fontSize: "14px",
                          },
                        },
                        "✖"
                      )
                    ),
                  ])
                )
              )
            ),
            el(
              "button",
              {
                type: "button",
                onClick: () => addRow(side),
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
          ]
        );

      // 横並びレイアウト
      return el(
        "div",
        {
          className: "table_wrapper original_block",
          style: {
            display: "flex",
            justifyContent: "space-between",
            margin: "40px 0",
          },
        },
        [renderTable("left", leftRows), renderTable("right", rightRows)]
      );
    },

    save: (props) => {
      const { leftRows, rightRows } = props.attributes;

      const renderTable = (rows) =>
        el(
          "table",
          { className: "original_table_02" },
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

      return el("div", { className: "original_block original_table_02_wrapper" }, [
        el("div", { className: "table_left" }, renderTable(leftRows)),
        el("div", { className: "table_right" }, renderTable(rightRows)),
      ]);
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);