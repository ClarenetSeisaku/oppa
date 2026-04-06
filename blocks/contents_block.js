(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { MediaUpload, RichText } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/contents-block", {
    title: "コンテンツブロック（交互配置）",
    icon: "columns",
    category: "original",
    description: "画像とテキストを横並びで自由に追加。奇数は左画像、偶数は右画像になります。",

    attributes: {
      contents: {
        type: "array",
        default: [
          { imageUrl: "", imageAlt: "", text: "" },
        ],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { contents } = attributes;

      // 画像を選択
      const onSelectImage = (index, media) => {
        const newContents = contents.map((item, i) =>
          i === index
            ? { ...item, imageUrl: media.url, imageAlt: media.alt || "" }
            : item
        );
        setAttributes({ contents: newContents });
      };

      // テキスト更新
      const updateText = (index, value) => {
        const newContents = contents.map((item, i) =>
          i === index ? { ...item, text: value } : item
        );
        setAttributes({ contents: newContents });
      };

      // ボックス追加
      const addBox = () => {
        setAttributes({
          contents: [...contents, { imageUrl: "", imageAlt: "", text: "" }],
        });
      };

      // ボックス削除
      const deleteBox = (index) => {
        const newContents = contents.filter((_, i) => i !== index);
        setAttributes({ contents: newContents });
      };

      return el(
        "div",
        { className: "original_block original_contents_block", style: { display: "flex", flexDirection: "column" } },
        [
          ...contents.map((item, index) => {

            return el(
              "div",
              {
                className: "contents_box",
                key: index,
                //styleはblock_editor.cssに記述
              },
              [
                // 画像アップロード
                el(MediaUpload, {
                  onSelect: (media) => onSelectImage(index, media),
                  allowedTypes: ["image"],
                  render: ({ open }) =>
                    el(
                      "div",
                      {
                        onClick: open,
                        style: {
                          flex: "0 0 50%",
                          cursor: "pointer",
                          border: "1px solid #ccc",
                          background: "#fff",
                          display: "flex",
                          alignItems: "center",
                          justifyContent: "center",
                        },
                      },
                      item.imageUrl
                        ? el("img", {
                            src: item.imageUrl,
                            alt: item.imageAlt || "",
                            style: {
                              width: "100%",
                              aspectRatio: "556 / 370",
                              objectFit: "cover",
                            },
                          })
                        : el("span", null, "画像を選択")
                    ),
                }),

                // テキスト
                el(RichText, {
                  tagName: "p",
                  value: item.text,
                  onChange: (value) => updateText(index, value),
                  placeholder: "テキストを入力",
                  style: {
                    flex: "1",
                    widht: "50%",
                    fontSize: "16px",
                    fontWeight: "500",
                    color: "#333",
                  },
                }),

                // 削除ボタン
                el(
                  "button",
                  {
                    type: "button",
                    onClick: () => deleteBox(index),
                    style: {
                      position: "absolute",
                      top: "8px",
                      right: "8px",
                      backgroundColor: "#dc3545",
                      color: "white",
                      border: "none",
                      padding: "4px 8px",
                      borderRadius: "3px",
                      cursor: "pointer",
                    },
                  },
                  "✖"
                ),
              ]
            );
          }),

          // 追加ボタン
          el(
            Button,
            {
              isPrimary: true,
              onClick: addBox,
              style: { alignSelf: "center", marginTop: "20px" },
            },
            "＋ コンテンツを追加"
          ),
        ]
      );
    },

    save: (props) => {
      const { contents } = props.attributes;

      return el(
        "div",
        { className: "original_block original_contents_block" },
        contents.map((item, index) => {
          const isEven = (index + 1) % 2 === 0;

          return el(
            "div",
            { className: "contents_box", key: index },
            isEven
              ? [
                  el(RichText.Content, { tagName: "p", value: item.text }),
                  item.imageUrl &&
                    el("img", { src: item.imageUrl, alt: item.imageAlt || "" }),
                ]
              : [
                  item.imageUrl &&
                    el("img", { src: item.imageUrl, alt: item.imageAlt || "" }),
                  el(RichText.Content, { tagName: "p", value: item.text }),
                ]
          );
        })
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor,
  window.wp.components
);
