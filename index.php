<?php

pwConfig::register('pwcardlets', __DIR__ . '/src/config');

Kirby::plugin('kirbydesk/kirbyblock-cardlets', [

	/* -------------- Extensions --------------*/
	'blueprints' => require_once 'src/extensions/blueprints.php',
	'snippets' => require_once 'src/extensions/snippets.php',
	'translations' => require_once 'src/extensions/translations.php'
]);