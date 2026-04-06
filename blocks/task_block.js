(function (blocks, element, blockEditorOrEditor) {
  const el = element.createElement;
  const editor = blockEditorOrEditor || window.wp.editor;
  const { MediaUpload, RichText } = editor;
  const { Button } = wp.components;

  blocks.registerBlockType("my-blocks/task-block", {
    title: "タスクブロック",
    icon: "clipboard",
    category: "original",
    description: "画像と目的・発見・結果を横並びで表示するブロックです。",

    attributes: {
      imageUrl: { type: "string", default: "" },
      imageAlt: { type: "string", default: "" },
      purpose: { type: "string", default: "" },
      discovery: { type: "string", default: "" },
      result: { type: "string", default: "" },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const { imageUrl, imageAlt, purpose, discovery, result } = attributes;

      // 画像選択処理
      const onSelectImage = (media) => {
        setAttributes({
          imageUrl: media.url,
          imageAlt: media.alt || "",
        });
      };

      return el(
        "div",
        {
          className: "original_block original_task_block",
          //styleはblock_editor.cssに記述
        },
        [
          // 画像部分
          el(
            "div",
            { className: "task_image", style: { flex: "0 0 40%" } },
            el(MediaUpload, {
              onSelect: onSelectImage,
              type: "image",
              render: ({ open }) =>
                el(
                  "div",
                  {
                    onClick: open,
                    isPrimary: !imageUrl,
                    style: { cursor: "pointer", display: "flex", width: "100%", justifyContent: "center", alignItems: "center", aspectRatio: "536 / 370", border: "1px solid #ddd" },
                  },
                  imageUrl
                    ? el("img", {
                        src: imageUrl,
                        alt: imageAlt,
                        style: { width: "100%", height: "100%", objectFit: "cover" },
                      })
                    : "画像を選択"
                ),
            })
          ),

          // テキスト部分
          el(
            "div",
            { className: "text_container", style: { flex: "1", display: "flex", flexDirection: "column", gap: "10px" } },
            [
              // 目的
              el("div", { className: "purpose text_box", style: { padding: "30px", background: "#F6F8FB" } }, [
                el("span", { style: { display: "inline-block", width: "120px", textAlign: "center", fontWeight: "500", color: "#0F478C", border: "1px solid #0F478C", borderRadius: "30px", background: "#fff" } }, "目的"),
                el(RichText, {
                  tagName: "p",
                  style: { color: "#333", fontWeight: "500" },
                  value: purpose,
                  onChange: (value) => setAttributes({ purpose: value }),
                  placeholder: "目的を入力",
                }),
              ]),

              // 発見
              el("div", { className: "discovery text_box", style: { padding: "30px", background: "#F6F8FB" } }, [
                el("span", { style: { display: "inline-block", width: "120px", textAlign: "center", fontWeight: "500", color: "#fff", borderRadius: "30px", background: "#48A3C4" } }, "発見"),
                el(RichText, {
                  tagName: "p",
                  style: { color: "#333", fontWeight: "500" },
                  value: discovery,
                  onChange: (value) => setAttributes({ discovery: value }),
                  placeholder: "発見を入力",
                }),
              ]),

              // 結果
              el("div", { className: "result text_box", style: { padding: "30px", background: "#FFF2EE" } }, [
                el("span", { style: { display: "inline-block", width: "120px", textAlign: "center", fontWeight: "500", color: "#fff", borderRadius: "30px", background: "#FF4E0D" } }, "結果"),
                el(RichText, {
                  tagName: "p",
                  style: { color: "#333", fontWeight: "500" },
                  value: result,
                  onChange: (value) => setAttributes({ result: value }),
                  placeholder: "結果を入力",
                }),
              ]),
            ]
          ),
        ]
      );
    },

    save: (props) => {
      const { imageUrl, imageAlt, purpose, discovery, result } = props.attributes;

      return el(
        "div",
        { className: "original_block original_task_block" },
        [
          imageUrl &&
            el("img", {
              src: imageUrl,
              alt: imageAlt || "",
            }),
          el("div", { className: "text_container" }, [
            el("div", { className: "purpose text_box" }, [
              el("span",{ className: "title" }, null, "目的"),
              el(RichText.Content, { tagName: "p", value: purpose }),
            ]),
            el("div", { className: "discovery text_box" }, [
              el("span",{ className: "title" }, null, "発見"),
              el(RichText.Content, { tagName: "p", value: discovery }),
            ]),
            el("div", { className: "result text_box" }, [
              el("span",{ className: "title" }, null, "結果"),
              el(RichText.Content, { tagName: "p", value: result }),
            ]),
          ]),
        ]
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor || window.wp.editor);
