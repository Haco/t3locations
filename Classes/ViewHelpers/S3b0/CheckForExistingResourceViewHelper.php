<?php
namespace TYPO3\CMS\Fluid\ViewHelpers\S3b0;

/**                                                                       *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Class CheckForExistingResourceViewHelper
 *
 * @package TYPO3\CMS\Fluid\ViewHelpers\S3b0
 */
class CheckForExistingResourceViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @param null|string $source
	 * @return boolean
	 */
	public function render($source = NULL) {
		if ( $source === NULL ) {
			$source = $this->renderChildren();
		}

		return file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($source));
	}
}
