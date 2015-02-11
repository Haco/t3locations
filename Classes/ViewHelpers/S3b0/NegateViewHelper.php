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
 * Class NegateViewHelper
 *
 * @package TYPO3\CMS\Fluid\ViewHelpers\S3b0
 */
class NegateViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @param mixed $value
	 * @return boolean
	 */
	public function render($value = NULL) {
		if ( $value === NULL ) {
			$value = $this->renderChildren();
		}

		/** For all PHP versions 5.5+ use the boolval() method */
		if ( PHP_MAJOR_VERSION > 5 || ( PHP_MAJOR_VERSION === 5 && PHP_MINOR_VERSION >= 5 ) ) {
			return !boolval($value);
		} else {
			return !(bool) $value;
		}
	}
}
