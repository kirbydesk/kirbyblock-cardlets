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

		$tabs['content'] = [
			'label'  => 'pw.tab.content',
			'fields' => $contentFields,
		];

		/* -------------- Layout Tab --------------*/
		pwConfig::addTab($tabs, 'layout', $tabSettings['layout'] ?? true, pwLayout::options('pwcardlets', $defaults, [], $config['layout'] ?? []));

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
	}
];
