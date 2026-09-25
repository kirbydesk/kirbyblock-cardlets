<?php

$columnsField = fn(string $breakpoint, $default) => [
	'extends' => 'pagewizard/fields/columns',
	'default' => $default,
	'label'   => 'pw.field.columns.' . $breakpoint,
	'help'    => 'pw.field.columns.' . $breakpoint . '.help',
];

$radiusToggle = fn(string $slug, $default) => [
	'extends' => 'pagewizard/fields/toggle',
	'default' => $default,
	'label'   => 'pw.field.radius-' . $slug,
	'help'    => 'kirbyblock-cardlets.item.radius-' . $slug . '.help',
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

	'blocks/pwcardletsitem' => function () use ($radiusToggle) {

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

		return [
			'name' => 'kirbyblock-cardlets.item',
			'icon' => 'item',
			'tabs' => [
				'content' => [
					'label'  => 'pw.tab.content',
					'fields' => $itemFields,
				],
				...(!empty($layoutVis['item-radius']) ? ['layout' => [
					'label'  => 'pw.tab.layout',
					'fields' => [
						'headlineCardletRadius' => [
							'type'  => 'headline',
							'label' => 'kirbyblock-cardlets.item.headline.radius',
							'help'  => 'kirbyblock-cardlets.item.headline.radius.help'
						],
						'radiusTopLeft'     => $radiusToggle('top-left',     $defaults['item-radius-top-left']     ?? false),
						'radiusTopRight'    => $radiusToggle('top-right',    $defaults['item-radius-top-right']    ?? false),
						'radiusBottomLeft'  => $radiusToggle('bottom-left',  $defaults['item-radius-bottom-left']  ?? false),
						'radiusBottomRight' => $radiusToggle('bottom-right', $defaults['item-radius-bottom-right'] ?? false),
					],
				]] : []),
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
	},
];
