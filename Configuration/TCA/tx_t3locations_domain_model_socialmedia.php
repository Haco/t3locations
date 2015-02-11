<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY title',
		'rootLevel' => 1,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,mode,icon_or_class_name,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3locations') . 'Configuration/TCA/SocialMedia.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_socialmedia.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, title, mode, icon_or_class_name',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, title, mode, icon_or_class_name, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'mode' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia.mode',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia.mode.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia.mode.I.1', 1)
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'icon_or_class_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedia.icon_or_class_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),

	),
);
