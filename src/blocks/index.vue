<template>
	<div
		class="pwPreview"
		data-kirbyblock="cardlets"
		@dblclick="open"
		:style="colorVars"
		:data-margintop="content.margintop === true ? 'true' : null"
		:data-marginbottom="content.marginbottom === true ? 'true' : null"
		>

		<pwBlockinfo
			:value="$t('kirbyblock-cardlets.name')"
			icon="cardlets"
		/>

		<div class="pwGrid">
			<div
				class="pwGridItem"
				:style="gridVars"
				:data-paddingtop="content.paddingtop || defaults['padding-top'] || null"
				:data-paddingright="(content.paddingright !== undefined ? content.paddingright : defaults['padding-right']) === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom || defaults['padding-bottom'] || null"
				:data-paddingleft="(content.paddingleft !== undefined ? content.paddingleft : defaults['padding-left']) === true ? 'true' : null"
				>

				<div class="contents">
					<!-- Tagline -->
					<pwTagline v-if="settings.tagline" :value="content.tagline" :alignDefault="fieldDefaults['align-tagline']" />

					<!-- Heading -->
					<pwHeading v-if="settings.heading" :value="content.heading" :data-level="content.level" :alignDefault="fieldDefaults['align-heading']" :sizeDefault="fieldDefaults['size-heading']" :textbackgroundDefault="fieldDefaults['textbackground-heading']" />

					<!-- Editor -->
					<pwEditor v-if="settings.editor" :content="content" :alignDefault="fieldDefaults['align-editor']" />

					<!-- Blocks -->
					 <div v-if="blockItems.length" class="pwItems" :data-align="content.blocksalignment || fieldDefaults['align-blocks']">
						<div v-for="item in blockItems"
							:key="item.id"
							class="pwItem"
							:class="{'ishidden': item.isHidden}"
							:style="getItemStyle(item)">

							<div v-if="item.content?.image?.[0]" class="pwImage">
								<pwImage
									:src="item.content?.image?.[0]?.url || ''"
									:srcset="item.content?.image?.[0]?.image?.srcset || ''"
									:image="item.content?.image?.[0] || null"
								/>
							</div>

							<div class="pwContent">
								<div v-if="settings['item-tagline'] !== false">
									<div class="pwTagline" :style="itemTaglineStyle" v-if="parseTaglineText(item.content.tagline)">{{ parseTaglineText(item.content.tagline) }}</div>
									<div class="placeholder" v-else>{{ $t('kirbyblock-cardlets.item.tagline.placeholder') }}</div>
								</div>
								<div v-if="settings['item-heading'] !== false">
									<div class="pwHeading" :style="itemHeadingStyle" v-if="parseHeadingText(item.content.heading)">{{ parseHeadingText(item.content.heading) }}</div>
									<div class="placeholder" v-else>{{ $t('kirbyblock-cardlets.item.heading.placeholder') }}</div>
								</div>
								<div v-if="settings['item-editor'] !== false">
									<div class="pwText" :style="itemEditorStyle" v-if="parseEditorText(item.content.description)">{{ parseEditorText(item.content.description) }}</div>
									<div class="placeholder" v-else>{{ $t('kirbyblock-cardlets.item.description.placeholder') }}</div>
								</div>
								<div v-if="hasItemLink(item)" class="pwCta" :style="getCtaStyle(item)">{{ ctaText(item) }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue';
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue';
import pwEditor from '@/../../kirby-pagewizard/src/components/editor.vue';
import pwImage from '@/../../kirby-pagewizard/src/components/image.vue'
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';

export default {
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
			blockValues: null
		}
	},
	methods: {
		parseTaglineText(raw) {
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.text || '';
			} catch(e) {
				return raw;
			}
		},
		parseHeadingText(raw) {
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.text || '';
			} catch(e) {
				return raw;
			}
		},
		parseEditorText(raw) {
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.mode ? (d[d.mode] || '') : (d.writer || d.textarea || d.markdown || '');
			} catch(e) {
				return raw;
			}
		},
		hasItemLink(item) {
			return Boolean(item.content && item.content.linkinternal);
		},
		ctaText(item) {
			const lt = item.content && item.content.linktext;
			if (lt && String(lt).trim() !== '') return lt;
			return this.$t('kirbyblock-cardlets.item.cta') || 'Read more';
		},
		getCtaStyle(item) {
			const linkStyle = this.defaults['item-link-style'] || 'text';
			const align = (item.content && item.content.linkalign) || 'left';
			const style = {
				display: 'flex',
				width: 'max-content',
				alignItems: 'center',
				gap: '0.4em',
				marginTop: '0.5em',
				fontWeight: 500,
			};
			if (align === 'center') {
				style.marginLeft = 'auto';
				style.marginRight = 'auto';
			} else if (align === 'right') {
				style.marginLeft = 'auto';
			} else {
				style.marginRight = 'auto';
			}
			if (linkStyle === 'button') {
				style.padding = '0.5em 1em';
				style.borderRadius = '999px';
				style.background = 'rgba(0,0,0,0.1)';
				style.color = 'inherit';
			} else {
				style.textDecoration = 'underline';
				style.color = this.pickItemColor('item-link') || 'inherit';
			}
			return style;
		},
		getItemStyle(item) {
			// Block-wide style + per-item radius corners.
			// Per-corner toggle: per-item field wins when explicitly set,
			// otherwise fall back to block-level defaults['item-radius-<corner>'].
			const base = this.itemBaseStyle;
			if (!base) return {};
			const style = { ...base.style };
			if (!base.radiusArr) return style;

			const corners = [
				['top-left',     0, 'borderTopLeftRadius',     'radiustopleft'],
				['top-right',    1, 'borderTopRightRadius',    'radiustopright'],
				['bottom-left',  2, 'borderBottomLeftRadius',  'radiusbottomleft'],
				['bottom-right', 3, 'borderBottomRightRadius', 'radiusbottomright'],
			];
			for (const [suffix, idx, prop, contentKey] of corners) {
				const perItem = item.content[contentKey];
				const enabled = (perItem === true || perItem === false)
					? perItem === true
					: this.defaults['item-radius-' + suffix] === true;
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
				return typeof raw === 'string' ? JSON.parse(raw) : raw;
			} catch(e) {
				return [];
			}
		},
		pickItemColor() {
			// Returns a function that resolves a color var for the active theme.
			if (!this.blockValues) return () => null;
			const theme = this.content.theme || 'default';
			const colorDefs = this.blockValues.defaults?.items?.colors || {};
			const themeOv = (this.blockValues.overrides || {})[theme] || {};
			return name => themeOv[name] || colorDefs[name]?.[theme] || null;
		},
		itemBaseStyle() {
			// Block-wide bits of the item style — bg, border, plus the radius
			// values. Per-item overrides for the corner toggles are mixed in
			// by getItemStyle(item) below.
			if (!this.blockValues) return null;
			const ov = this.blockValues.overrides || {};
			const varDefs = this.blockValues.defaults?.items?.vars || {};
			const pickColor = this.pickItemColor;
			const style = { overflow: 'hidden' };

			const bg = pickColor('item-background');
			if (bg) style.backgroundColor = bg;

			// Border honors the item-border toggle from the wizard defaults
			// (mirrors data-border="true|false" on the frontend).
			const borderOn = this.defaults['item-border'] === true || this.fieldDefaults['item-border'] === true;
			if (borderOn) {
				const borderWidth = ov['item-border-width'] || varDefs['item-border-width']?.value;
				const borderColor = pickColor('item-border-color');
				if (borderWidth) {
					style.borderStyle = 'solid';
					style.borderWidth = borderWidth;
					if (borderColor) style.borderColor = borderColor;
				}
			}

			const radiusArr = ov['item-radius'] || varDefs['item-radius']?.value;
			return { style, radiusArr: Array.isArray(radiusArr) ? radiusArr : null };
		},
		itemTaglineStyle() {
			const color = this.pickItemColor('item-tagline-text');
			return color ? { color } : {};
		},
		itemHeadingStyle() {
			const color = this.pickItemColor('item-heading-text');
			return color ? { color } : {};
		},
		itemEditorStyle() {
			const color = this.pickItemColor('item-editor-text');
			return color ? { color } : {};
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwcardlets');
			this.settings = response.settings;
			this.fieldDefaults = response.fields || {};
			this.defaults = response.defaults || {};
		} catch (e) {
			this.settings = {};
		}
		try {
			this.blockValues = await this.$api.get('projectwizard/values/pwcardlets');
		} catch (e) {
			this.blockValues = null;
		}
	}
}
</script>