(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText, MediaUpload, InspectorControls, URLInputButton } = editor;
  const { Button, PanelBody, ToggleControl } = components;

  blocks.registerBlockType("my-blocks/img-box-block", {
    title: "画像＋テキスト（リンク対応）",
    icon: "format-image",
    category: "original",
    description: "画像とテキストを最大3つまで並べられ、各ボックスにリンクを設定できます。",

    attributes: {
      boxes: {
        type: "array",
        default: [
          {
            imageUrl: "",
            imageAlt: "",
            text: "",
            linkUrl: "",
            openInNewTab: false,
          },
        ],
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { boxes } = attributes;

      const updateBoxes = (index, newBox) => {
        const newBoxes = boxes.map((box, i) => (i === index ? newBox : box));
        setAttributes({ boxes: newBoxes });
      };

      const onSelectImage = (index, media) => {
        updateBoxes(index, { ...boxes[index], imageUrl: media.url, imageAlt: media.alt });
      };

      const updateText = (index, value) => {
        updateBoxes(index, { ...boxes[index], text: value });
      };

      const addBox = () => {
        if (boxes.length < 3) {
          setAttributes({
            boxes: [
              ...boxes,
              {
                imageUrl: "",
                imageAlt: "",
                text: "",
                linkUrl: "",
                openInNewTab: false,
              },
            ],
          });
        }
      };

      const deleteBox = (index) => {
        setAttributes({ boxes: boxes.filter((_, i) => i !== index) });
      };

      return el(
        element.Fragment,
        null,

        // --- サイドバー設定 ---
        el(
          InspectorControls,
          null,
          boxes.map((box, index) =>
            el(
              PanelBody,
              {
                title: `ボックス ${index + 1} の設定`,
                initialOpen: false,
                key: index,
              },
              el("p", null, "リンクURLを設定"),
              el(URLInputButton, {
                url: box.linkUrl,
                onChange: (value) => {
                  updateBoxes(index, { ...box, linkUrl: value });
                },
              }),
              el(ToggleControl, {
                className: "toggle_new_tab",
                label: "新しいタブで開く",
                checked: box.openInNewTab,
                onChange: (value) => updateBoxes(index, { ...box, openInNewTab: value }),
              })
            )
          )
        ),

        // --- メインエディター表示 ---
        // --- 説明文 ---
        el("p", {
          style: {
            fontSize: "12px",
            color: "#888",
          }
        }, "※リンクURLはサイドメニューから設定してください"),
        el(
          "div",
          { className: "original_img_container original_block" },
          [
            ...boxes.map((box, index) =>
              el(
                "div",
                {
                  className: "img_box",
                  key: index,
                  style: { position: "relative" },
                },
                [
                  el(
                    "div",
                    { className: "img_link_wrapper" },
                    [
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

                      el(RichText, {
                        tagName: "p",
                        placeholder: "テキストを入力",
                        value: box.text,
                        onChange: (value) => updateText(index, value),
                        style: {
                          marginTop: "15px",
                          marginBottom: "0px",
                          padding: "0 15px",
                          fontWeight: "700",
                        },
                      }),
                    ]
                  ),

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
        )
      );
    },

    save: (props) => {
      const { boxes } = props.attributes;

      return el(
        "div",
        { className: "original_img_container original_block" },
        boxes.map((box, index) =>
          el(
            "div",
            { className: "img_box", key: index },
            el(
              box.linkUrl ? "a" : "div",
              box.linkUrl
                ? {
                    href: box.linkUrl,
                    target: box.openInNewTab ? "_blank" : undefined,
                    rel: box.openInNewTab ? "noopener noreferrer" : undefined,
                  }
                : {},
              [
                box.imageUrl &&
                  el("img", { src: box.imageUrl, alt: box.imageAlt || "" }),
                el(RichText.Content, { tagName: "p", value: box.text }),
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

