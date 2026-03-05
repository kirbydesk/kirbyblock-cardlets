<template>
	<div class="pwPreview" @dblclick="open">
		<div class="item" @dblclick="open">

			<!-- Image -->
			<pwImage class="pwImage" v-if="content?.image"
				:src="content?.image?.[0]?.url || ''"
				:srcset="content?.image?.[0]?.image?.srcset || ''"
				:image="content?.image?.[0] || null"
			/>

			<div class="pwContent">
				<div v-if="settings['item-tagline'] !== false" class="pwTagline">
					<span v-if="parsedTagline">{{ parsedTagline }}</span>
					<span v-else class="placeholder">{{ $t('kirbyblock-cardlets.item.tagline.placeholder') }}</span>
				</div>

				<div v-if="settings['item-heading'] !== false" class="pwHeading">
					<div v-if="parsedHeading">{{ parsedHeading }}</div>
					<div v-else class="placeholder">
						{{ $t('kirbyblock-cardlets.item.heading.placeholder') }}
					</div>
				</div>

				<div v-if="settings['item-editor'] !== false" class="pwText">
					<div v-if="parsedDescription" v-html="parsedDescription"></div>
					<div v-else class="placeholder">
						{{ $t('kirbyblock-cardlets.item.description.placeholder') }}
					</div>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import pwImage from '@/../../kirby-pagewizard/src/components/image.vue'

export default {
	components: {
		pwImage,
	},
	props: {
		content: Object
	},
	data() {
		return {
			settings: {}
		}
	},
	computed: {
		parsedHeading() {
			const raw = this.content.heading;
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.text || '';
			} catch(e) {
				return raw;
			}
		},
		parsedTagline() {
			const raw = this.content.tagline;
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.text || '';
			} catch(e) {
				return raw;
			}
		},
		parsedDescription() {
			const raw = this.content.description;
			if (!raw) return '';
			try {
				const d = JSON.parse(raw);
				return d.mode ? (d[d.mode] || '') : (d.writer || d.textarea || d.markdown || '');
			} catch(e) {
				return raw;
			}
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwcardlets');
			this.settings = response.settings || {};
		} catch(e) {
			this.settings = {};
		}
	}
}
</script>

<style scoped>
div.item {
  display: flex;
  flex-wrap: nowrap;
	padding: var(--spacing-3) !important;
	font-size: var(--text-sm);

  div.pwImage {
    flex: 0 0 100px;
    align-self: flex-start;
  }

	div.pwContent {
		flex: 1;
		display: flex;
		flex-direction: column;
		gap: var(--spacing-2);
	}
  div.pwTagline {
    font-size: var(--text-xs);
    opacity: 0.6;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  div.pwHeading {
		font-size: var(--text-sm);
    padding: 0 !important;
  }

	div.pwText {
		line-height: 1.2rem;
		opacity: 0.8;
		word-break: break-word;
		overflow-wrap: anywhere;
	}
}
</style>
