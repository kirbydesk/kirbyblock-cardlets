<?php

// Config
$config   = pwConfig::load('pwcardlets');
$settings = $config['settings'];

// Custom Background
if ($block->content()->style()->value() === 'custom'):
	echo '<style>section[data-block-id="b'.$block->id().'"] { color: '.$block->content()->textcolor()->value().'; background-color: '.$block->content()->backgroundcolor()->value().' }</style>';
endif;

// Section
echo '<section';
echo ' data-block="cardlets"';
echo ' data-block-id="b'.$block->id().'"';
echo ' data-margin-top="'.$block->margintop()->value().'"';
echo ' data-margin-bottom="'.$block->marginbottom()->value().'"';
echo ' data-padding-top="'.$block->paddingtop()->value().'"';
echo ' data-padding-right="'.$block->paddingright()->value().'"';
echo ' data-padding-bottom="'.$block->paddingbottom()->value().'"';
echo ' data-padding-left="'.$block->paddingleft()->value().'"';
echo ' data-style="'.$block->style()->value().'"';
echo ' data-block-size="'.$block->blocksize()->value().'"';
e(!empty($settings['buttons']) && $block->content()->style()->value() === 'custom' && $block->buttonstyle()->value() === 'variant', ' data-button-style="variant"');
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

echo '</div></div>'."\n"; // End Grid
echo '</section>'."\n";