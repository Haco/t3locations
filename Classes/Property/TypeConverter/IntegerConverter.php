<?php
namespace S3b0\T3locations\Property\TypeConverter;

/*                                                                        *
 * This script belongs to the Extbase framework                           *
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
 * Converter which transforms a simple type to an integer, by simply casting it.
 * @mod Added array converting for fields storing binary values, @see \S3b0\T3locations\Domain\Model\Location _property(fieldToUseInSearchMask) @author Sebastian Iffland
 *
 * @api
 */
class IntegerConverter extends \TYPO3\CMS\Extbase\Property\TypeConverter\IntegerConverter {

	/**
	 * @var array<string>
	 */
	protected $sourceTypes = array('integer', 'string', 'array');

	/**
	 * @var string
	 */
	protected $targetType = 'integer';

	/**
	 * @var int
	 */
	protected $priority = 100;

	/**
	 * Actually convert from $source to $targetType, in fact a noop here.
	 *
	 * @param int|string $source
	 * @param string $targetType
	 * @param array $convertedChildProperties
	 * @param \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration
	 * @return int|\TYPO3\CMS\Extbase\Error\Error
	 * @api
	 */
	public function convertFrom($source, $targetType, array $convertedChildProperties = array(), \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration = NULL) {
		if ($source === NULL || (is_string($source) && strlen($source) === 0)) {
			return NULL;
		}
		if (!is_numeric($source) && !is_array($source)) {
			return new \TYPO3\CMS\Extbase\Error\Error('"%s" is no integer.', 1332933658, array($source));
		} elseif (is_array($source)) {
			$return = 0;
			foreach ($source as $v) {
				if (is_numeric($v)) {
					$return = $return | (int)$v;
				}
			}
			return (int)$return;
		}
		return (int)$source;
	}
}
