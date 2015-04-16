<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedialink',
		'label' => 'social_media',
		'label_alt' => 'link',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'hideTable' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'link,social_media,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_socialmedialink.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, link, social_media',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, link, social_media, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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

		'link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedialink.link',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required',
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
			),
		),
		'social_media' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_socialmedialink.social_media',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('')
				),
				'foreign_table' => 'tx_t3locations_domain_model_socialmedia',
				'minitems' => 1,
				'maxitems' => 1,
			),
		),

		'location' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
