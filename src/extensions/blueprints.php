<?php

$columnsField = fn(string $breakpoint, $default) => [
	'extends' => 'pagewizard/fields/columns',
	'default' => $default,
	'label'   => 'pw.field.columns.' . $breakpoint,
	'help'    => 'pw.field.columns.' . $breakpoint . '.help',
];


return [

	/* ============================================================================
	   Main Block
	============================================================================ */

	'blocks/pwcardlets' => pwBlueprint::main('pwcardlets', function ($cfg) use ($columnsField) {
		$defaults = $cfg['defaults'];
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
			// the cards: image above the texts, the texts on the image (then
			// their position, the cards' ratio and the overlay's strength), or
			// the image standing out of the card at the top
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
				'cardTextPosition' => [
					'label'   => 'kirbyblock-cardlets.card-text-position',
					'type'    => 'toggles',
					'default' => $defaults['card-text-position'] ?? 'bottom',
					'options' => [
						['value' => 'top',    'text' => ['*' => 'pw.option.top']],
						['value' => 'bottom', 'text' => ['*' => 'pw.option.bottom']],
					],
					'width'   => '1/2',
					'when'    => ['cardDisplay' => 'overlay'],
				],
				'cardRatio' => [
					'label'   => 'kirbyblock-cardlets.card-ratio',
					'type'    => 'toggles',
					'default' => $defaults['card-ratio'] ?? '4/5',
					'options' => array_map(fn($r) => ['value' => $r, 'text' => str_replace('/', ':', $r)], ['1/1', '4/5', '3/4', '2/3', '4/3', '16/9']),
					'width'   => '1/2',
					'when'    => ['cardDisplay' => 'overlay'],
				],
				'cardOverlay' => [
					'label'   => 'kirbyblock-cardlets.card-overlay',
					'type'    => 'toggles',
					'default' => $defaults['card-overlay'] ?? '50',
					'options' => array_map(fn($v) => ['value' => $v, 'text' => $v . ' %'], ['0', '25', '50', '75']),
					'help'    => 'kirbyblock-cardlets.card-overlay.help',
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
