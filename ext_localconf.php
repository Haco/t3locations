<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.t3locations',
	'Search',
	array(
		'Action' => 'search',
		'Territory' => 'list',
		'Region' => 'list',
		'Location' => 'list, show',
		'AjaxRequest' => 'getData'
	),
	// non-cacheable actions
	array(
		'Action' => 'search',
		'AjaxRequest' => 'getData'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.t3locations',
	'Manager',
	array(
		'Action' => 'admin',
		'Territory' => 'adminList, new, create, delete, verify',
		'Region' => 'adminList, show, new, create, edit, update, delete, verify',
		'State' => 'adminList, new, create, delete, verify',
		'Location' => 'adminList, show, new, create, edit, update, delete, toggleVisibility, moveRecord',
		'LocationType' => 'adminList, new, create, delete',
		'SocialMedia' => 'adminList, new, create, delete'
	),
	// non-cacheable actions
	array(
		'Action' => 'admin',
		'Territory' => 'adminList, create, delete, verify',
		'Region' => 'adminList, create, update, delete, verify',
		'State' => 'adminList, create, delete, verify',
		'Location' => 'adminList, create, edit, update, delete, toggleVisibility, moveRecord',
		'LocationType' => 'adminList, create, delete',
		'SocialMedia' => 'adminList, create, delete'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('S3b0\\T3locations\\Property\\TypeConverter\\IntegerConverter');

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['t3locations'] = 'EXT:t3locations/Classes/Utility/AjaxDispatcher.php';