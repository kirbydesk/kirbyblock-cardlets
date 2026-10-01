<?php

$columnsField = fn(string $breakpoint, $default) => [
	'extends' => 'pagewizard/fields/columns',
	'default' => $default,
	'label'   => 'pw.field.columns.' . $breakpoint,
];


return [

	/* ============================================================================
	   Main Block
	============================================================================ */

	'blocks/pwcardlets' => pwBlueprint::main('pwcardlets', function ($cfg) use ($columnsField) {
		$defaults = $cfg['defaults'];
		// the texts' position on the image: the options the project allows
		$textPositions = array_values(array_intersect_key(
			[
				'top'    => ['value' => 'top',    'text' => ['*' => 'kirbyblock-cardlets.card-text-position.top']],
				'bottom' => ['value' => 'bottom', 'text' => ['*' => 'kirbyblock-cardlets.card-text-position.bottom']],
			],
			array_flip($cfg['style']['card-text-position']['options'] ?? ['top', 'bottom'])
		));
		return [
			'name' => 'kirbyblock-cardlets.name',
			'icon' => 'cardlets',
			'contentFields' => array_merge(
				pwBlueprint::stdContent($cfg, ['tagline', 'heading', 'editor']),
				[
					'blocks' => [
						'extends'   => 'pagewizard/fields/blocks',
						'label'     => 'kirbyblock-cardlets.items',
						'fieldsets' => ['pwcardletsitem'],
					],
				]
			),
			// the cards: image above the texts, the texts on the image, or the
			// image standing out of the card at the top (their values: Project
			// Wizard → Design › Display)
			'styleExtras' => [
				'cardDisplay' => [
					'label'   => 'kirbyblock-cardlets.card-display',
					'type'    => 'toggles',
					'default' => $defaults['card-display'] ?? 'stacked',
					'options' => [
						['value' => 'stacked', 'text' => ['*' => 'kirbyblock-cardlets.card-display.stacked']],
						['value' => 'overlay', 'text' => ['*' => 'kirbyblock-cardlets.card-display.overlay']],
						['value' => 'overhang', 'text' => ['*' => 'kirbyblock-cardlets.card-display.overhang']],
					],
				],
				// on the image: the texts at the top or bottom (the block's own –
				// it depends on its images; one option allowed: fixed, no field)
				'cardTextPosition' => count($textPositions) <= 1
					? ['type' => 'hidden', 'default' => $defaults['card-text-position'] ?? 'bottom']
					: [
						'label'   => 'kirbyblock-cardlets.card-text-position',
						'type'    => 'toggles',
						'default' => $defaults['card-text-position'] ?? 'bottom',
						'options' => $textPositions,
						'when'    => ['cardDisplay' => 'overlay'],
					],
			],
			'layoutExtras' => [
				'headlineColumns' => ['extends' => 'pagewizard/headlines/columns'],
				'columnsSm'       => $columnsField('sm', $defaults['columns-sm']),
				'columnsMd'       => $columnsField('md', $defaults['columns-md']),
				'columnsLg'       => $columnsField('lg', $defaults['columns-lg']),
				'columnsXl'       => $columnsField('xl', $defaults['columns-xl']),
			],
		];
	}),

	/* ============================================================================
	   Item Blueprint
	============================================================================ */

	'blocks/pwcardletsitem' => function () {

		$config       = pwConfig::load('pwcardlets');
		$fields       = $config['fields'];
		$editor       = $config['editor'];
		$settings     = $config['content'];
		$fieldOptions = $config['field-options'];
		$defaults     = $config['defaults'];
		$layoutVis    = $config['layout'];

		$itemFields = [
			'headlineContent' => ['extends' => 'pagewizard/headlines/content'],
		];

		if (!empty($settings['item-tagline'])) {
			$itemFields['tagline'] = [
				'extends'      => 'pagewizard/fields/tagline',
				'label'        => 'kirbyblock-cardlets.item.tagline',
				'align'        => $fields['align-item-tagline'] ?? $fields['align-tagline'] ?? null,
				'alignOptions' => $fieldOptions['item-tagline']['align'] ?? $fieldOptions['tagline']['align'] ?? null,
			];
		}

		if (!empty($settings['item-heading'])) {
			$itemFields['heading'] = [
				'extends'      => 'pagewizard/fields/heading',
				'label'        => 'kirbyblock-cardlets.item.heading',
				'align'        => $fields['align-item-heading'] ?? $fields['align-heading'] ?? null,
				'level'        => $fields['level-item-heading'] ?? $fields['level-heading'] ?? null,
				'size'         => $fields['size-item-heading'] ?? $fields['size-heading'] ?? null,
				'sizeOptions'  => $fieldOptions['item-heading']['sizes'] ?? $fieldOptions['heading']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['item-heading']['align'] ?? $fieldOptions['heading']['align'] ?? null,
				'levelOptions' => $fieldOptions['item-heading']['level'] ?? $fieldOptions['heading']['level'] ?? null,
				// the marking (looks good on the image especially)
				'textbackground'        => $fields['textbackground-item-heading'] ?? $fields['textbackground-heading'] ?? null,
				'textbackgroundOptions' => $fieldOptions['item-heading']['textbackground'] ?? $fieldOptions['heading']['textbackground'] ?? null,
			];
		}

		if (!empty($settings['item-editor'])) {
			$itemEditorSettings = array_merge($settings, ['editor' => $settings['item-editor']]);
			$itemFields['description'] = pwEditor::contentField($editor, $itemEditorSettings);
			$itemFields['description']['label']        = 'kirbyblock-cardlets.item.description';
			$itemFields['description']['align']        = $fields['align-item-editor'] ?? $fields['align-editor'] ?? null;
			$itemFields['description']['size']         = $fields['size-item-editor'] ?? $fields['size-editor'] ?? null;
			$itemFields['description']['alignOptions'] = $fieldOptions['item-editor']['align'] ?? $fieldOptions['editor']['align'] ?? null;
			$itemFields['description']['sizeOptions']  = $fieldOptions['item-editor']['sizes'] ?? $fieldOptions['editor']['sizes'] ?? null;
			$itemFields['description']['defaultMode']  = $fields['mode-item-editor'] ?? $fields['mode-editor'] ?? null;
		}

		$item = [
			'name' => 'kirbyblock-cardlets.item',
			'icon' => 'item',
			'tabs' => [
				'content' => [
					'label'  => 'pw.tab.content',
					'fields' => $itemFields,
				],
				'style' => [
					'label'  => 'pw.tab.style',
					'fields' => [
						'headlineStyle' => ['extends' => 'pagewizard/headlines/style'],
						'image' => [
							'extends' => 'pagewizard/fields/image',
							'label'   => 'pw.file.image',
							'uploads' => 'pwImage',
							'query'   => 'page.images.template("pwImage")'
						],
					],
				],
				'link' => [
					'label'  => 'pw.tab.link',
					'fields' => [
						'headlineLink' => ['extends' => 'pagewizard/headlines/link'],
						'linkInternal' => [
							'extends' => 'pagewizard/fields/link-internal',
							'width'   => '1/1'
						],
						'linkText' => [
							'extends'     => 'pagewizard/fields/link-text',
							'placeholder' => 'kirbyblock-cardlets.item.cta',
							'width'       => '2/3'
						],
						'linkAlign'       => ['extends' => 'pagewizard/fields/link-align', 'required' => false],
						'ariaLabel'       => ['extends' => 'pagewizard/fields/link-aria-label'],
						'ariaDescribedby' => ['extends' => 'pagewizard/fields/link-aria-describedby'],
					],
				],
			],
		];

		// the card's fields hidden from the editors (Project Wizard → Visibility,
		// its items: item-tagline, item-heading, item-editor) keep their values
		$itemNames = ['item-tagline' => 'tagline', 'item-heading' => 'heading', 'item-editor' => 'description'];
		$hidden    = array_values(array_intersect_key($itemNames, array_flip($config['hidden'] ?? [])));
		$item['tabs'] = pwBlueprint::hideFields($item['tabs'], $hidden);

		return $item;
	},
];
