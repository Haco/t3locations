<?php

namespace S3b0\T3locations\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \S3b0\T3locations\Domain\Model\Country.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class CountryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\T3locations\Domain\Model\Country
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\T3locations\Domain\Model\Country();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsoCodeA2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIsoCodeA2()
		);
	}

	/**
	 * @test
	 */
	public function setIsoCodeA2ForStringSetsIsoCodeA2() {
		$this->subject->setIsoCodeA2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'isoCodeA2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsoCodeA3ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIsoCodeA3()
		);
	}

	/**
	 * @test
	 */
	public function setIsoCodeA3ForStringSetsIsoCodeA3() {
		$this->subject->setIsoCodeA3('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'isoCodeA3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFlagIconNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFlagIconName()
		);
	}

	/**
	 * @test
	 */
	public function setFlagIconNameForStringSetsFlagIconName() {
		$this->subject->setFlagIconName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'flagIconName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVerifiedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getVerified()
		);
	}

	/**
	 * @test
	 */
	public function setVerifiedForBooleanSetsVerified() {
		$this->subject->setVerified(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'verified',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTerritoryReturnsInitialValueForTerritory() {
		$this->assertEquals(
			NULL,
			$this->subject->getTerritory()
		);
	}

	/**
	 * @test
	 */
	public function setTerritoryForTerritorySetsTerritory() {
		$territoryFixture = new \S3b0\T3locations\Domain\Model\Territory();
		$this->subject->setTerritory($territoryFixture);

		$this->assertAttributeEquals(
			$territoryFixture,
			'territory',
			$this->subject
		);
	}
}
