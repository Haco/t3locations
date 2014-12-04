<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location',
		'label' => 'title',
		'label_alt' => 'country',
		'label_alt_force' => TRUE,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'requestUpdate' => 'field_to_use_in_headline,country',

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,logo,freetext,field_to_use_in_search_mask,field_to_use_in_headline,user_defined_headline,contact_person,address,zip,city,phone,facsimile,mobile,email,web,social_media,google_maps,state,country,coverage,region,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3locations') . 'Configuration/TCA/Location.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_location.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, logo, freetext, field_to_use_in_search_mask, field_to_use_in_headline, user_defined_headline, contact_person, address, zip, city, phone, facsimile, mobile, email, web, social_media, google_maps, state, country, coverage, region',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2, freetext, --palette--;Settings;3, --div--;Contact Details, --palette--;;6, google_maps, --div--;Ubiquity, --palette--;;4, --palette--;;5, social_media, --div--;Coverage, coverage, region, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'type, logo'),
		'3' => array('showitem' => 'field_to_use_in_search_mask, field_to_use_in_headline, --linebreak--, user_defined_headline', 'canNotCollapse' => 1),
		'4' => array('showitem' => 'phone, facsimile, mobile', 'canNotCollapse' => 1),
		'5' => array('showitem' => 'email, web', 'canNotCollapse' => 1),
		'6' => array('showitem' => 'contact_person, --linebreak--, address, --linebreak--, city, zip, --linebreak--, country, state', 'canNotCollapse' => 1)
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_t3locations_domain_model_location',
				'foreign_table_where' => 'AND tx_t3locations_domain_model_location.pid=###CURRENT_PID### AND tx_t3locations_domain_model_location.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

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

		'type' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.type',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_t3locations_domain_model_locationtype',
				'minitems' => 1,
				'maxitems' => 1,
				'default' => 3
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'logo' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.logo',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'logo',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'freetext' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.freetext',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'field_to_use_in_search_mask' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.field_to_use_in_search_mask',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('Country', 0),
					array('Coverage', 1),
					array('Region', 2),
					array('Zip', 3),
					array('City', 4)
				),
				'default' => 3
			),
		),
		'field_to_use_in_headline' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.field_to_use_in_headline',
			'config' => array(
				'type' => 'radio',
				'items' => array(
					array('Company name', 0),
					array('Country', 1),
					array('Region', 2),
					array('User-defined', 3),
					array('Leave empty', 4),
				),
			),
		),
		'user_defined_headline' => array(
			'displayCond' => 'FIELD:field_to_use_in_headline:=:3',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.user_defined_headline',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact_person' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.contact_person',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.address',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.zip',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.city',
			'config' => array(
				'type' => 'input',
				'size' => 19,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.phone',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'facsimile' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.facsimile',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'mobile' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.mobile',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'email' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.email',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim',
				'wizards'  => array(
					'_PADDING' => 5,
					'link'  => array(
						'type'          => 'popup',
						'title'         => 'Link',
						'icon'          => 'link_popup.gif',
						'module'        => array(
							'name' => 'wizard_element_browser',
							'urlParameters' => array(
								'mode' => 'wizard'
							)
						),
/**
 * 						'params' => array (
 *							'target' => '_blank',
 *							'blindLinkOptions' => 'url,page,file,spec,folder,upload,media_upload',
 *						),
 */
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				),
			)
		),
		'web' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.web',
			'config' => array(
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim',
				'wizards'  => array(
					'_PADDING' => 5,
					'link'  => array(
						'type'          => 'popup',
						'title'         => 'Link',
						'icon'          => 'link_popup.gif',
						'module'        => array(
							'name' => 'wizard_element_browser',
							'urlParameters' => array(
								'mode' => 'wizard'
							)
						),
/**
 * 						'params' => array (
 *							'target' => '_blank',
 *							'blindLinkOptions' => 'file,mail,spec,folder,upload,media_upload',
 *						),
 */
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				),
			)
		),
		'social_media' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.social_media',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_t3locations_domain_model_socialmedialink',
				'foreign_field' => 'location',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'google_maps' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.google_maps',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_t3locations_domain_model_map',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'state' => array(
			'displayCond' => 'FIELD:country:REQ:TRUE',
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.state',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('')
				),
				'foreign_table' => 'tx_t3locations_domain_model_state',
				'foreign_table_where' => 'AND tx_t3locations_domain_model_state.sys_language_uid IN (-1,0) AND tx_t3locations_domain_model_state.country=###REC_FIELD_country###',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'country' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.country',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('')
				),
				'foreign_table' => 'tx_t3locations_domain_model_country',
				'foreign_table_where' => 'AND tx_t3locations_domain_model_country.sys_language_uid IN (-1,0)',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'coverage' => array(
			'displayCond' => 'FIELD:country:REQ:TRUE',
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.coverage',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_t3locations_domain_model_country',
				'foreign_table_where' => 'AND tx_t3locations_domain_model_country.sys_language_uid IN (-1,0)',
				'MM' => 'tx_t3locations_location_country_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'wizards' => array(
					'_PADDING' => 10,
					'_VALIGN' => 'middle',
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'region' => array(
			'l10n_mode' => 'exclude',
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_location.region',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('')
				),
				'foreign_table' => 'tx_t3locations_domain_model_region',
				'foreign_table_where' => 'AND tx_t3locations_domain_model_region.sys_language_uid IN (-1,0)',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

	),
);
