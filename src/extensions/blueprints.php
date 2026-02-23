<?php return [ 'blocks/pwcardlets' => function () {

    /* -------------- Config --------------*/
    $config   = pwConfig::load('pwcardlets');
		$settings    = $config['settings'];
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
		$tabs['layout'] = pwLayout::options('pwcardlets', $defaults);

		/* -------------- Style Tab --------------*/
		$tabs['style'] = pwStyle::options('pwcardlets', $defaults);

		/* -------------- Common Tabs (grid, spacing, theme) --------------*/
		pwConfig::buildTabs('pwcardlets', $defaults, $tabSettings, $tabs);

		/* -------------- Settings Tab --------------*/
		$tabs['settings'] = pwSettings::options('pwcardlets', $defaults);

		/* -------------- Blueprint --------------*/
		return [
			'name'	=> 'kirbyblock-cardlets.name',
			'icon'  => 'cardlets',
			'tabs'	=> $tabs
		];
	}
];
