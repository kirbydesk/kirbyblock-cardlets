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
  const _sfc_main$3 = {
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
  var _sfc_render$3 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "blockinfo" }, [_c("div", { class: { "is-link": _vm.design }, attrs: { "title": _vm.design ? _vm.$t("pw.blockinfo.design") : null, "role": _vm.design ? "link" : null }, on: { "click": _vm.go } }, [_c("svg", { staticClass: "k-icon", attrs: { "aria-hidden": "true" } }, [_c("use", { attrs: { "xlink:href": "#icon-" + _vm.icon } })]), _vm._v(" " + _vm._s(_vm.value) + " "), _vm.layout ? _c("span", [_vm._v("(" + _vm._s(_vm.layout) + ")")]) : _vm._e()])]);
  };
  var _sfc_staticRenderFns$3 = [];
  _sfc_render$3._withStripped = true;
  var __component__$3 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$3,
    _sfc_render$3,
    _sfc_staticRenderFns$3,
    false,
    null,
    "26526d24"
  );
  __component__$3.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/blockinfo.vue";
  const pwBlockinfo = __component__$3.exports;
  const _sfc_main$2 = {
    components: {
      pwBlockinfo
    }
  };
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", attrs: { "data-kirbyblock": "cardlets" }, on: { "dblclick": _vm.open } }, [_c("pwBlockinfo", { attrs: { "value": _vm.$t("kirbyblock-cardlets.name"), "design": "pwcardlets", "icon": "cardlets" } }), _c("pw-block-panel-preview", { attrs: { "type": "pwcardlets", "content": _vm.content } })], 1);
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    null
  );
  __component__$2.options.__file = "/Users/christian/Projects/pluginsources/kirbyblock-cardlets/src/blocks/index.vue";
  const pwcardlets = __component__$2.exports;
  const _sfc_main$1 = {
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
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.src.length ? _c("div", { staticClass: "wrap", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "image" }, [_c("div", { staticClass: "pattern", class: _vm.size, style: _vm.radiusStyle }, [_c("figure", { class: _vm.computedRatio ? ["k-frame", "k-image-frame", "k-image", { zoom: _vm.computedZoom }] : ["k-image", "ratio-auto", { zoom: _vm.computedZoom }], style: { ..._vm.computedRatio ? { "--fit": _vm.computedCrop ? "cover" : "contain", "--ratio": _vm.computedRatio } : {}, ..._vm.radiusStyle } }, [_c("img", { attrs: { "src": _vm.src, "srcset": _vm.srcset } }), _c("div", [_c("k-icon", { attrs: { "type": "search" } })], 1)])])]), _vm.count > 1 ? _c("div", { staticClass: "controls" }, [_c("div", { staticClass: "dots", class: _vm.size }, _vm._l(_vm.count, function(n) {
      return _c("span", { key: n, staticClass: "dot" });
    }), 0)]) : _vm._e()]) : _vm._e();
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1,
    false,
    null,
    "3063e108"
  );
  __component__$1.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/image.vue";
  const pwImage = __component__$1.exports;
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
      // the writer's HTML; plain text as it is (masked)
      descriptionIsHtml() {
        try {
          return (JSON.parse(this.content.description || "{}").mode || "textarea") === "writer";
        } catch (e) {
          return false;
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
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("div", { staticClass: "item", on: { "dblclick": _vm.open } }, [((_a = _vm.content) == null ? void 0 : _a.image) ? _c("pwImage", { staticClass: "pwImage", attrs: { "src": ((_d = (_c2 = (_b = _vm.content) == null ? void 0 : _b.image) == null ? void 0 : _c2[0]) == null ? void 0 : _d.url) || "", "srcset": ((_h = (_g = (_f = (_e = _vm.content) == null ? void 0 : _e.image) == null ? void 0 : _f[0]) == null ? void 0 : _g.image) == null ? void 0 : _h.srcset) || "", "image": ((_j = (_i = _vm.content) == null ? void 0 : _i.image) == null ? void 0 : _j[0]) || null } }) : _vm._e(), _c("div", { staticClass: "pwContent" }, [_vm.settings["item-tagline"] !== false && _vm.parsedTagline ? _c("div", { staticClass: "pwTagline" }, [_vm._v(_vm._s(_vm.parsedTagline))]) : _vm._e(), _vm.settings["item-heading"] !== false && _vm.parsedHeading ? _c("div", { staticClass: "pwHeading" }, [_vm._v(_vm._s(_vm.parsedHeading))]) : _vm._e(), _vm.settings["item-editor"] !== false && _vm.parsedDescription ? _c("div", { staticClass: "pwText" }, [_vm.descriptionIsHtml ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.parsedDescription) } }) : _c("div", { staticClass: "pwPlain" }, [_vm._v(_vm._s(_vm.parsedDescription))])]) : _vm._e()])], 1)]);
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
