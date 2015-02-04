<?php
namespace TYPO3\CMS\Fluid\ViewHelpers\S3b0\String;

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
 * Class TrimViewHelper
 *
 * @package TYPO3\CMS\Fluid\ViewHelpers\S3b0\String
 * @subpackage t3locations
 */
class TrimViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Format\AbstractEncodingViewHelper implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Disable the escaping interceptor because otherwise the child nodes would be escaped before this view helper
	 * can decode the text's entities.
	 *
	 * @var boolean
	 */
	protected $escapingInterceptorEnabled = FALSE;

	/**
	 * Strip whitespace (or other characters) from the beginning and end of a string.
	 *
	 * @param string $value string to trim
	 * @return string the altered string
	 * @see http://php.net/trim
	 * @api
	 */
	public function render($value = NULL) {
		return trim($value ?: $this->renderChildren());
	}
}
