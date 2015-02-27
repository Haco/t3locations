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
 * Territory
 */
class Territory extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate S3b0\T3locations\Validation\Validator\NotEmpty
	 */
	protected $title = '';

	/**
	 * verified
	 *
	 * @var boolean
	 */
	protected $verified = FALSE;

	/**
	 * regionAmount
	 *
	 * @var integer
	 * @internal
	 */
	protected $regionAmount = 0;

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
	 * @return integer
	 */
	public function getRegionAmount() {
		return $this->regionAmount;
	}

	/**
	 * @param integer $regionAmount
	 */
	public function setRegionAmount($regionAmount) {
		$this->regionAmount = $regionAmount;
	}

}