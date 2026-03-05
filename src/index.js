// Blocks
import pwcardlets from "@/blocks/index.vue";
import pwcardletsitem from "@/blocks/item.vue";

// Render
panel.plugin("kirbydesk/kirbyblock-cardlets", {
	blocks: {
		pwcardlets: pwcardlets,
		pwcardletsitem: pwcardletsitem
  }
});
