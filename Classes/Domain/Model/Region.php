<?php
namespace S3b0\T3locations\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Region
 */
class Region extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate \S3b0\T3locations\Validation\Validator\NotEmpty
	 */
	protected $title = '';

	/**
	 * type
	 *
	 * @var integer
	 * @validate $mode \S3b0\T3locations\Validation\Validator\InList(list="0,1")
	 */
	protected $type = 0;

	/**
	 * isoCodeA2
	 *
	 * @var string
	 */
	protected $isoCodeA2 = '';

	/**
	 * isoCodeA3
	 *
	 * @var string
	 */
	protected $isoCodeA3 = '';

	/**
	 * flagIconName
	 *
	 * @var string
	 */
	protected $flagIconName = '';

	/**
	 * verified
	 *
	 * @var boolean
	 */
	protected $verified = FALSE;

	/**
	 * Assign corresponding countries
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region>
	 */
	protected $countries = NULL;

	/**
	 * Assign corresponding territory
	 *
	 * @var \S3b0\T3locations\Domain\Model\Territory
	 * @validate \S3b0\T3locations\Validation\Validator\NotEmpty
	 */
	protected $territory = NULL;

	/**
	 * @var integer
	 * @internal
	 */
	protected $locationAmount = 0;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->countries = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the type
	 *
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param int $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the isoCodeA2
	 *
	 * @return string $isoCodeA2
	 */
	public function getIsoCodeA2() {
		return $this->isoCodeA2;
	}

	/**
	 * Sets the isoCodeA2
	 *
	 * @param string $isoCodeA2
	 * @return void
	 */
	public function setIsoCodeA2($isoCodeA2) {
		$this->isoCodeA2 = strtoupper($isoCodeA2);
	}

	/**
	 * Returns the isoCodeA3
	 *
	 * @return string $isoCodeA3
	 */
	public function getIsoCodeA3() {
		return $this->isoCodeA3;
	}

	/**
	 * Sets the isoCodeA3
	 *
	 * @param string $isoCodeA3
	 * @return void
	 */
	public function setIsoCodeA3($isoCodeA3) {
		$this->isoCodeA3 = strtoupper($isoCodeA3);
	}

	/**
	 * Returns the flagIconName
	 *
	 * @return string $flagIconName
	 */
	public function getFlagIconName() {
		if ( $this->_languageUid ) {
			/** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
			$db = $GLOBALS['TYPO3_DB'];
			/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObjectRenderer */
			$contentObjectRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
			/** @var array $originalRecord */
			if ( $originalRecord = $db->exec_SELECTgetSingleRow('title', 'tx_t3locations_domain_model_region', 'uid=' . $this->uid . $contentObjectRenderer->enableFields('tx_t3locations_domain_model_region')) ) {
				return $this->flagIconName ?: $originalRecord['title'];
			}
		}

		return $this->flagIconName ?: $this->title;
	}

	/**
	 * Sets the flagIconName
	 *
	 * @param string $flagIconName
	 * @return void
	 */
	public function setFlagIconName($flagIconName) {
		$this->flagIconName = $flagIconName;
	}

	/**
	 * Returns the verified
	 *
	 * @return boolean $verified
	 */
	public function getVerified() {
		return $this->verified;
	}

	/**
	 * Sets the verified
	 *
	 * @param boolean $verified
	 * @return void
	 */
	public function setVerified($verified) {
		$this->verified = $verified;
	}

	/**
	 * Returns the boolean state of verified
	 *
	 * @return boolean
	 */
	public function isVerified() {
		return $this->verified;
	}

	/**
	 * Adds a Country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $country
	 * @return void
	 */
	public function addCountry(\S3b0\T3locations\Domain\Model\Region $country) {
		if ( $country->getType() === 0 ) {
			$this->countries->attach($country);
		}
	}

	/**
	 * Removes a Country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $countryToRemove The Country to be removed
	 * @return void
	 */
	public function removeCountry(\S3b0\T3locations\Domain\Model\Region $countryToRemove) {
		$this->countries->detach($countryToRemove);
	}

	/**
	 * Returns the countries
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region> $countries
	 */
	public function getCountries() {
		return $this->countries;
	}

	/**
	 * Sets the countries
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region> $countries
	 * @return void
	 */
	public function setCountries(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $countries = NULL) {
		if ( $countries instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $countries->count() ) {
			/** @var \S3b0\T3locations\Domain\Model\Region $country */
			foreach ( $countries as $country ) {
				if ( $country->getType() === 0 ) {
					$this->addCountry($country);
				}
			}
		}
	}

	/**
	 * Returns the territory
	 *
	 * @return \S3b0\T3locations\Domain\Model\Territory $territory
	 */
	public function getTerritory() {
		return $this->territory;
	}

	/**
	 * Sets the territory
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @return void
	 */
	public function setTerritory(\S3b0\T3locations\Domain\Model\Territory $territory = NULL) {
		$this->territory = $territory;
	}

	/**
	 * @return integer
	 */
	public function getLocationAmount() {
		return $this->locationAmount;
	}

	/**
	 * @param integer $locationAmount
	 */
	public function setLocationAmount($locationAmount) {
		$this->locationAmount = $locationAmount;
	}

	public function getFirstLetter() {
		return ucfirst(substr(\S3b0\T3locations\Utility\Div::convertUtf8ToAscii($this->title), 0, 1));
	}

}