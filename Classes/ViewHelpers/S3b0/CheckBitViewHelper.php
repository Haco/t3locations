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
 * Class CheckBitViewHelper
 *
 * @package TYPO3\CMS\Fluid\ViewHelpers\S3b0
 */
class CheckBitViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @param integer $value
	 * @param integer $bit
	 * @return boolean
	 */
	public function render($value = NULL, $bit = 0) {
		if ( $value === NULL ) {
			$value = $this->renderChildren();
		}

		return \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($bit) && \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($value) ? ((int)$bit & (int)$value) > 0 : FALSE;
	}
}
