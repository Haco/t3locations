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
	 */
	protected $title = '';

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Country>
	 * @cascade remove
	 */
	protected $countries = NULL;

	/**
	 * Assign corresponding territory
	 *
	 * @var \S3b0\T3locations\Domain\Model\Territory
	 */
	protected $territory = NULL;

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
	 * Returns the flagIconName
	 *
	 * @return string $flagIconName
	 */
	public function getFlagIconName() {
		return $this->flagIconName;
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
	 * @param \S3b0\T3locations\Domain\Model\Country $country
	 * @return void
	 */
	public function addCountry(\S3b0\T3locations\Domain\Model\Country $country) {
		$this->countries->attach($country);
	}

	/**
	 * Removes a Country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Country $countryToRemove The Country to be removed
	 * @return void
	 */
	public function removeCountry(\S3b0\T3locations\Domain\Model\Country $countryToRemove) {
		$this->countries->detach($countryToRemove);
	}

	/**
	 * Returns the countries
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Country> $countries
	 */
	public function getCountries() {
		return $this->countries;
	}

	/**
	 * Sets the countries
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Country> $countries
	 * @return void
	 */
	public function setCountries(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $countries) {
		$this->countries = $countries;
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
	public function setTerritory(\S3b0\T3locations\Domain\Model\Territory $territory) {
		$this->territory = $territory;
	}

}