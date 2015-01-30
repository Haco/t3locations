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
 * Location
 */
class Location extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * logo
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $logo = NULL;

	/**
	 * freetext
	 *
	 * @var string
	 */
	protected $freetext = '';

	/**
	 * fieldToUseInSearchMask
	 *
	 * @var integer
	 */
	protected $fieldToUseInSearchMask = 0;

	/**
	 * fieldToUseInHeadline
	 *
	 * @var integer
	 */
	protected $fieldToUseInHeadline = 0;

	/**
	 * userDefinedHeadline
	 *
	 * @var string
	 */
	protected $userDefinedHeadline = '';

	/**
	 * contactPerson
	 *
	 * @var string
	 */
	protected $contactPerson = '';

	/**
	 * address
	 *
	 * @var string
	 */
	protected $address = '';

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * phone
	 *
	 * @var string
	 */
	protected $phone = '';

	/**
	 * facsimile
	 *
	 * @var string
	 */
	protected $facsimile = '';

	/**
	 * mobile
	 *
	 * @var string
	 */
	protected $mobile = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * web
	 *
	 * @var string
	 */
	protected $web = '';

	/**
	 * type
	 *
	 * @var \S3b0\T3locations\Domain\Model\LocationType
	 */
	protected $type = NULL;

	/**
	 * socialMedia
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\SocialMediaLink>
	 * @cascade remove
	 */
	protected $socialMedia = NULL;

	/**
	 * googleMaps
	 *
	 * @var \S3b0\T3locations\Domain\Model\Map
	 */
	protected $googleMaps = NULL;

	/**
	 * state
	 *
	 * @var \S3b0\T3locations\Domain\Model\State
	 */
	protected $state = NULL;

	/**
	 * country
	 *
	 * @var \S3b0\T3locations\Domain\Model\Region
	 */
	protected $country = NULL;

	/**
	 * coverage
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region>
	 */
	protected $coverage = NULL;

	/**
	 * region
	 *
	 * @var \S3b0\T3locations\Domain\Model\Region
	 */
	protected $region = NULL;

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
		$this->socialMedia = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->coverage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the logo
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
	 */
	public function getLogo() {
		return $this->logo;
	}

	/**
	 * Sets the logo
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
	 * @return void
	 */
	public function setLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $logo) {
		$this->logo = $logo;
	}

	/**
	 * Returns the freetext
	 *
	 * @return string $freetext
	 */
	public function getFreetext() {
		return $this->freetext;
	}

	/**
	 * Sets the freetext
	 *
	 * @param string $freetext
	 * @return void
	 */
	public function setFreetext($freetext) {
		$this->freetext = $freetext;
	}

	/**
	 * Returns the fieldToUseInSearchMask
	 *
	 * @return integer $fieldToUseInSearchMask
	 */
	public function getFieldToUseInSearchMask() {
		return $this->fieldToUseInSearchMask;
	}

	/**
	 * Sets the fieldToUseInSearchMask
	 *
	 * @param integer $fieldToUseInSearchMask
	 * @return void
	 */
	public function setFieldToUseInSearchMask($fieldToUseInSearchMask) {
		$this->fieldToUseInSearchMask = $fieldToUseInSearchMask;
	}

	/**
	 * Returns the fieldToUseInHeadline
	 *
	 * @return integer $fieldToUseInHeadline
	 */
	public function getFieldToUseInHeadline() {
		return $this->fieldToUseInHeadline;
	}

	/**
	 * Sets the fieldToUseInHeadline
	 *
	 * @param integer $fieldToUseInHeadline
	 * @return void
	 */
	public function setFieldToUseInHeadline($fieldToUseInHeadline) {
		$this->fieldToUseInHeadline = $fieldToUseInHeadline;
	}

	/**
	 * Returns the userDefinedHeadline
	 *
	 * @return string $userDefinedHeadline
	 */
	public function getUserDefinedHeadline() {
		return $this->userDefinedHeadline;
	}

	/**
	 * Sets the userDefinedHeadline
	 *
	 * @param string $userDefinedHeadline
	 * @return void
	 */
	public function setUserDefinedHeadline($userDefinedHeadline) {
		$this->userDefinedHeadline = $userDefinedHeadline;
	}

	/**
	 * Returns the contactPerson
	 *
	 * @return string $contactPerson
	 */
	public function getContactPerson() {
		return $this->contactPerson;
	}

	/**
	 * Sets the contactPerson
	 *
	 * @param string $contactPerson
	 * @return void
	 */
	public function setContactPerson($contactPerson) {
		$this->contactPerson = $contactPerson;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the facsimile
	 *
	 * @return string $facsimile
	 */
	public function getFacsimile() {
		return $this->facsimile;
	}

	/**
	 * Sets the facsimile
	 *
	 * @param string $facsimile
	 * @return void
	 */
	public function setFacsimile($facsimile) {
		$this->facsimile = $facsimile;
	}

	/**
	 * Returns the mobile
	 *
	 * @return string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

	/**
	 * Returns the email
	 *
	 * @return array $email
	 */
	public function getEmail() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $this->email, TRUE);
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the web
	 *
	 * @return array $web
	 */
	public function getWeb() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $this->web, TRUE);
	}

	/**
	 * Sets the web
	 *
	 * @param string $web
	 * @return void
	 */
	public function setWeb($web) {
		$this->web = $web;
	}

	/**
	 * Returns the type
	 *
	 * @return \S3b0\T3locations\Domain\Model\LocationType
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param \S3b0\T3locations\Domain\Model\LocationType $type
	 */
	public function setType(\S3b0\T3locations\Domain\Model\LocationType $type) {
		$this->type = $type;
	}

	/**
	 * Adds a SocialMediaLink
	 *
	 * @param \S3b0\T3locations\Domain\Model\SocialMediaLink $socialMedium
	 * @return void
	 */
	public function addSocialMedium(\S3b0\T3locations\Domain\Model\SocialMediaLink $socialMedium) {
		$this->socialMedia->attach($socialMedium);
	}

	/**
	 * Removes a SocialMediaLink
	 *
	 * @param \S3b0\T3locations\Domain\Model\SocialMediaLink $socialMediumToRemove The SocialMediaLink to be removed
	 * @return void
	 */
	public function removeSocialMedium(\S3b0\T3locations\Domain\Model\SocialMediaLink $socialMediumToRemove) {
		$this->socialMedia->detach($socialMediumToRemove);
	}

	/**
	 * Returns the socialMedia
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\SocialMediaLink> $socialMedia
	 */
	public function getSocialMedia() {
		return $this->socialMedia;
	}

	/**
	 * Sets the socialMedia
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\SocialMediaLink> $socialMedia
	 * @return void
	 */
	public function setSocialMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $socialMedia) {
		$this->socialMedia = $socialMedia;
	}

	/**
	 * Returns the googleMaps
	 *
	 * @return \S3b0\T3locations\Domain\Model\Map $googleMaps
	 */
	public function getGoogleMaps() {
		return $this->googleMaps;
	}

	/**
	 * Sets the googleMaps
	 *
	 * @param \S3b0\T3locations\Domain\Model\Map $googleMaps
	 * @return void
	 */
	public function setGoogleMaps(\S3b0\T3locations\Domain\Model\Map $googleMaps) {
		$this->googleMaps = $googleMaps;
	}

	/**
	 * Returns the state
	 *
	 * @return \S3b0\T3locations\Domain\Model\State $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Sets the state
	 *
	 * @param \S3b0\T3locations\Domain\Model\State $state
	 * @return void
	 */
	public function setState(\S3b0\T3locations\Domain\Model\State $state) {
		$this->state = $state;
	}

	/**
	 * Returns the country
	 *
	 * @return \S3b0\T3locations\Domain\Model\Region $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $country
	 * @return void
	 */
	public function setCountry(\S3b0\T3locations\Domain\Model\Region $country) {
		$this->country = $country;
	}

	/**
	 * Adds a Country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $coverage
	 * @return void
	 */
	public function addCoverage(\S3b0\T3locations\Domain\Model\Region $coverage) {
		$this->coverage->attach($coverage);
	}

	/**
	 * Removes a Country
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $coverageToRemove The Country to be removed
	 * @return void
	 */
	public function removeCoverage(\S3b0\T3locations\Domain\Model\Region $coverageToRemove) {
		$this->coverage->detach($coverageToRemove);
	}

	/**
	 * Returns the coverage
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region> $coverage
	 */
	public function getCoverage() {
		if ( $this->coverage->contains($this->country) ) {
			$this->coverage->detach($this->country);
		}

		return $this->coverage;
	}

	/**
	 * Sets the coverage
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\T3locations\Domain\Model\Region> $coverage
	 * @return void
	 */
	public function setCoverage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $coverage) {
		$this->coverage = $coverage;
	}

	/**
	 * Returns the region
	 *
	 * @return \S3b0\T3locations\Domain\Model\Region $region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Sets the region
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function setRegion(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->region = $region;
	}

	/**
	 * Returns the headline
	 *
	 * @return string
	 */
	public function getHeadline() {
		switch ( $this->fieldToUseInHeadline ) {
			case 1:
				return $this->country->getTitle();
				break;
			case 2:
				return $this->region->getTitle();
				break;
			case 3:
				return $this->userDefinedHeadline;
				break;
			case 4:
				return '';
				break;
			default:
				return $this->title;
		}
	}

}