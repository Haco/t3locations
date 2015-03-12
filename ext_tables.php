<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	't3locations',
	'Search',
	'Location Search'/*,
	'sysext/t3skin/icons/gfx/i/tt_content_search.gif'*/
);

$TCA['tt_content']['types']['list']['subtypes_addlist']['t3locations_search'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('t3locations_search', 'FILE:EXT:t3locations/Configuration/FlexForms/flexform_t3locations_search.xml');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	't3locations',
	'Manager',
	'Location Manager'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('t3locations', 'Configuration/TypoScript', 'Location Tools');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_territory', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_territory.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_region', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_region.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_state', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_state.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_location', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_location.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_locationtype', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_locationtype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_socialmedia', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_socialmedia.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_map', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_map.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_socialmedialink', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_socialmedialink.xlf');

// Add Sprite Icons for different record types (visual distinction)
\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons(
	array(
		'region-default' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_region.gif',
		'region-country' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_region_country.gif',
		'region-region' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_region_region.gif'
	),
	't3locations'
);

if (TYPO3_MODE === 'BE') {
	// Add "Search" plugin to new element wizard
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['t3locations_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3locations') . 'Resources/Private/PHP/class.t3locations_wizicon.php';
}
