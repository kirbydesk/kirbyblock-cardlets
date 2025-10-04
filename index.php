<?php

	// Show error if "kirby-fields" is not installed
	if (!Kirby::plugin('chrfickinger/kirby-fields')) {
		die('Plugin "kirby-fields" required! Please install it first.');
	}

	Kirby::plugin('chrfickinger/kirbyblock-cardlets', [

]);