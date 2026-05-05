<?php return [ 'blocks/pwcardlets' => function () {

    /* -------------- Config --------------*/
    $config       = pwConfig::load('pwcardlets');
		$settings     = $config['content'];
		$tabSettings  = $config['tabs'];
		$defaults     = $config['defaults'];
		$fields       = $config['fields'];
		$editor       = $config['editor'];
		$fieldOptions = $config['field-options'];


		/* -------------- Tabs --------------*/
    $tabs = [];

		/* -------------- Content Tab --------------*/
		$contentFields = [
			'headlineContent' => ['extends' => 'pagewizard/headlines/content'],
		];

		/* -------------- Tagline --------------*/
		if (!empty($settings['tagline'])) {
			$contentFields['tagline'] = [
				'extends'      => 'pagewizard/fields/tagline',
				'align'        => $fields['align-tagline'],
				'alignOptions' => $fieldOptions['tagline']['align'] ?? null,
			];
		}
		/* -------------- Heading --------------*/
		if (!empty($settings['heading'])) {
			$contentFields['heading'] = [
				'extends'      => 'pagewizard/fields/heading',
				'align'        => $fields['align-heading'],
				'level'        => $fields['level-heading'] ?? null,
				'size'         => $fields['size-heading'] ?? null,
				'sizeOptions'  => $fieldOptions['heading']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['heading']['align'] ?? null,
				'levelOptions' => $fieldOptions['heading']['level'] ?? null,
				'textbackground'        => $fields['textbackground-heading'] ?? null,
				'textbackgroundOptions' => $fieldOptions['heading']['textbackground'] ?? null,
			];
		}
		/* -------------- Editor --------------*/
		if (!empty($settings['editor'])) {
			$contentFields['editor'] = pwEditor::contentField($editor, $settings);
			$contentFields['editor']['align']        = $fields['align-editor'] ?? null;
			$contentFields['editor']['size']         = $fields['size-editor'] ?? null;
			$contentFields['editor']['alignOptions'] = $fieldOptions['editor']['align'] ?? null;
			$contentFields['editor']['sizeOptions']  = $fieldOptions['editor']['sizes'] ?? null;
			$contentFields['editor']['defaultMode'] = $fields['mode-editor'] ?? null;
		}
		/* -------------- Blocks --------------*/
		$contentFields['blocksAlignment'] = [
			'type'         => 'pwalign',
			'align'        => $fields['align-blocks'],
			'default'      => $fields['align-blocks'],
			'alignOptions' => $fieldOptions['blocks']['align'] ?? null,
		];
		$contentFields['blocks'] = [
			'extends'   => 'pagewizard/fields/blocks',
			'label'   => 'kirbyblock-cardlets.items',
			'fieldsets' => ['pwcardletsitem'],
		];

		$tabs['content'] = [
			'label'  => 'pw.tab.content',
			'fields' => $contentFields,
		];

		/* -------------- Layout Tab --------------*/
		pwConfig::addTab($tabs, 'layout', $tabSettings['layout'] ?? true, pwLayout::options('pwcardlets', $defaults, [
		'headlineColumns' => ['extends' => 'pagewizard/headlines/columns'],
			'columnsSm' => [
				'extends' => 'pagewizard/fields/columns',
				'default' => $defaults['columns-sm'],
				'label' => 'pw.field.columns.sm',
				'help' => 'pw.field.columns.sm.help'
			],
			'columnsMd' => [
				'extends' => 'pagewizard/fields/columns',
				'default' => $defaults['columns-md'],
				'label' => 'pw.field.columns.md',
				'help' => 'pw.field.columns.md.help'
			],
			'columnsLg' => [
				'extends' => 'pagewizard/fields/columns',
				'default' => $defaults['columns-lg'],
				'label' => 'pw.field.columns.lg',
				'help' => 'pw.field.columns.lg.help'
			],
			'columnsXl' => [
				'extends' => 'pagewizard/fields/columns',
				'default' => $defaults['columns-xl'],
				'label' => 'pw.field.columns.xl',
				'help' => 'pw.field.columns.xl.help'
			]
		], $config['layout'] ?? []));

		/* -------------- Style Tab --------------*/
		pwConfig::addTab($tabs, 'style', $tabSettings['style'] ?? true, pwStyle::options('pwcardlets', $defaults, [], $config['style'] ?? []));

		/* -------------- Grid Tab --------------*/
		pwConfig::addTab($tabs, 'grid', $tabSettings['grid'] ?? false, pwGrid::layout('pwcardlets', $defaults));

		/* -------------- Settings Tab --------------*/
		pwConfig::addTab($tabs, 'settings', $tabSettings['settings'] ?? true, pwSettings::options('pwcardlets', $defaults, [], $config['settings'] ?? []));

		/* -------------- Blueprint --------------*/
		return [
			'name'	=> 'kirbyblock-cardlets.name',
			'icon'  => 'cardlets',
			'tabs'	=> $tabs
		];
	},

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

		/* -------------- Tagline --------------*/
		if (!empty($settings['item-tagline'])) {
			$itemFields['tagline'] = [
				'extends'      => 'pagewizard/fields/tagline',
				'label'        => 'kirbyblock-cardlets.item.tagline',
				'align'        => $fields['align-item-tagline'] ?? $fields['align-tagline'] ?? null,
				'alignOptions' => $fieldOptions['item-tagline']['align'] ?? $fieldOptions['tagline']['align'] ?? null,
			];
		}

		/* -------------- Heading --------------*/
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

		/* -------------- Editor (description) --------------*/
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
							'type' => 'headline',
							'label' => 'kirbyblock-cardlets.item.headline.radius',
							'help' => 'kirbyblock-cardlets.item.headline.radius.help'
						],
						'radiusTopLeft' => [
							'extends' => 'pagewizard/fields/toggle',
							'default' => $defaults['item-radius-top-left'] ?? false,
							'label' => 'pw.field.radius-top-left',
							'help' => 'kirbyblock-cardlets.item.radius-top-left.help'
						],
						'radiusTopRight' => [
							'extends' => 'pagewizard/fields/toggle',
							'default' => $defaults['item-radius-top-right'] ?? false,
							'label' => 'pw.field.radius-top-right',
							'help' => 'kirbyblock-cardlets.item.radius-top-right.help'
						],
						'radiusBottomLeft' => [
							'extends' => 'pagewizard/fields/toggle',
							'default' => $defaults['item-radius-bottom-left'] ?? false,
							'label' => 'pw.field.radius-bottom-left',
							'help' => 'kirbyblock-cardlets.item.radius-bottom-left.help'
						],
						'radiusBottomRight' => [
							'extends' => 'pagewizard/fields/toggle',
							'default' => $defaults['item-radius-bottom-right'] ?? false,
							'label' => 'pw.field.radius-bottom-right',
							'help' => 'kirbyblock-cardlets.item.radius-bottom-right.help'
						]
					],
				]] : []),
				'style' => [
					'label'  => 'pw.tab.style',
					'fields' => [
						'headlineStyle' => ['extends' => 'pagewizard/headlines/style'],
						'image' => [
							'extends' => 'pagewizard/fields/image',
							'label' => 'pw.file.image',
							'uploads' => 'pwImage',
							'query' => 'page.images.template("pwImage")'
						],
					],
				],
				'link' => [
					'label'  => 'pw.tab.link',
					'fields' => [
						'headlineLink' => [
							'extends' => 'pagewizard/headlines/link'
						],
						'linkInternal' => [
  						'extends' => 'pagewizard/fields/link-internal',
							'width' => '1/1',
							'required' => false
						],
						'ariaLabel' => [
							'extends' => 'pagewizard/fields/link-aria-label'
						],
						'ariaDescribedby' => [
							'extends' => 'pagewizard/fields/link-aria-describedby'
						],
					],
				],
			],
		];
	},
];
