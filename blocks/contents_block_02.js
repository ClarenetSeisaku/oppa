(function (blocks, element, editor, components) {
  const el = element.createElement;
  const { RichText, MediaUpload } = editor;
  const { Button } = components;

  blocks.registerBlockType("my-blocks/original-contents-block-02", {
    title: "コンテンツブロック_02",
    icon: "columns",
    category: "original",
    description: "左右にタイトル・テキスト・画像を配置するブロックです。",

    attributes: {
      leftTitle: { type: "string", default: "" },
      leftText: { type: "string", default: "" },
      leftImageUrl: { type: "string", default: "" },
      leftImageAlt: { type: "string", default: "" },

      rightTitle: { type: "string", default: "" },
      rightText: { type: "string", default: "" },
      rightImageUrl: { type: "string", default: "" },
      rightImageAlt: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const {
        leftTitle,
        leftText,
        leftImageUrl,
        leftImageAlt,
        rightTitle,
        rightText,
        rightImageUrl,
        rightImageAlt,
      } = attributes;

      const onSelectImage = (side, media) => {
        setAttributes({
          [`${side}ImageUrl`]: media.url,
          [`${side}ImageAlt`]: media.alt,
        });
      };

      return el(
        "div",
        {
          className: "original_block original_contents_block_02",
          style: {
            display: "flex",
            gap: "40px",
            flexWrap: "wrap",
            border: "1px solid #ddd",
            padding: "20px",
          },
        },
        [
          // 左コンテンツ
          el(
            "div",
            {
              className: "left_contents contents",
              style: { flex: "1", minWidth: "300px" },
            },
            [
              el(RichText, {
                tagName: "h3",
                placeholder: "左タイトルを入力",
                style: {
                    textAlign: "center",
                },
                value: leftTitle,
                onChange: (value) => setAttributes({ leftTitle: value }),
              }),
              el(RichText, {
                tagName: "p",
                placeholder: "左テキストを入力",
                value: leftText,
                style: {
                    textAlign: "center",
                    color: "#333",
                    fontWeight: "500",
                },
                onChange: (value) => setAttributes({ leftText: value }),
              }),
              el(MediaUpload, {
                onSelect: (media) => onSelectImage("left", media),
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
                        border: "1px solid #ddd"
                      },
                    },
                    leftImageUrl
                      ? el("img", {
                          src: leftImageUrl,
                          alt: leftImageAlt || "",
                          style: {
                            width: "100%",
                            aspectRatio: "556 / 370",
                            objectFit: "cover",
                          },
                        })
                      : el("span", null, "左画像を選択")
                  ),
              }),
            ]
          ),

          // 右コンテンツ
          el(
            "div",
            {
              className: "right_contents contents",
              style: { flex: "1", minWidth: "300px" },
            },
            [
              el(RichText, {
                tagName: "h3",
                placeholder: "右タイトルを入力",
                style: {
                    textAlign: "center",
                },
                value: rightTitle,
                onChange: (value) => setAttributes({ rightTitle: value }),
              }),
              el(RichText, {
                tagName: "p",
                placeholder: "右テキストを入力",
                style: {
                    textAlign: "center",
                    color: "#333",
                    fontWeight: "500",
                },
                value: rightText,
                onChange: (value) => setAttributes({ rightText: value }),
              }),
              el(MediaUpload, {
                onSelect: (media) => onSelectImage("right", media),
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
                        border: "1px solid #ddd"
                      },
                    },
                    rightImageUrl
                      ? el("img", {
                          src: rightImageUrl,
                          alt: rightImageAlt || "",
                          style: {
                            width: "100%",
                            aspectRatio: "556 / 370",
                            objectFit: "cover",
                          },
                        })
                      : el("span", null, "右画像を選択")
                  ),
              }),
            ]
          ),
        ]
      );
    },

    save: (props) => {
      const {
        leftTitle,
        leftText,
        leftImageUrl,
        leftImageAlt,
        rightTitle,
        rightText,
        rightImageUrl,
        rightImageAlt,
      } = props.attributes;

      return el(
        "div",
        { className: "original_contents_block_02 original_block" },
        [
          el("div", { className: "left_contents contents" }, [
            el(RichText.Content, { tagName: "h3", value: leftTitle }),
            el(RichText.Content, { tagName: "p", value: leftText }),
            leftImageUrl &&
              el("img", { src: leftImageUrl, alt: leftImageAlt || "" }),
          ]),
          el("div", { className: "right_contents contents" }, [
            el(RichText.Content, { tagName: "h3", value: rightTitle }),
            el(RichText.Content, { tagName: "p", value: rightText }),
            rightImageUrl &&
              el("img", { src: rightImageUrl, alt: rightImageAlt || "" }),
          ]),
        ]
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor || window.wp.editor,
  window.wp.components
);
