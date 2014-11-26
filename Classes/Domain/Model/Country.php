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
 * Country
 */
class Country extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

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
	 * Assign corresponding territory
	 *
	 * @var \S3b0\T3locations\Domain\Model\Territory
	 */
	protected $territory = NULL;

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
		$this->isoCodeA2 = $isoCodeA2;
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
		$this->isoCodeA3 = $isoCodeA3;
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