<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY title',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'hideTable' => TRUE,
		'requestUpdate' => 'map_type_control,zoom_control',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,coordinates,link_query_param,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'Resources/Public/Icons/tx_t3locations_domain_model_map.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, coordinates, link_query_param',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, coordinates, link_query_param, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended, map_type, --palette--;LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control.palette;2, --palette--;LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom.palette;4, --palette--;LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.additional_features;3, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'map_type_control, map_type_control_style, map_type_control_position', 'canNotCollapse' => 1),
		'3' => array('showitem' => 'background_color, --linebreak--, additional_features', 'canNotCollapse' => 1),
		'4' => array('showitem' => 'zoom, zoom_control, zoom_control_style, zoom_control_position', 'canNotCollapse' => 1)
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
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'coordinates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.coordinates',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,nospace',
				'placeholder' => '0.0,0.0'
			),
		),
		'link_query_param' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.link_query_param',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'background_color' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.background_color',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim',
				'default' => 'white',
				'wizards' => array(
					'colorChoice' => array(
						'type' => 'colorbox',
						'title' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.colorPick',
						'module' => array(
							'name' => 'wizard_colorpicker',
						),
						'dim' => '20x20',
						'tableStyle' => 'border: solid 1px black; margin-left: 20px;',
						'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
						'exampleImg' => 'EXT:examples/res/images/japanese_garden.jpg',
					)
				)
			),
		),
		'map_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type.I.1', 1),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type.I.2', 2),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type.I.3', 3)
				)
			),
		),
		'map_type_control' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control',
			'config' => array(
				'type' => 'check',
				'default' => 1
			),
		),
		'map_type_control_style' => array(
			'displayCond' => 'FIELD:map_type_control:REQ:TRUE',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_style',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_style.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_style.I.1', 1),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_style.I.2', 2)
				),
				'default' => '2'
			),
		),
		'map_type_control_position' => array(
			'displayCond' => 'FIELD:map_type_control:REQ:TRUE',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.1', 1),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.2', 2),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.3', 3),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.4', 4),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.5', 5),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.6', 6),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.7', 7),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.8', 8),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.9', 9),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.10', 10),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.11', 11)
				),
				'default' => '11'
			),
		),
		'zoom' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int,trim,required',
				'range' => array(
					'lower' => 0,
					'upper' => 20
				),
				'default' => '8'
			),
		),
		'zoom_control' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control',
			'config' => array(
				'type' => 'check',
				'default' => 1
			),
		),
		'zoom_control_style' => array(
			'displayCond' => 'FIELD:zoom_control:REQ:TRUE',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control_style',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control_style.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control_style.I.1', 1),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control_style.I.2', 2)
				),
				'default' => '0'
			),
		),
		'zoom_control_position' => array(
			'displayCond' => 'FIELD:zoom_control:REQ:TRUE',
			'exclude' => 1,
			'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.zoom_control_position',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.0', 0),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.1', 1),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.2', 2),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.3', 3),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.4', 4),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.5', 5),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.6', 6),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.7', 7),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.8', 8),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.9', 9),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.10', 10),
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.map_type_control_position.I.11', 11)
				),
				'default' => '4'
			),
		),
		'additional_features' => array(
			'exclude' => 0,
			/*'label' => 'LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.additional_features',*/
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.disable_double_click_zoom'), // 0
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.draggable'),                 // 1
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.overview_map_control'),      // 0
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.pan_control'),               // 0
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.rotate_control'),            // 0
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.scale_control'),             // 0
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.scrollwheel'),               // 1
					array('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xlf:tx_t3locations_domain_model_map.street_view_control'),       // 1
				),
				'cols' => 3,
				'default' => 194
			),
		),

	),
);
