<template>
	<!-- the block in the panel: its info bar and the shared preview of the
	     Project Wizard (the project's look, the real cards); a double click
	     opens the block -->
	<div class="pwPreview" data-kirbyblock="cardlets" @dblclick="open">

		<pwBlockinfo
			:value="$t('kirbyblock-cardlets.name')"
			:design="'pwcardlets'"
			icon="cardlets"
		/>

		<pw-block-panel-preview type="pwcardlets" :content="content" />

	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';

export default {
	components: {
		pwBlockinfo
	}
}
</script>
