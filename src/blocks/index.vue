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
							:style="itemStyle"
							:data-radius-top-left="item.content.radiustopleft === true ? 'true' : null"
							:data-radius-top-right="item.content.radiustopright === true ? 'true' : null"
							:data-radius-bottom-right="item.content.radiusbottomright === true ? 'true' : null"
							:data-radius-bottom-left="item.content.radiusbottomleft === true ? 'true' : null">

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
		itemStyle() {
			if (!this.blockValues) return {};
			const ov = this.blockValues.overrides || {};
			const varDefs = this.blockValues.defaults?.items?.vars || {};
			const pickColor = this.pickItemColor;
			const style = { overflow: 'hidden' };

			const bg = pickColor('item-background');
			if (bg) style.backgroundColor = bg;

			// Always render the configured border in the panel preview so the
			// user can see how the chosen width/color looks while adjusting.
			// (The frontend gates this on data-border="true" — that's a per-item
			// runtime toggle and not directly observable here.)
			const borderWidth = ov['item-border-width'] || varDefs['item-border-width']?.value;
			const borderColor = pickColor('item-border-color');
			if (borderWidth) {
				style.borderStyle = 'solid';
				style.borderWidth = borderWidth;
				if (borderColor) style.borderColor = borderColor;
			}

			// Per-corner radius using the same defaults toggles + value array
			// the frontend reads. Suffix order in settings.json:
			// [-top-left, -top-right, -bottom-left, -bottom-right]
			const radiusArr = ov['item-radius'] || varDefs['item-radius']?.value;
			if (Array.isArray(radiusArr)) {
				const corners = [
					['top-left',     0, 'borderTopLeftRadius'],
					['top-right',    1, 'borderTopRightRadius'],
					['bottom-left',  2, 'borderBottomLeftRadius'],
					['bottom-right', 3, 'borderBottomRightRadius'],
				];
				for (const [suffix, idx, prop] of corners) {
					if (this.defaults['item-radius-' + suffix] === true) {
						style[prop] = radiusArr[idx];
					}
				}
			}

			return style;
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