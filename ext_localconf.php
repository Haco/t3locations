<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.t3locations',
	'Search',
	array(
		'Standard' => 'search',
		'Territory' => 'list',
		'Region' => 'list',
		'Location' => 'list, show'
	),
	// non-cacheable actions
	array(
		'Standard' => 'search',
		'Territory' => 'create, update, delete',
		'Region' => 'create, update, delete',
		'State' => 'create, update, delete',
		'Location' => 'create, update, delete',
		'LocationType' => 'create, update, delete',
		'SocialMedia' => 'create, update, delete'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.t3locations',
	'Manager',
	array(
		'Standard' => 'search, admin',
		'Territory' => 'list, show, new, create, edit, update, delete',
		'Region' => 'list, show, new, create, edit, update, delete',
		'State' => 'list, show, new, create, edit, update, delete',
		'Location' => 'list, show, new, create, edit, update, delete',
		'LocationType' => 'list, show, new, create, edit, update, delete',
		'SocialMedia' => 'list, show, new, create, edit, update, delete'
	),
	// non-cacheable actions
	array(
		'Standard' => 'search',
		'Territory' => 'create, update, delete',
		'Region' => 'create, update, delete',
		'State' => 'create, update, delete',
		'Location' => 'create, update, delete',
		'LocationType' => 'create, update, delete',
		'SocialMedia' => 'create, update, delete'
	)
);
