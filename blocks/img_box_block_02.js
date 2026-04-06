(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText, MediaUpload } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/img-box-block-02", {
    title: "タイトル＋画像＋テキスト",
    icon: "format-image",
    category: "original",
    description: "タイトル、画像、テキストを最大3つまで並べられるブロックです。",

    attributes: {
      boxes: {
        type: "array",
        default: [
          { title: "", imageUrl: "", imageAlt: "", text: "" },
        ],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { boxes } = attributes;

      // 画像アップロード処理
      const onSelectImage = (index, media) => {
        const newBoxes = boxes.map((box, i) =>
          i === index
            ? { ...box, imageUrl: media.url, imageAlt: media.alt }
            : box
        );
        setAttributes({ boxes: newBoxes });
      };

      // タイトル変更
      const updateTitle = (index, value) => {
        const newBoxes = boxes.map((box, i) =>
          i === index ? { ...box, title: value } : box
        );
        setAttributes({ boxes: newBoxes });
      };

      // テキスト変更
      const updateText = (index, value) => {
        const newBoxes = boxes.map((box, i) =>
          i === index ? { ...box, text: value } : box
        );
        setAttributes({ boxes: newBoxes });
      };

      // ボックス追加
      const addBox = () => {
        if (boxes.length < 3) {
          setAttributes({
            boxes: [...boxes, { title: "", imageUrl: "", imageAlt: "", text: "" }],
          });
        }
      };

      // ボックス削除
      const deleteBox = (index) => {
        const newBoxes = boxes.filter((_, i) => i !== index);
        setAttributes({ boxes: newBoxes });
      };

      return el(
        "div",
        {
          className: "original_img_container_02 original_block",
          style: {
            display: "flex",
            gap: "30px",
            flexWrap: "wrap",
          },
        },
        [
          ...boxes.map((box, index) =>
            el(
              "div",
              {
                className: "img_box",
                key: index,
                //styleはblock_editor.cssに記述
              },
              [
                // タイトル入力
                el(RichText, {
                  tagName: "h3",
                  placeholder: "タイトルを入力",
                  value: box.title,
                  onChange: (value) => updateTitle(index, value),
                  style: {
                    fontSize: "18px",
                    fontWeight: "700",
                    marginBottom: "15px",
                  },
                }),

                // 画像選択
                el(MediaUpload, {
                  onSelect: (media) => onSelectImage(index, media),
                  allowedTypes: ["image"],
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
                          border: "1px solid #ddd",
                        },
                      },
                      box.imageUrl
                        ? el("img", {
                            src: box.imageUrl,
                            alt: box.imageAlt || "",
                            style: {
                              width: "100%",
                              aspectRatio: "344 / 280",
                              objectFit: "cover",
                            },
                          })
                        : el("span", null, "画像を選択")
                    ),
                }),

                // テキスト入力
                el(RichText, {
                  tagName: "p",
                  placeholder: "テキストを入力",
                  value: box.text,
                  onChange: (value) => updateText(index, value),
                  style: {
                    marginTop: "15px",
                    marginBottom: "0px",
                    padding: "0 15px",
                    fontWeight: "400",
                    textAlign: "left",
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
                      top: "5px",
                      right: "5px",
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
            )
          ),

          // 追加ボタン（最大3つまで）
          boxes.length < 3 &&
            el(
              Button,
              {
                isPrimary: true,
                onClick: addBox,
                style: { alignSelf: "center", marginTop: "20px" },
              },
              "＋ ボックスを追加"
            ),
        ]
      );
    },

    save: (props) => {
      const { boxes } = props.attributes;

      return el(
        "div",
        { className: "original_img_container_02 original_block" },
        boxes.map((box, index) =>
          el(
            "div",
            { className: "img_box", key: index },
            [
              el(RichText.Content, { tagName: "h3", value: box.title }),
              box.imageUrl &&
                el("img", { src: box.imageUrl, alt: box.imageAlt || "" }),
              el(RichText.Content, { tagName: "p", value: box.text }),
            ]
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
