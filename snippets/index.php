<?php

// Config
$config    = pwConfig::load('pwcardlets');
$settings  = $config['content'];
$defaults  = $config['defaults'];
$layoutVis = $config['layout'];

// Custom Background
if ($block->content()->theme()->value() === 'custom'):
	snippet('customcss', [
		'blockid' => 'b'.$block->id(),
		'textcolor' => $block->content()->textcolor()->value(),
		'backgroundcolor' => $block->content()->backgroundcolor()->value()
	]);
endif;

// Section
echo '<section';
echo ' data-block="cardlets"';
echo ' data-block-id="b'.$block->id().'"';
echo ' data-margin-top="'.($block->margintop()->toBool() ? 'true' : 'false').'"';
echo ' data-margin-bottom="'.($block->marginbottom()->toBool() ? 'true' : 'false').'"';
echo ' data-padding-top="'.$block->paddingtop()->value().'"';
echo ' data-padding-right="'.($block->paddingright()->toBool() ? 'true' : 'false').'"';
echo ' data-padding-bottom="'.$block->paddingbottom()->value().'"';
echo ' data-padding-left="'.($block->paddingleft()->toBool() ? 'true' : 'false').'"';
echo ' data-radius-top-left="'.($block->radiustopleft()->toBool() ? 'true' : 'false').'"';
echo ' data-radius-top-right="'.($block->radiustopright()->toBool() ? 'true' : 'false').'"';
echo ' data-radius-bottom-right="'.($block->radiusbottomright()->toBool() ? 'true' : 'false').'"';
echo ' data-radius-bottom-left="'.($block->radiusbottomleft()->toBool() ? 'true' : 'false').'"';
echo ' data-style="'.$block->theme()->value().'"';
echo ' data-block-size="'.$block->blocksize()->value().'"';
e(!empty($settings['buttons']) && $block->content()->theme()->value() === 'custom' && $block->buttonstyle()->value() !== 'default', ' data-button-style="' . $block->buttonstyle()->value() . '"');
echo $block->fragment()->isNotEmpty() ? ' id="'.$block->fragment()->value().'"' : '';
echo '>'."\n";

// Grid
echo '<div data-layout="grid"><div data-layout="grid-item"';
echo ' data-grid-size-sm="'.$block->gridsizesm()->value().'"';
echo ' data-grid-size-md="'.$block->gridsizemd()->value().'"';
echo ' data-grid-size-lg="'.$block->gridsizelg()->value().'"';
echo ' data-grid-size-xl="'.$block->gridsizexl()->value().'"';
echo ' data-grid-offset-sm="'.$block->gridoffsetsm()->value().'"';
echo ' data-grid-offset-md="'.$block->gridoffsetmd()->value().'"';
echo ' data-grid-offset-lg="'.$block->gridoffsetlg()->value().'"';
echo ' data-grid-offset-xl="'.$block->gridoffsetxl()->value().'"';
echo '>'."\n";

// Tagline
if (!empty($settings['tagline'])):
	snippet('tagline', ['content' => $block]);
endif;

// Heading
if (!empty($settings['heading'])):
	snippet('heading', ['content' => $block]);
endif;

// Editor
if (!empty($settings['editor'])):
	snippet('editor', ['content' => $block]);
endif;

// Blocks
$items = $block->blocks()->toBlocks();
if ($items->count() > 0):

	echo '<div data-block="items"';
	echo ' data-columns-sm="'.$block->columnssm()->value().'"';
	echo ' data-columns-md="'.$block->columnsmd()->value().'"';
	echo ' data-columns-lg="'.$block->columnslg()->value().'"';
	echo ' data-columns-xl="'.$block->columnsxl()->value().'"';
	echo '>'."\n";

	foreach ($items as $item):
		$itemHeadingRaw = $item->heading()->value();
		$itemHeading    = ($itemHeadingRaw === null || $itemHeadingRaw === '') ? [] : (json_decode($itemHeadingRaw, true) ?? []);
		$itemTaglineRaw = $item->tagline()->value();
		$itemTagline    = ($itemTaglineRaw === null || $itemTaglineRaw === '') ? [] : (json_decode($itemTaglineRaw, true) ?? []);
		$itemEditorRaw  = $item->description()->value();
		$itemEditor     = ($itemEditorRaw === null || $itemEditorRaw === '') ? [] : (json_decode($itemEditorRaw, true) ?? []);

		$htmltag = 'div';
		$link = null;

		// Link Available?
		$link = $item->linkinternal()->value();
		if (!empty($link)) :
			try {
				// Page link
				if (Str::startsWith($link, 'page://')):
					$url = $item->linkinternal()->toPage()?->url() ?? '';

				// File link
				elseif (Str::startsWith($link, 'file://')):
					$url = $item->linkinternal()->toFile()?->url() ?? '';

				// Email link
				elseif (Str::startsWith($link, 'mailto:') || Str::startsWith($link, 'email:')):
					$url = Str::startsWith($link, 'mailto:') ? $link : 'mailto:' . Str::after($link, 'email:');

				// Tel link
				elseif (Str::startsWith($link, 'tel:')):
					$url = $link;

				// Anchor link
				elseif (Str::startsWith($link, '#') || Str::startsWith($link, 'anchor:')):
					$url = Str::startsWith($link, '#') ? $link : '#' . Str::after($link, 'anchor:');

				// Fallback
				else:
					$url = $link;
				endif;

			} catch (Exception $e) {
				$url = '';
			}

			// Aria attributes
			$ariaLabel = $item->arialabel()->isNotEmpty() ? ' aria-label="' . esc($item->arialabel()->value()) . '"' : '';
			$ariaDescribedby = $item->ariadescribedby()->isNotEmpty() ? ' aria-describedby="' . esc($item->ariadescribedby()->value()) . '"' : '';

			// Build link
			$htmltag 	= 'a';
			$link = ' href="'.$url.'"'.$ariaLabel.$ariaDescribedby;
		endif;


		// Start Item output
		if (
			(!empty($settings['item-tagline']) && !empty($itemTagline['text'])) ||
			(!empty($settings['item-heading']) && !empty($itemHeading['text'])) ||
			(!empty($settings['item-editor']) && !empty($itemEditor[$itemEditor['mode'] ?? 'textarea'] ?? ''))
		):
			$itemLinkStyle = $defaults['item-link-style'] ?? 'text';
			// Per-item decoration (falls back to block default 'item-link-decoration')
			$itemDeco = $item->linkDecoration()->or($defaults['item-link-decoration'] ?? 'none')->value();
			echo '<'.$htmltag.$link.' data-block="item"';
				echo ' data-link-style="'.$itemLinkStyle.'"';
				if ($itemLinkStyle === 'button'):
					echo ' data-button-style="'.($defaults['item-button-style'] ?? 'default').'"';
				else:
					echo ' data-link-decoration="'.$itemDeco.'"';
				endif;
				echo ' data-border="'.(!empty($defaults['item-border']) ? 'true' : 'false').'"';
				// Radius enabled ?
				if (!empty($layoutVis['item-radius'])):
					echo ' data-radius-top-left="'.($item->radiustopleft()->toBool() ? 'true' : 'false').'"';
					echo ' data-radius-top-right="'.($item->radiustopright()->toBool() ? 'true' : 'false').'"';
					echo ' data-radius-bottom-left="'.($item->radiusbottomleft()->toBool() ? 'true' : 'false').'"';
					echo ' data-radius-bottom-right="'.($item->radiusbottomright()->toBool() ? 'true' : 'false').'"';
				endif;
			echo '>'."\n";

			// Image (sits flush against the card edge — no padding)
			snippet('image', [
				'file' => $item->image(),
				'size' => null,
				'alignment' => null,
			]);

			//Content (the four item-padding-* values apply HERE so they steer
			// the gap between text and the card's edges / image)
			echo '<div data-field="content">'."\n";

				// Tagline
				if (!empty($settings['item-tagline']) && !empty($itemTagline['text'])):
					echo '<div data-field="tagline" data-align="'.($itemTagline['align'] ?? null).'">'.$itemTagline['text'].'</div>'."\n";
				endif;

				// Heading
				if (!empty($settings['item-heading']) && !empty($itemHeading['text'])):
					$hLevel = $itemHeading['level'] ?? 'div';
					$hSize  = $itemHeading['size']  ?? null;
					$hAlign = $itemHeading['align'] ?? null;
					$hTb    = ($itemHeading['textbackground'] ?? null) === 'enabled';
					echo '<'.$hLevel.' data-field="heading" data-heading-size="'.$hSize.'" data-align="'.$hAlign.'">';
					if ($hTb) echo '<span data-textbackground>';
					echo $itemHeading['text'];
					if ($hTb) echo '</span>';
					echo '</'.$hLevel.'>'."\n";
				endif;

				// Description
				if (!empty($settings['item-editor'])):
					$mode = $itemEditor['mode'] ?? 'textarea';
					$text = $itemEditor[$mode] ?? '';
					if (!empty($text)):
						$eSize  = $itemEditor['size']  ?? 'normal';
						$eAlign = $itemEditor['align'] ?? null;
						$rendered = $mode === 'markdown' ? kirbytext($text) : $text;
						echo '<div data-field="'.$mode.'" data-align="'.$eAlign.'" data-editor-size="'.$eSize.'">'.$rendered.'</div>'."\n";
					endif;
				endif;

				// CTA — visual indicator at the end of the card content. The
				// click is captured by the surrounding <a> so this stays a
				// non-interactive <span>. Rendered only when a link is set.
				// User-entered linkText wins; otherwise fall back to the translation.
				if (!empty($link)):
					$ctaText  = $item->linkText()->isNotEmpty()
						? $item->linkText()->value()
						: t('kirbyblock-cardlets.item.cta', 'Read more');
					$ctaAlign = $item->linkAlign()->or('left')->value();

					// Pull the SVG payload for the chosen decoration (only when it's
					// an icon value; 'none' and 'underline' have no SVG).
					$iconSvg = '';
					if ($itemLinkStyle === 'text' && in_array($itemDeco, ['arrow', 'long-arrow', 'chevron', 'caret'], true)):
						$icons = [
							'arrow'      => "<path d='M5 12h14M13 5l7 7-7 7' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
							'long-arrow' => "<path d='M2 12h19m-5-5l5 5-5 5' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
							'chevron'    => "<polyline points='9 6 15 12 9 18' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>",
							'caret'      => "<path d='M8 5l8 7-8 7z' fill='currentColor'/>",
						];
						$iconSvg = $icons[$itemDeco] ?? '';
					endif;

					echo '<span data-field="cta" data-align="'.$ctaAlign.'">';
					echo esc($ctaText);
					if (!empty($iconSvg)):
						echo '<svg viewBox="0 0 24 24" data-field="cta-icon" aria-hidden="true">'.$iconSvg.'</svg>';
					endif;
					echo '</span>'."\n";
				endif;

			echo '</div>'."\n"; // End Content

			echo '</'.$htmltag.'>'."\n"; // End Item

		endif; // End Item output

	endforeach;

	echo '</div>'."\n"; // End Items
endif;

echo '</div></div>'."\n"; // End Grid
echo '</section>'."\n";