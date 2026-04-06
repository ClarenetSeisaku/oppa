(function (blocks, element, blockEditorOrEditor) {
  const el = element.createElement;
  const editor = blockEditorOrEditor || window.wp.editor;
  const { MediaUpload, RichText } = editor;
  const { Button } = wp.components;
  const blockDir = `${myTheme.themeUrl}/blocks/`;

  blocks.registerBlockType("my-blocks/flow-block", {
    title: "フローブロック",
    icon: "arrow-right-alt",
    category: "original",
    description: "画像とテキストを横並びで最大5ステップまで表示するフローブロックです。",

    attributes: {
      flows: {
        type: "array",
        default: [{ imageUrl: "", imageAlt: "", text: "" }],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { flows } = attributes;

      // flow追加（最大5つまで）
      const addFlow = () => {
        if (flows.length < 5) {
          setAttributes({
            flows: [...flows, { imageUrl: "", imageAlt: "", text: "" }],
          });
        } else {
          alert("フローボックスは最大5つまでです。");
        }
      };

      // flow削除
      const deleteFlow = (index) => {
        const newFlows = flows.filter((_, i) => i !== index);
        setAttributes({ flows: newFlows });
      };

      // flow更新
      const updateFlow = (index, field, value) => {
        const newFlows = flows.map((flow, i) =>
          i === index ? { ...flow, [field]: value } : flow
        );
        setAttributes({ flows: newFlows });
      };

      return el(
        "div",
        {
          className: "original_block original_flow_block"
          //styleはblock_editor.cssに記述
        },
        [
          // 各フローボックス
          ...flows.map((flow, index) =>
            el(
              "div",
              {
                className: "flow_box",
                key: index,
                //styleはblock_editor.cssに記述
              },
              [
                // 画像選択
                el(MediaUpload, {
                  onSelect: (media) => {
                    const newFlows = [...flows];
                    newFlows[index] = {
                      ...newFlows[index],
                      imageUrl: media.url,
                      imageAlt: media.alt || "",
                    };
                    setAttributes({ flows: newFlows });
                  },
                  type: "image",
                  render: ({ open }) =>
                    el(
                      "div",
                      {
                        onClick: open,
                        style: {
                          display: "flex",
                          justifyContent: "center",
                          cursor: "pointer",
                          textAlign: "center",
                          color: "#244C9C",
                          fontWeight: "700",
                          border: "1px solid #ddd",
                        },
                      },
                      flow.imageUrl
                        ? el("img", {
                            src: flow.imageUrl,
                            alt: flow.imageAlt,
                            style: {
                              width: "100%",
                              aspectRatio: "228 / 177",
                              objectFit: "cover",
                            },
                          })
                        : "画像を選択"
                    ),
                }),
                // テキスト入力
                el(RichText, {
                  tagName: "p",
                  style: { color: "#333", margin: "10px 10px 0", fontWeight: "500" },
                  value: flow.text,
                  onChange: (value) => updateFlow(index, "text", value),
                  placeholder: "説明テキストを入力",
                }),

                // 矢印構造（最後のボックス以外のみ）
                index < flows.length - 1 &&
                  el("span",
                    {
                      className: "flow_arrow",
                      style: {
                        //styleはblock_editor.cssに記述
                        background: `url(${blockDir}assets/img/blue_arrow.png) no-repeat center / cover`,
                      }
                    },
                  ),

                // 削除ボタン
                el(
                  "button",
                  {
                    type: "button",
                    onClick: () => deleteFlow(index),
                    style: {
                      position: "absolute",
                      top: "10px",
                      right: "10px",
                      backgroundColor: "#dc3545",
                      color: "#fff",
                      border: "none",
                      borderRadius: "3px",
                      cursor: "pointer",
                      padding: "4px 8px",
                    },
                  },
                  "✖"
                ),
              ]
            )
          ),

          // 追加ボタン（最後に配置）
          flows.length < 5 &&
            el(
              "button",
              {
                type: "button",
                onClick: addFlow,
                style: {
                  flex: "0 0 auto",
                  alignSelf: "center",
                  backgroundColor: "#007cba",
                  color: "white",
                  padding: "8px 14px",
                  border: "none",
                  borderRadius: "4px",
                  cursor: "pointer",
                  height: "fit-content",
                },
                disabled: flows.length >= 5,
              },
              "＋ フローボックスを追加"
            ),
        ]
      );
    },

    save: (props) => {
      const { flows } = props.attributes;

      return el(
        "div",
        { className: "original_block original_flow_block" },
        flows.map((flow, index) =>
          el(
            "div",
            { className: "flow_box", key: index },
            [
              flow.imageUrl &&
                el("img", { src: flow.imageUrl, alt: flow.imageAlt || "" }),
              el(RichText.Content, { tagName: "p", value: flow.text }),
              index < flows.length - 1 &&
                el("span", { className: "flow_arrow" },),
            ]
          )
        )
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
