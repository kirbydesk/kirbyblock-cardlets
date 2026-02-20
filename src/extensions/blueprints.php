<?php return [ 'blocks/pwcardlets' => function () {

    /* -------------- Config --------------*/
    $config   = pwConfig::load('pwcardlets');
    $settings = $config['settings'];
    $defaults = $config['defaults'];

    /* -------------- Text Mode --------------*/
    $mode    = $defaults['text-mode'] ?? null;
    $mode    = is_string($mode) ? strtolower(trim($mode)) : null;
    $allowed = ['textarea', 'writer', 'markdown'];
    $type    = in_array($mode, $allowed, true) ? $mode : 'textarea';

    /* -------------- Allowed Fields --------------*/
    $defaultHeading = !empty($settings['heading']);
    $defaultTagline = !empty($settings['tagline']);
		$defaultButtons = !empty($settings['buttons']);

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
			];
		}
		/* -------------- Heading --------------*/
		if ($defaultHeading) {
			$contentFields['heading'] = [
				'extends' => 'pagewizard/fields/heading',
			];
		}
		/* -------------- Texts --------------*/
		$contentFields['textTextarea'] = [
			'extends' => 'pagewizard/fields/text-textarea',
			'when'    => ['textMode' => 'textarea'],
		];
		$contentFields['textWriterAlignment'] = [
			'type' => 'pwalign',
			'default' => $defaults['text-alignment'] ?? 'left',
			'when'    => ['textMode' => 'writer'],
		];
		$contentFields['textWriter'] = [
			'extends' => 'pagewizard/fields/text-writer',
			'when'    => ['textMode' => 'writer'],
		];
		$contentFields['textMarkdownAlignment'] = [
			'type' => 'pwalign',
			'default' => $defaults['text-alignment'] ?? 'left',
			'when'    => ['textMode' => 'markdown'],
		];
		$contentFields['textMarkdown'] = [
			'extends' => 'pagewizard/fields/text-markdown',
			'when'    => ['textMode' => 'markdown'],
		];

		/* -------------- Buttons --------------*/
		if ($defaultButtons) {
			$contentFields['buttonsAlignment'] = [
				'type' => 'pwalign',
				'default' => $defaults['buttons-alignment'] ?? 'left',
			];
			$contentFields['buttons'] = [
				'extends' => 'blocks/pwButtons',
			];
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
		pwConfig::buildTabs('pwcardlets', $defaults, $settings, $tabs);

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
