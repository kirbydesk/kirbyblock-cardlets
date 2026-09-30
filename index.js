(function() {
  "use strict";
  function normalizeComponent(scriptExports, render, staticRenderFns, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render) {
      options.render = render;
      options.staticRenderFns = staticRenderFns;
      options._compiled = true;
    }
    if (scopeId) {
      options._scopeId = "data-v-" + scopeId;
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const _sfc_main$8 = {
    props: {
      value: String,
      icon: String,
      layout: String,
      // the block type: a button to its design in the Project Wizard
      design: String
    },
    methods: {
      go(event) {
        if (!this.design) return;
        event.stopPropagation();
        this.$go("projectwizard/block/" + this.design);
      }
    }
  };
  var _sfc_render$8 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "blockinfo" }, [_c("div", { class: { "is-link": _vm.design }, attrs: { "title": _vm.design ? _vm.$t("pw.blockinfo.design") : null, "role": _vm.design ? "link" : null }, on: { "click": _vm.go } }, [_c("svg", { staticClass: "k-icon", attrs: { "aria-hidden": "true" } }, [_c("use", { attrs: { "xlink:href": "#icon-" + _vm.icon } })]), _vm._v(" " + _vm._s(_vm.value) + " "), _vm.layout ? _c("span", [_vm._v("(" + _vm._s(_vm.layout) + ")")]) : _vm._e()])]);
  };
  var _sfc_staticRenderFns$8 = [];
  _sfc_render$8._withStripped = true;
  var __component__$8 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$8,
    _sfc_render$8,
    _sfc_staticRenderFns$8,
    false,
    null,
    "26526d24"
  );
  __component__$8.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/blockinfo.vue";
  const pwBlockinfo = __component__$8.exports;
  const _sfc_main$7 = {
    props: {
      value: String,
      content: {
        type: Object,
        default: () => ({})
      },
      alignDefault: { type: String, default: "left" }
    },
    computed: {
      parsedData() {
        var _a;
        const val = ((_a = this.content) == null ? void 0 : _a.tagline) || this.value;
        if (!val) return { text: "", align: this.alignDefault };
        try {
          return typeof val === "string" ? JSON.parse(val) : val;
        } catch (e) {
          return { text: val, align: this.alignDefault };
        }
      },
      text() {
        const { text = "" } = this.parsedData;
        return text;
      },
      align() {
        const { align = this.alignDefault } = this.parsedData;
        return align;
      }
    }
  };
  var _sfc_render$7 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwTagline", attrs: { "data-align": _vm.align } }, [_vm.text ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.text) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.tagline.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$7 = [];
  _sfc_render$7._withStripped = true;
  var __component__$7 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$7,
    _sfc_render$7,
    _sfc_staticRenderFns$7,
    false,
    null,
    "2287a490"
  );
  __component__$7.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/tagline.vue";
  const pwTagline = __component__$7.exports;
  const _sfc_main$6 = {
    props: {
      value: String,
      content: {
        type: Object,
        default: () => ({})
      },
      alignDefault: { type: String, default: null },
      sizeDefault: { type: String, default: null },
      textbackgroundDefault: { type: String, default: null },
      multilineDefault: { type: String, default: null },
      flourishDefault: { type: String, default: null }
    },
    computed: {
      parsedData() {
        var _a;
        const val = ((_a = this.content) == null ? void 0 : _a.heading) || this.value;
        if (!val) return { text: "", align: this.alignDefault };
        try {
          return typeof val === "string" ? JSON.parse(val) : val;
        } catch (e) {
          return { text: val, align: this.alignDefault };
        }
      },
      text() {
        const { text = "" } = this.parsedData;
        return text;
      },
      align() {
        const { align = this.alignDefault } = this.parsedData;
        return align;
      },
      size() {
        const { size = this.sizeDefault } = this.parsedData;
        return size;
      },
      textbackground() {
        const { textbackground = this.textbackgroundDefault } = this.parsedData;
        return textbackground;
      },
      multiline() {
        const { multiline = this.multilineDefault } = this.parsedData;
        return multiline;
      },
      flourish() {
        const { flourish = this.flourishDefault } = this.parsedData;
        return flourish;
      },
      textLines() {
        return this.text.split(/\r\n|\r|\n/).filter((l) => l !== "");
      }
    }
  };
  var _sfc_render$6 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwHeading", attrs: { "data-align": _vm.align, "data-size": _vm.size } }, [_vm.text ? _c("div", [_vm.multiline === "enabled" ? [_vm._l(_vm.textLines, function(line, i) {
      return [i > 0 ? _c("br", { key: "br-" + i }) : _vm._e(), _vm.textbackground === "enabled" ? _c("span", { key: i, attrs: { "data-textbackground": "" }, domProps: { "innerHTML": _vm._s(line) } }) : _c("span", { key: i, domProps: { "innerHTML": _vm._s(line) } })];
    })] : [_vm.textbackground === "enabled" ? _c("span", { attrs: { "data-textbackground": "" }, domProps: { "innerHTML": _vm._s(_vm.text) } }) : _c("span", { domProps: { "innerHTML": _vm._s(_vm.text) } })], _vm.flourish === "enabled" ? _c("div", { attrs: { "data-flourish": "", "data-align": _vm.align } }) : _vm._e()], 2) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.heading.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$6 = [];
  _sfc_render$6._withStripped = true;
  var __component__$6 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$6,
    _sfc_render$6,
    _sfc_staticRenderFns$6,
    false,
    null,
    "ad832d63"
  );
  __component__$6.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/heading.vue";
  const pwHeading = __component__$6.exports;
  const _sfc_main$5 = {
    props: {
      value: String,
      align: { type: String, default: "left" },
      size: { type: String, default: null }
    },
    computed: {
      text() {
        return this.value || "";
      }
    },
    methods: {
      nl2br(text) {
        if (!text) return "";
        return text.replace(/\n/g, "<br>");
      }
    }
  };
  var _sfc_render$5 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwtext", attrs: { "data-align": _vm.align, "data-size": _vm.size } }, [_vm.text ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.nl2br(_vm.text)) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-textarea.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$5 = [];
  _sfc_render$5._withStripped = true;
  var __component__$5 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$5,
    _sfc_render$5,
    _sfc_staticRenderFns$5,
    false,
    null,
    "05c2d6ed"
  );
  __component__$5.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/textarea.vue";
  const PwTextarea = __component__$5.exports;
  const _sfc_main$4 = {
    props: {
      value: String,
      align: { type: String, default: "left" },
      size: { type: String, default: null }
    }
  };
  var _sfc_render$4 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwtext", attrs: { "data-align": _vm.align, "data-size": _vm.size } }, [_vm.value ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.value) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-writer.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$4 = [];
  _sfc_render$4._withStripped = true;
  var __component__$4 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$4,
    _sfc_render$4,
    _sfc_staticRenderFns$4,
    false,
    null,
    "fa3feda4"
  );
  __component__$4.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/writer.vue";
  const PwWriter = __component__$4.exports;
  const _sfc_main$3 = {
    components: { PwTextarea, PwWriter },
    props: {
      content: {
        type: Object,
        default: () => ({})
      },
      alignDefault: { type: String, default: "left" }
    },
    computed: {
      parsed() {
        var _a;
        const val = (_a = this.content) == null ? void 0 : _a.editor;
        if (!val) return { mode: "textarea", text: "", align: this.alignDefault };
        try {
          const data = typeof val === "string" ? JSON.parse(val) : val;
          const mode = data.mode || "textarea";
          return { mode, text: data[mode] || "", align: data.align || this.alignDefault, size: data.size || null };
        } catch (e) {
          return { mode: "textarea", text: "", align: this.alignDefault };
        }
      },
      mode() {
        return this.parsed.mode;
      },
      text() {
        return this.parsed.text;
      },
      align() {
        return this.parsed.align || this.alignDefault;
      },
      size() {
        return this.parsed.size || null;
      }
    }
  };
  var _sfc_render$3 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwEditor" }, [_vm.mode === "textarea" ? _c("pw-textarea", { attrs: { "value": _vm.text, "align": _vm.align, "size": _vm.size } }) : _vm.mode === "writer" ? _c("pw-writer", { attrs: { "value": _vm.text, "align": _vm.align, "size": _vm.size } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-textarea.placeholder")) + " ")])], 1);
  };
  var _sfc_staticRenderFns$3 = [];
  _sfc_render$3._withStripped = true;
  var __component__$3 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$3,
    _sfc_render$3,
    _sfc_staticRenderFns$3,
    false,
    null,
    null
  );
  __component__$3.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/editor.vue";
  const pwEditor = __component__$3.exports;
  const _sfc_main$2 = {
    props: {
      src: String,
      srcset: String,
      size: String,
      radius: String,
      radiustopleft: [Boolean, String],
      radiustopright: [Boolean, String],
      radiusbottomleft: [Boolean, String],
      radiusbottomright: [Boolean, String],
      alignment: {
        type: String,
        default: "left"
      },
      image: Object,
      count: {
        type: Number,
        default: 0
      }
    },
    data() {
      return {
        imageContent: null
      };
    },
    computed: {
      computedCrop() {
        var _a;
        if (this.radius === "round") return true;
        return ((_a = this.imageContent) == null ? void 0 : _a.imagecrop) || false;
      },
      computedRatio() {
        var _a;
        if (this.radius === "round") return "1/1";
        const ratio = (_a = this.imageContent) == null ? void 0 : _a.imageratio;
        if (!ratio || ratio === "auto") return null;
        return ratio;
      },
      computedZoom() {
        var _a;
        return ((_a = this.imageContent) == null ? void 0 : _a.imagezoom) || false;
      },
      radiusStyle() {
        if (this.radius === "round") {
          return { borderRadius: "9999px", overflow: "hidden" };
        }
        if (this.radius === "custom") {
          const isTrue = (v) => v === true || v === "true";
          return {
            borderTopLeftRadius: isTrue(this.radiustopleft) ? "15px" : "0",
            borderTopRightRadius: isTrue(this.radiustopright) ? "15px" : "0",
            borderBottomRightRadius: isTrue(this.radiusbottomright) ? "15px" : "0",
            borderBottomLeftRadius: isTrue(this.radiusbottomleft) ? "15px" : "0",
            overflow: "hidden"
          };
        }
        return {};
      }
    },
    async mounted() {
      var _a;
      if ((_a = this.image) == null ? void 0 : _a.link) {
        await this.loadImageContent();
      }
    },
    methods: {
      async loadImageContent() {
        try {
          const response = await this.$api.get(this.image.link);
          this.imageContent = (response == null ? void 0 : response.content) || null;
        } catch (error) {
          console.error("Error loading image content:", error);
        }
      }
    }
  };
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.src.length ? _c("div", { staticClass: "wrap", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "image" }, [_c("div", { staticClass: "pattern", class: _vm.size, style: _vm.radiusStyle }, [_c("figure", { class: _vm.computedRatio ? ["k-frame", "k-image-frame", "k-image", { zoom: _vm.computedZoom }] : ["k-image", "ratio-auto", { zoom: _vm.computedZoom }], style: { ..._vm.computedRatio ? { "--fit": _vm.computedCrop ? "cover" : "contain", "--ratio": _vm.computedRatio } : {}, ..._vm.radiusStyle } }, [_c("img", { attrs: { "src": _vm.src, "srcset": _vm.srcset } }), _c("div", [_c("k-icon", { attrs: { "type": "search" } })], 1)])])]), _vm.count > 1 ? _c("div", { staticClass: "controls" }, [_c("div", { staticClass: "dots", class: _vm.size }, _vm._l(_vm.count, function(n) {
      return _c("span", { key: n, staticClass: "dot" });
    }), 0)]) : _vm._e()]) : _vm._e();
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    "3063e108"
  );
  __component__$2.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/image.vue";
  const pwImage = __component__$2.exports;
  const pwGridStyle = {
    computed: {
      gridVars() {
        const offset = (val) => {
          const n = Number(val);
          return n === 0 ? "auto" : n + 1;
        };
        return {
          "--grid-start-sm": offset(this.content.gridoffsetsm),
          "--grid-span-sm": Number(this.content.gridsizesm),
          "--grid-start-md": offset(this.content.gridoffsetmd),
          "--grid-span-md": Number(this.content.gridsizemd),
          "--grid-start-lg": offset(this.content.gridoffsetlg),
          "--grid-span-lg": Number(this.content.gridsizelg),
          "--grid-start-xl": offset(this.content.gridoffsetxl),
          "--grid-span-xl": Number(this.content.gridsizexl)
        };
      }
    }
  };
  const pwColorStyle = {
    data() {
      return {
        colors: null
      };
    },
    async created() {
      try {
        this.colors = await this.$api.get("pagewizard/colors");
      } catch (e) {
        this.colors = null;
      }
    },
    computed: {
      colorVars() {
        if (!this.colors) return {};
        const style = this.content.theme || "default";
        const vars = {};
        if (style === "custom") {
          for (const [key, value] of Object.entries(this.colors.default)) {
            vars["--" + key] = value;
          }
          if (this.content.textcolor) {
            vars["--pw-color-text"] = this.content.textcolor;
            vars["--pw-color-heading"] = this.content.textcolor;
            vars["--pw-color-tagline"] = this.content.textcolor;
            vars["--pw-color-link"] = this.content.textcolor;
            vars["--pw-color-quote"] = this.content.textcolor;
            vars["--pw-color-cite"] = this.content.textcolor;
          }
          if (this.content.backgroundcolor) {
            vars["--pw-color-block-background"] = this.content.backgroundcolor;
          }
          const btnStyle = this.content.buttonstyle || "default";
          if (btnStyle !== "default" && this.colors[btnStyle]) {
            const btnKeys = Object.keys(this.colors[btnStyle]).filter((k) => k.startsWith("pw-color-button"));
            for (const key of btnKeys) {
              vars["--" + key] = this.colors[btnStyle][key];
            }
          }
        } else {
          const themePalette = this.colors[style];
          const palette = themePalette ? { ...this.colors.default, ...themePalette } : this.colors.default;
          for (const [key, value] of Object.entries(palette)) {
            vars["--" + key] = value;
          }
        }
        return vars;
      }
    }
  };
  const _sfc_main$1 = {
    components: {
      pwBlockinfo,
      pwTagline,
      pwHeading,
      pwEditor,
      pwImage
    },
    mixins: [pwGridStyle, pwColorStyle],
    data() {
      return {
        settings: {},
        fieldDefaults: {},
        defaults: {},
        blockValues: null,
        // Mirrors the icon SVG library in src/config/settings.json so the panel
        // preview can render the chosen CTA icon. Kept in sync manually.
        linkIcons: {
          "arrow": "<path d='M5 12h14M13 5l7 7-7 7' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
          "long-arrow": "<path d='M2 12h19m-5-5l5 5-5 5' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
          "chevron": "<polyline points='9 6 15 12 9 18' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
          "caret": "<path d='M8 5l8 7-8 7z' fill='currentColor'/>"
        }
      };
    },
    methods: {
      parseTaglineText(raw) {
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.text || "";
        } catch (e) {
          return raw;
        }
      },
      parseHeadingText(raw) {
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.text || "";
        } catch (e) {
          return raw;
        }
      },
      parseHeadingSize(raw) {
        if (!raw) return null;
        try {
          return JSON.parse(raw).size || null;
        } catch (e) {
          return null;
        }
      },
      parseEditorText(raw) {
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.mode ? d[d.mode] || "" : d.writer || d.textarea || d.markdown || "";
        } catch (e) {
          return raw;
        }
      },
      parseEditorSize(raw) {
        if (!raw) return null;
        try {
          return JSON.parse(raw).size || null;
        } catch (e) {
          return null;
        }
      },
      hasItemLink(item) {
        return Boolean(item.content && item.content.linkinternal);
      },
      ctaText(item) {
        const lt = item.content && item.content.linktext;
        if (lt && String(lt).trim() !== "") return lt;
        return this.$t("kirbyblock-cardlets.item.cta") || "Read more";
      },
      getCtaStyle(item) {
        const linkStyle = this.defaults["item-link-style"] || "text";
        const align = item.content && item.content.linkalign || "left";
        const style = {
          display: "flex",
          width: "max-content",
          alignItems: "center",
          gap: "0.4em",
          marginTop: "0.5em",
          fontWeight: 500
        };
        if (align === "center") {
          style.marginLeft = "auto";
          style.marginRight = "auto";
        } else if (align === "right") {
          style.marginLeft = "auto";
        } else {
          style.marginRight = "auto";
        }
        if (linkStyle === "button") {
          style.padding = "0.5em 1em";
          style.borderRadius = "999px";
          style.background = "rgba(0,0,0,0.1)";
          style.color = "inherit";
        } else {
          if (this.defaults["item-link-decoration"] === "underline") {
            style.textDecoration = "underline";
          }
          style.color = this.pickItemColor("item-link") || "inherit";
        }
        return style;
      },
      getItemStyle(item) {
        const base = this.itemBaseStyle;
        if (!base) return {};
        const style = { ...base.style };
        if (!base.radiusArr) return style;
        const corners = [
          ["top-left", 0, "borderTopLeftRadius", "radiustopleft"],
          ["top-right", 1, "borderTopRightRadius", "radiustopright"],
          ["bottom-left", 2, "borderBottomLeftRadius", "radiusbottomleft"],
          ["bottom-right", 3, "borderBottomRightRadius", "radiusbottomright"]
        ];
        for (const [suffix, idx, prop, contentKey] of corners) {
          const perItem = item.content[contentKey];
          const enabled = perItem === true || perItem === false ? perItem === true : this.defaults["item-radius-" + suffix] === true;
          if (enabled) style[prop] = base.radiusArr[idx];
        }
        return style;
      }
    },
    computed: {
      blockItems() {
        try {
          const raw = this.content.blocks;
          if (!raw) return [];
          return typeof raw === "string" ? JSON.parse(raw) : raw;
        } catch (e) {
          return [];
        }
      },
      pickItemColor() {
        var _a, _b;
        if (!this.blockValues) return () => null;
        const theme = this.content.theme || "default";
        const colorDefs = ((_b = (_a = this.blockValues.defaults) == null ? void 0 : _a.items) == null ? void 0 : _b.colors) || {};
        const themeOv = (this.blockValues.overrides || {})[theme] || {};
        return (name) => {
          var _a2;
          return themeOv[name] || ((_a2 = colorDefs[name]) == null ? void 0 : _a2[theme]) || null;
        };
      },
      itemBaseStyle() {
        var _a, _b, _c, _d;
        if (!this.blockValues) return null;
        const ov = this.blockValues.overrides || {};
        const varDefs = ((_b = (_a = this.blockValues.defaults) == null ? void 0 : _a.items) == null ? void 0 : _b.vars) || {};
        const pickColor = this.pickItemColor;
        const style = { overflow: "hidden" };
        const bg = pickColor("item-background");
        if (bg) style.backgroundColor = bg;
        const borderOn = this.defaults["item-border"] === true || this.fieldDefaults["item-border"] === true;
        if (borderOn) {
          const borderWidth = ov["item-border-width"] || ((_c = varDefs["item-border-width"]) == null ? void 0 : _c.value);
          const borderColor = pickColor("item-border-color");
          if (borderWidth) {
            style.borderStyle = "solid";
            style.borderWidth = borderWidth;
            if (borderColor) style.borderColor = borderColor;
          }
        }
        const radiusArr = ov["item-radius"] || ((_d = varDefs["item-radius"]) == null ? void 0 : _d.value);
        return { style, radiusArr: Array.isArray(radiusArr) ? radiusArr : null };
      },
      itemTaglineStyle() {
        const color = this.pickItemColor("item-tagline-text");
        return color ? { color } : {};
      },
      ctaIconSvg() {
        if ((this.defaults["item-link-style"] || "text") !== "text") return "";
        const key = this.defaults["item-link-icon"] || "arrow";
        return this.linkIcons[key] || "";
      },
      ctaIconWrapped() {
        return '<svg viewBox="0 0 24 24" aria-hidden="true" style="width:1em;height:1em;flex:0 0 auto">' + this.ctaIconSvg + "</svg>";
      },
      itemHeadingStyle() {
        const color = this.pickItemColor("item-heading-text");
        return color ? { color } : {};
      },
      itemEditorStyle() {
        const color = this.pickItemColor("item-editor-text");
        return color ? { color } : {};
      }
    },
    async created() {
      try {
        const response = await this.$api.get("pagewizard/settings/pwcardlets");
        this.settings = response.settings;
        this.fieldDefaults = response.fields || {};
        this.defaults = response.defaults || {};
      } catch (e) {
        this.settings = {};
      }
      try {
        this.blockValues = await this.$api.get("projectwizard/values/pwcardlets");
      } catch (e) {
        this.blockValues = null;
      }
    }
  };
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", style: _vm.colorVars, attrs: { "data-kirbyblock": "cardlets", "data-margintop": _vm.content.margintop === true ? "true" : null, "data-marginbottom": _vm.content.marginbottom === true ? "true" : null }, on: { "dblclick": _vm.open } }, [_c("pwBlockinfo", { attrs: { "value": _vm.$t("kirbyblock-cardlets.name"), "icon": "cardlets" } }), _c("div", { staticClass: "pwGrid" }, [_c("div", { staticClass: "pwGridItem", style: _vm.gridVars, attrs: { "data-paddingtop": _vm.content.paddingtop || _vm.defaults["padding-top"] || null, "data-paddingright": (_vm.content.paddingright !== void 0 ? _vm.content.paddingright : _vm.defaults["padding-right"]) === true ? "true" : null, "data-paddingbottom": _vm.content.paddingbottom || _vm.defaults["padding-bottom"] || null, "data-paddingleft": (_vm.content.paddingleft !== void 0 ? _vm.content.paddingleft : _vm.defaults["padding-left"]) === true ? "true" : null } }, [_c("div", { staticClass: "contents" }, [_vm.settings.tagline ? _c("pwTagline", { attrs: { "value": _vm.content.tagline, "alignDefault": _vm.fieldDefaults["align-tagline"] } }) : _vm._e(), _vm.settings.heading ? _c("pwHeading", { attrs: { "value": _vm.content.heading, "data-level": _vm.content.level, "alignDefault": _vm.fieldDefaults["align-heading"], "sizeDefault": _vm.fieldDefaults["size-heading"], "textbackgroundDefault": _vm.fieldDefaults["textbackground-heading"], "multilineDefault": _vm.fieldDefaults["multiline-heading"], "flourishDefault": _vm.fieldDefaults["flourish-heading"] } }) : _vm._e(), _vm.settings.editor ? _c("pwEditor", { attrs: { "content": _vm.content, "alignDefault": _vm.fieldDefaults["align-editor"] } }) : _vm._e(), _vm.blockItems.length ? _c("div", { staticClass: "pwItems", attrs: { "data-align": _vm.content.blocksalignment || _vm.fieldDefaults["align-blocks"] } }, _vm._l(_vm.blockItems, function(item) {
      var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j, _k;
      return _c("div", { key: item.id, staticClass: "pwItem", class: { "ishidden": item.isHidden }, style: _vm.getItemStyle(item) }, [((_b = (_a = item.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) ? _c("div", { staticClass: "pwImage" }, [_c("pwImage", { attrs: { "src": ((_e = (_d = (_c2 = item.content) == null ? void 0 : _c2.image) == null ? void 0 : _d[0]) == null ? void 0 : _e.url) || "", "srcset": ((_i = (_h = (_g = (_f = item.content) == null ? void 0 : _f.image) == null ? void 0 : _g[0]) == null ? void 0 : _h.image) == null ? void 0 : _i.srcset) || "", "image": ((_k = (_j = item.content) == null ? void 0 : _j.image) == null ? void 0 : _k[0]) || null } })], 1) : _vm._e(), _c("div", { staticClass: "pwContent" }, [_vm.settings["item-tagline"] !== false ? _c("div", [_vm.parseTaglineText(item.content.tagline) ? _c("div", { staticClass: "pwTagline", style: _vm.itemTaglineStyle }, [_vm._v(_vm._s(_vm.parseTaglineText(item.content.tagline)))]) : _c("div", { staticClass: "placeholder" }, [_vm._v(_vm._s(_vm.$t("kirbyblock-cardlets.item.tagline.placeholder")))])]) : _vm._e(), _vm.settings["item-heading"] !== false ? _c("div", [_vm.parseHeadingText(item.content.heading) ? _c("div", { staticClass: "pwHeading", style: _vm.itemHeadingStyle, attrs: { "data-size": _vm.parseHeadingSize(item.content.heading) } }, [_vm._v(_vm._s(_vm.parseHeadingText(item.content.heading)))]) : _c("div", { staticClass: "placeholder" }, [_vm._v(_vm._s(_vm.$t("kirbyblock-cardlets.item.heading.placeholder")))])]) : _vm._e(), _vm.settings["item-editor"] !== false ? _c("div", [_vm.parseEditorText(item.content.description) ? _c("div", { staticClass: "pwText", style: _vm.itemEditorStyle, attrs: { "data-size": _vm.parseEditorSize(item.content.description) } }, [_vm._v(_vm._s(_vm.parseEditorText(item.content.description)))]) : _c("div", { staticClass: "placeholder" }, [_vm._v(_vm._s(_vm.$t("kirbyblock-cardlets.item.description.placeholder")))])]) : _vm._e(), _vm.hasItemLink(item) ? _c("div", { staticClass: "pwCta", style: _vm.getCtaStyle(item) }, [_c("span", [_vm._v(_vm._s(_vm.ctaText(item)))]), _vm.ctaIconSvg ? _c("span", { domProps: { "innerHTML": _vm._s(_vm.ctaIconWrapped) } }) : _vm._e()]) : _vm._e()])]);
    }), 0) : _vm._e()], 1)])])], 1);
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1,
    false,
    null,
    null
  );
  __component__$1.options.__file = "/Users/christian/Projects/pluginsources/kirbyblock-cardlets/src/blocks/index.vue";
  const pwcardlets = __component__$1.exports;
  const _sfc_main = {
    components: {
      pwImage
    },
    props: {
      content: Object
    },
    data() {
      return {
        settings: {}
      };
    },
    computed: {
      parsedHeading() {
        const raw = this.content.heading;
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.text || "";
        } catch (e) {
          return raw;
        }
      },
      parsedTagline() {
        const raw = this.content.tagline;
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.text || "";
        } catch (e) {
          return raw;
        }
      },
      parsedDescription() {
        const raw = this.content.description;
        if (!raw) return "";
        try {
          const d = JSON.parse(raw);
          return d.mode ? d[d.mode] || "" : d.writer || d.textarea || d.markdown || "";
        } catch (e) {
          return raw;
        }
      }
    },
    async created() {
      try {
        const response = await this.$api.get("pagewizard/settings/pwcardlets");
        this.settings = response.settings || {};
      } catch (e) {
        this.settings = {};
      }
    }
  };
  var _sfc_render = function render() {
    var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j;
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("div", { staticClass: "item", on: { "dblclick": _vm.open } }, [((_a = _vm.content) == null ? void 0 : _a.image) ? _c("pwImage", { staticClass: "pwImage", attrs: { "src": ((_d = (_c2 = (_b = _vm.content) == null ? void 0 : _b.image) == null ? void 0 : _c2[0]) == null ? void 0 : _d.url) || "", "srcset": ((_h = (_g = (_f = (_e = _vm.content) == null ? void 0 : _e.image) == null ? void 0 : _f[0]) == null ? void 0 : _g.image) == null ? void 0 : _h.srcset) || "", "image": ((_j = (_i = _vm.content) == null ? void 0 : _i.image) == null ? void 0 : _j[0]) || null } }) : _vm._e(), _c("div", { staticClass: "pwContent" }, [_vm.settings["item-tagline"] !== false ? _c("div", { staticClass: "pwTagline" }, [_vm.parsedTagline ? _c("span", [_vm._v(_vm._s(_vm.parsedTagline))]) : _c("span", { staticClass: "placeholder" }, [_vm._v(_vm._s(_vm.$t("kirbyblock-cardlets.item.tagline.placeholder")))])]) : _vm._e(), _vm.settings["item-heading"] !== false ? _c("div", { staticClass: "pwHeading" }, [_vm.parsedHeading ? _c("div", [_vm._v(_vm._s(_vm.parsedHeading))]) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("kirbyblock-cardlets.item.heading.placeholder")) + " ")])]) : _vm._e(), _vm.settings["item-editor"] !== false ? _c("div", { staticClass: "pwText" }, [_vm.parsedDescription ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.parsedDescription) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("kirbyblock-cardlets.item.description.placeholder")) + " ")])]) : _vm._e()])], 1)]);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns,
    false,
    null,
    "1e428e0a"
  );
  __component__.options.__file = "/Users/christian/Projects/pluginsources/kirbyblock-cardlets/src/blocks/item.vue";
  const pwcardletsitem = __component__.exports;
  panel.plugin("kirbydesk/kirbyblock-cardlets", {
    blocks: {
      pwcardlets,
      pwcardletsitem
    }
  });
})();
