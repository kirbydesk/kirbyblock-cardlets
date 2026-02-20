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
				<pwTagline v-if="settings.tagline" :value="content.tagline" />

				<!-- Heading -->
				<pwHeading v-if="settings.heading" :value="content.heading" :data-level="content.level" />

				<!-- Textarea -->
				<pwTextarea v-if="content.textmode === 'textarea'" :value="content.texttextarea" />

				<!-- Writer -->
				<pwWriter	v-if="content.textmode === 'writer'" :value="content.textwriter" :align="content.textwriteralignment" />

				<!-- Markdown -->
				<pwMarkdown	v-if="content.textmode === 'markdown'" :value="content.textmarkdown" :align="content.textmarkdownalignment" />

				<!-- Buttons -->
				<pwButtons v-if="settings.buttons" :value="content.buttons" :align="content.buttonsalignment" />

			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue'
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue'
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue'
import pwTextarea from '@/../../kirby-pagewizard/src/components/textarea.vue'
import pwWriter from '@/../../kirby-pagewizard/src/components/writer.vue'
import pwMarkdown from '@/../../kirby-pagewizard/src/components/markdown.vue'
import pwButtons from '@/../../kirby-pagewizard/src/components/buttons.vue'
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';

export default {
	components: {
		pwBlockinfo,
		pwTagline,
		pwHeading,
		pwTextarea,
		pwWriter,
		pwMarkdown,
		pwButtons
	},
	mixins: [pwGridStyle, pwColorStyle],
	data() {
		return {
			settings: {}
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwcardlets');
			this.settings = response.settings;
		} catch (e) {
			this.settings = {};
		}
	}
}
</script>