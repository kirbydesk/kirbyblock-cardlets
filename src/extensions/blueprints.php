<?php return [ 'blocks/pwcardlets' => function () {

    /* -------------- Config --------------*/
    $config   = pwConfig::load('pwcardlets');
		$settings    = $config['content'];
		$tabSettings = $config['tabs'];
		$defaults    = $config['defaults'];
		$fields      = $config['fields'];
		$editor      = $config['editor'];

    /* -------------- Allowed Fields --------------*/
		$defaultTagline = !empty($settings['tagline']);
		$defaultHeading = !empty($settings['heading']);
		$defaultEditor = !empty($settings['editor']);

		/* -------------- Tabs --------------*/
    $tabs = [];

		/* -------------- Content Tab --------------*/
		$contentFields = [
			'headlineContent' => ['extends' => 'pagewizard/headlines/content'],
		];

		/* -------------- Tagline --------------*/
		if ($defaultTagline) {
			$contentFields['tagline'] = [
				'extends' => 'pagewizard/fields/tagline',
				'align'   => $fields['align-tagline']
			];
		}
		/* -------------- Heading --------------*/
		if ($defaultHeading) {
			$contentFields['heading'] = [
				'extends' => 'pagewizard/fields/heading',
				'align'   => $fields['align-heading']
			];
		}
		/* -------------- Editor --------------*/
		if ($defaultEditor) {
			$contentFields['editor'] = pwEditor::contentField($defaults, $editor, $settings, $fields);
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
