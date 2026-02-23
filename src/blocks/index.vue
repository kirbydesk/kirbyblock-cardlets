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
				:data-paddingtop="content.paddingtop === true ? 'true' : null"
				:data-paddingright="content.paddingright === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom === true ? 'true' : null"
				:data-paddingleft="content.paddingleft === true ? 'true' : null"
				>

				<!-- Tagline -->
				<pwTagline v-if="settings.tagline" :value="content.tagline" :alignDefault="fieldDefaults['align-tagline']" />

				<!-- Heading -->
				<pwHeading v-if="settings.heading" :value="content.heading" :data-level="content.level" :alignDefault="fieldDefaults['align-heading']" />

				<!-- Editor -->
				<pwEditor v-if="settings.editor" :content="content" :alignDefault="fieldDefaults['align-editor']" />

				<!-- Blocks -->

			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue';
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue';
import pwEditor from '@/../../kirby-pagewizard/src/components/editor.vue';
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';

export default {
	components: {
		pwBlockinfo,
		pwTagline,
		pwHeading,
		pwEditor
	},
	mixins: [pwGridStyle, pwColorStyle],
	data() {
		return {
			settings: {},
			fieldDefaults: {}
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