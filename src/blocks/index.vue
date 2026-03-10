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
				:data-paddingtop="content.paddingtop || null"
				:data-paddingright="content.paddingright === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom || null"
				:data-paddingleft="content.paddingleft === true ? 'true' : null"
				>

				<div class="contents">
					<!-- Tagline -->
					<pwTagline v-if="settings.tagline" :value="content.tagline" :alignDefault="fieldDefaults['align-tagline']" />

					<!-- Heading -->
					<pwHeading v-if="settings.heading" :value="content.heading" :data-level="content.level" :alignDefault="fieldDefaults['align-heading']" :sizeDefault="fieldDefaults['size-heading']" />

					<!-- Editor -->
					<pwEditor v-if="settings.editor" :content="content" :alignDefault="fieldDefaults['align-editor']" />

					<!-- Blocks -->
					 <div v-if="blockItems.length" class="pwItems" :data-align="content.blocksalignment || fieldDefaults['align-blocks']">
						<div v-for="item in blockItems"
							:key="item.id"
							class="pwItem"
							:class="{'ishidden': item.isHidden}"
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
									<div class="pwTagline" v-if="parseTaglineText(item.content.tagline)">{{ parseTaglineText(item.content.tagline) }}</div>
									<div class="placeholder" v-else>{{ $t('kirbyblock-cardlets.item.tagline.placeholder') }}</div>
								</div>
								<div v-if="settings['item-heading'] !== false">
									<div class="pwHeading" v-if="parseHeadingText(item.content.heading)">{{ parseHeadingText(item.content.heading) }}</div>
									<div class="placeholder" v-else>{{ $t('kirbyblock-cardlets.item.heading.placeholder') }}</div>
								</div>
								<div v-if="settings['item-editor'] !== false">
									<div class="pwText" v-if="parseEditorText(item.content.description)">{{ parseEditorText(item.content.description) }}</div>
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
			fieldDefaults: {}
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
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwcardlets');
			this.settings = response.settings;
			this.fieldDefaults = response.fields || {};
		} catch (e) {
			this.settings = {};
		}
	}
}
</script>