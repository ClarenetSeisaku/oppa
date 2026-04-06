(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText, InspectorControls } = editor;
  const { Button, PanelBody, SelectControl } = components;
  const blockDir = `${myTheme.themeUrl}/blocks/`;

  blocks.registerBlockType("my-blocks/check-list-block", {
    title: "チェックマーク付きリスト",
    icon: "yes",
    category: "original",
    description: "チェックマーク付きのリストを作成します。",

    attributes: {
      items: {
        type: "array",
        default: [{ text: "" }],
      },
      pattern: {
        type: "string",
        default: "pattern1", // デフォルトはパターン1
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { items, pattern } = attributes;

      // パターンごとの設定
      const patternStyles = {
        pattern1: {
          borderColor: "#244C9C",
          checkImg: `${blockDir}assets/img/orange_check_mark.png`,
        },
        pattern2: {
          borderColor: "#48A3C4",
          checkImg: `${blockDir}assets/img/blue_check_mark.png`,
        },
        pattern3: {
          borderColor: "#FF4E0D",
          checkImg: `${blockDir}assets/img/orange_check_mark.png`, // オレンジチェック流用
        },
      };

      const currentStyle = patternStyles[pattern];

      // テキスト変更処理
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
        element.Fragment,
        null,

        // --- サイドバー設定 ---
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "パターン設定", initialOpen: true },
            el(SelectControl, {
              label: "デザインパターンを選択",
              value: pattern,
              options: [
                { label: "パターン1（ネイビー）", value: "pattern1" },
                { label: "パターン2（ブルー）", value: "pattern2" },
                { label: "パターン3（オレンジ）", value: "pattern3" },
              ],
              onChange: (value) => setAttributes({ pattern: value }),
            })
          )
        ),

        // --- メイン編集エリア ---
        el(
          "div",
          { className: `original_check_list_block original_block ${pattern}` },
          [
            el(
              "ul",
              {
                style: {
                  display: "flex",
                  flexDirection: "column",
                  gap: "20px",
                  border: `2px solid ${currentStyle.borderColor}`,
                  padding: "40px",
                },
              },
              items.map((item, index) =>
                el(
                  "li",
                  {
                    key: index,
                    style: {
                      display: "flex",
                      alignItems: "center",
                      gap: "10px",
                      width: "100%",
                      position: "relative",
                    },
                  },
                  [
                    el("span", {
                      className: "check_mark",
                      style: {
                        flexShrink: "0",
                        display: "inline-block",
                        width: "40px",
                        height: "40px",
                        background: `url(${currentStyle.checkImg}) no-repeat center / cover`,
                      },
                    }),
                    el(RichText, {
                      tagName: "p",
                      placeholder: "テキストを入力",
                      value: item.text,
                      onChange: (value) => updateItem(index, value),
                      style: {
                        flex: 1,
                        margin: 0,
                        width: "100%",
                        color: "#000",
                        fontSize: "24px",
                        fontWeight: 700,
                      },
                    }),
                    el(
                      "button",
                      {
                        type: "button",
                        onClick: () => deleteItem(index),
                        style: {
                          position: "absolute",
                          top: "0",
                          right: "-25px",
                          backgroundColor: "#dc3545",
                          color: "white",
                          border: "none",
                          padding: "2px 6px",
                          borderRadius: "3px",
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
        )
      );
    },

    // --- 保存時 ---
    save: (props) => {
      const { items, pattern } = props.attributes;

      // 保存時のクラス名をパターンごとに分ける
      let patternClass = "pattern_01";
      if (pattern === "pattern2") patternClass = "pattern_02";
      if (pattern === "pattern3") patternClass = "pattern_03";

      return el(
        "div",
        { className: `original_check_list_block original_block ${patternClass}` },
        el(
          "ul",
          null,
          items.map((item, index) =>
            el(
              "li",
              { key: index },
              [
                el("span", { className: "check_mark" }),
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
