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
use TYPO3\CMS\Core\Cache\Backend\NullBackend;

/**
 * Class StripWhitespacesViewHelper
 *
 * @package TYPO3\CMS\Fluid\ViewHelpers\S3b0\String
 */
class StripWhitespacesViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Format\AbstractEncodingViewHelper implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Disable the escaping interceptor because otherwise the child nodes would be escaped before this view helper
	 * can decode the text's entities.
	 *
	 * @var boolean
	 */
	protected $escapingInterceptorEnabled = FALSE;

	/**
	 * Strip whitespaces.
	 *
	 * @param string $value string to format
	 * @return string the altered string
	 * @see http://php.net/preg_replace
	 * @api
	 */
	public function render($value = NULL) {
		if ( $value === NULL ) {
			$value = $this->renderChildren();
		}

		return preg_replace('/\s+/im', '', $value);
	}
}
