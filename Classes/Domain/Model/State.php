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
 * State
 */
class State extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * abbreviation
	 *
	 * @var string
	 */
	protected $abbreviation = '';

	/**
	 * verified
	 *
	 * @var boolean
	 */
	protected $verified = FALSE;

	/**
	 * Assign corresponding country
	 *
	 * @var \S3b0\T3locations\Domain\Model\Region
	 */
	protected $country = NULL;

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
	 * Returns the abbreviation
	 *
	 * @return string $abbreviation
	 */
	public function getAbbreviation() {
		return $this->abbreviation;
	}

	/**
	 * Sets the abbreviation
	 *
	 * @param string $abbreviation
	 * @return void
	 */
	public function setAbbreviation($abbreviation) {
		$this->abbreviation = $abbreviation;
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

}