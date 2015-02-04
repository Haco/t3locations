<?php
	/***************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2013 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 2 of the License, or
	 *  (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

	/**
	 * Add news extension to the wizard in page module
	 *
	 * @package TYPO3
	 * @subpackage t3locations
	 */
	class t3locations_wizicon {

		/**
		 * Processing the wizard items array
		 *
		 * @param array $wizardItems The wizard items
		 * @return array array with wizard items
		 */
		public function proc($wizardItems) {
			$wizardItems['plugins_tx_t3locations'] = array(
				'icon'			=> \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3locations') . 'ext_icon@2x.png',
				'title'			=> $GLOBALS['LANG']->sL('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xml:pi_title'),
				'description'	=> $GLOBALS['LANG']->sL('LLL:EXT:t3locations/Resources/Private/Language/locallang_db.xml:pi_plus_wiz_description'),
				'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=t3locations_search'
			);

			return $wizardItems;
		}
	}

	if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/t3locations/Resources/Private/PHP/class.t3locations_wizicon.php']) {
		include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/t3locations/Resources/Private/PHP/class.t3locations_wizicon.php']);
	}

?>