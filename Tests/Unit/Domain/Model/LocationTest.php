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
 * Test case for class \S3b0\T3locations\Domain\Model\Location.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class LocationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\T3locations\Domain\Model\Location
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\T3locations\Domain\Model\Location();
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
	public function getLogoReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getLogo()
		);
	}

	/**
	 * @test
	 */
	public function setLogoForFileReferenceSetsLogo() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setLogo($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'logo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFreetextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFreetext()
		);
	}

	/**
	 * @test
	 */
	public function setFreetextForStringSetsFreetext() {
		$this->subject->setFreetext('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'freetext',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFieldToUseInSearchMaskReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getFieldToUseInSearchMask()
		);
	}

	/**
	 * @test
	 */
	public function setFieldToUseInSearchMaskForIntegerSetsFieldToUseInSearchMask() {
		$this->subject->setFieldToUseInSearchMask(12);

		$this->assertAttributeEquals(
			12,
			'fieldToUseInSearchMask',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFieldToUseInHeadlineReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getFieldToUseInHeadline()
		);
	}

	/**
	 * @test
	 */
	public function setFieldToUseInHeadlineForIntegerSetsFieldToUseInHeadline() {
		$this->subject->setFieldToUseInHeadline(12);

		$this->assertAttributeEquals(
			12,
			'fieldToUseInHeadline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUserDefinedHeadlineReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUserDefinedHeadline()
		);
	}

	/**
	 * @test
	 */
	public function setUserDefinedHeadlineForStringSetsUserDefinedHeadline() {
		$this->subject->setUserDefinedHeadline('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'userDefinedHeadline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContactPersonReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getContactPerson()
		);
	}

	/**
	 * @test
	 */
	public function setContactPersonForStringSetsContactPerson() {
		$this->subject->setContactPerson('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'contactPerson',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() {
		$this->subject->setAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'address',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() {
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPhone()
		);
	}

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone() {
		$this->subject->setPhone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'phone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFacsimileReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFacsimile()
		);
	}

	/**
	 * @test
	 */
	public function setFacsimileForStringSetsFacsimile() {
		$this->subject->setFacsimile('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'facsimile',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMobileReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMobile()
		);
	}

	/**
	 * @test
	 */
	public function setMobileForStringSetsMobile() {
		$this->subject->setMobile('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mobile',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWebReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getWeb()
		);
	}

	/**
	 * @test
	 */
	public function setWebForStringSetsWeb() {
		$this->subject->setWeb('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'web',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSocialMediaReturnsInitialValueForSocialMediaLink() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSocialMedia()
		);
	}

	/**
	 * @test
	 */
	public function setSocialMediaForObjectStorageContainingSocialMediaLinkSetsSocialMedia() {
		$socialMedium = new \S3b0\T3locations\Domain\Model\SocialMediaLink();
		$objectStorageHoldingExactlyOneSocialMedia = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSocialMedia->attach($socialMedium);
		$this->subject->setSocialMedia($objectStorageHoldingExactlyOneSocialMedia);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSocialMedia,
			'socialMedia',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSocialMediumToObjectStorageHoldingSocialMedia() {
		$socialMedium = new \S3b0\T3locations\Domain\Model\SocialMediaLink();
		$socialMediaObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$socialMediaObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($socialMedium));
		$this->inject($this->subject, 'socialMedia', $socialMediaObjectStorageMock);

		$this->subject->addSocialMedium($socialMedium);
	}

	/**
	 * @test
	 */
	public function removeSocialMediumFromObjectStorageHoldingSocialMedia() {
		$socialMedium = new \S3b0\T3locations\Domain\Model\SocialMediaLink();
		$socialMediaObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$socialMediaObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($socialMedium));
		$this->inject($this->subject, 'socialMedia', $socialMediaObjectStorageMock);

		$this->subject->removeSocialMedium($socialMedium);

	}

	/**
	 * @test
	 */
	public function getGoogleMapsReturnsInitialValueForMap() {
		$this->assertEquals(
			NULL,
			$this->subject->getGoogleMaps()
		);
	}

	/**
	 * @test
	 */
	public function setGoogleMapsForMapSetsGoogleMaps() {
		$googleMapsFixture = new \S3b0\T3locations\Domain\Model\Map();
		$this->subject->setGoogleMaps($googleMapsFixture);

		$this->assertAttributeEquals(
			$googleMapsFixture,
			'googleMaps',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStateReturnsInitialValueForState() {
		$this->assertEquals(
			NULL,
			$this->subject->getState()
		);
	}

	/**
	 * @test
	 */
	public function setStateForStateSetsState() {
		$stateFixture = new \S3b0\T3locations\Domain\Model\State();
		$this->subject->setState($stateFixture);

		$this->assertAttributeEquals(
			$stateFixture,
			'state',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForCountrySetsCountry() {
		$countryFixture = new \S3b0\T3locations\Domain\Model\Country();
		$this->subject->setCountry($countryFixture);

		$this->assertAttributeEquals(
			$countryFixture,
			'country',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCoverageReturnsInitialValueForCountry() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCoverage()
		);
	}

	/**
	 * @test
	 */
	public function setCoverageForObjectStorageContainingCountrySetsCoverage() {
		$coverage = new \S3b0\T3locations\Domain\Model\Country();
		$objectStorageHoldingExactlyOneCoverage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCoverage->attach($coverage);
		$this->subject->setCoverage($objectStorageHoldingExactlyOneCoverage);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCoverage,
			'coverage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCoverageToObjectStorageHoldingCoverage() {
		$coverage = new \S3b0\T3locations\Domain\Model\Country();
		$coverageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$coverageObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($coverage));
		$this->inject($this->subject, 'coverage', $coverageObjectStorageMock);

		$this->subject->addCoverage($coverage);
	}

	/**
	 * @test
	 */
	public function removeCoverageFromObjectStorageHoldingCoverage() {
		$coverage = new \S3b0\T3locations\Domain\Model\Country();
		$coverageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$coverageObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($coverage));
		$this->inject($this->subject, 'coverage', $coverageObjectStorageMock);

		$this->subject->removeCoverage($coverage);

	}

	/**
	 * @test
	 */
	public function getRegionReturnsInitialValueForRegion() {
		$this->assertEquals(
			NULL,
			$this->subject->getRegion()
		);
	}

	/**
	 * @test
	 */
	public function setRegionForRegionSetsRegion() {
		$regionFixture = new \S3b0\T3locations\Domain\Model\Region();
		$this->subject->setRegion($regionFixture);

		$this->assertAttributeEquals(
			$regionFixture,
			'region',
			$this->subject
		);
	}
}
