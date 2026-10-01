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
  const _sfc_main$2 = {
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
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "blockinfo" }, [_c("div", { class: { "is-link": _vm.design }, attrs: { "title": _vm.design ? _vm.$t("pw.blockinfo.design") : null, "role": _vm.design ? "link" : null }, on: { "click": _vm.go } }, [_c("svg", { staticClass: "k-icon", attrs: { "aria-hidden": "true" } }, [_c("use", { attrs: { "xlink:href": "#icon-" + _vm.icon } })]), _vm._v(" " + _vm._s(_vm.value) + " "), _vm.layout ? _c("span", [_vm._v("(" + _vm._s(_vm.layout) + ")")]) : _vm._e()])]);
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    "26526d24"
  );
  __component__$2.options.__file = "/Users/christian/Projects/pluginsources/kirby-pagewizard/src/components/blockinfo.vue";
  const pwBlockinfo = __component__$2.exports;
  const _sfc_main$1 = {
    components: {
      pwBlockinfo
    }
  };
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", attrs: { "data-kirbyblock": "cardlets" }, on: { "dblclick": _vm.open } }, [_c("pwBlockinfo", { attrs: { "value": _vm.$t("kirbyblock-cardlets.name"), "design": "pwcardlets", "icon": "cardlets" } }), _c("pw-block-panel-preview", { attrs: { "type": "pwcardlets", "content": _vm.content } })], 1);
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
    var _a, _b, _c2;
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("div", { staticClass: "item", on: { "dblclick": _vm.open } }, [((_c2 = (_b = (_a = _vm.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) == null ? void 0 : _c2.url) ? _c("div", { staticClass: "pwImage" }, [_c("img", { attrs: { "src": _vm.content.image[0].url, "alt": "" } })]) : _vm._e(), _c("div", { staticClass: "pwContent" }, [_vm.settings["item-tagline"] !== false && _vm.parsedTagline ? _c("div", { staticClass: "pwTagline" }, [_vm._v(_vm._s(_vm.parsedTagline))]) : _vm._e(), _vm.settings["item-heading"] !== false && _vm.parsedHeading ? _c("div", { staticClass: "pwHeading" }, [_vm._v(_vm._s(_vm.parsedHeading))]) : _vm._e(), _vm.settings["item-editor"] !== false && _vm.parsedDescription ? _c("div", { staticClass: "pwText" }, [_vm.descriptionIsHtml ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.parsedDescription) } }) : _c("div", { staticClass: "pwPlain" }, [_vm._v(_vm._s(_vm.parsedDescription))])]) : _vm._e(), _vm.content.linkinternal ? _c("div", { staticClass: "linktext pwLink" }, [_c("k-icon", { attrs: { "type": "url" } }), _c("span", [_vm._v(_vm._s(_vm.content.linktext || _vm.$t("kirbyblock-cardlets.item.cta")))])], 1) : _vm._e()])])]);
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
