<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	't3locations',
	'Search',
	'Location Search'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	't3locations',
	'Manager',
	'Location Manager'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('t3locations', 'Configuration/TypoScript', 'Location Tools');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_territory', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_territory.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_country', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_country.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_region', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_region.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_state', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_state.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_location', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_location.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_locationtype', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_locationtype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_socialmedia', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_socialmedia.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_map', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_map.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3locations_domain_model_socialmedialink', 'EXT:t3locations/Resources/Private/Language/locallang_csh_tx_t3locations_domain_model_socialmedialink.xlf');
