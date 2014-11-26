<?php
namespace S3b0\T3locations\Tests\Unit\Controller;
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
 * Test case for class S3b0\T3locations\Controller\CountryController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class CountryControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\T3locations\Controller\CountryController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\T3locations\\Controller\\CountryController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCountriesFromRepositoryAndAssignsThemToView() {

		$allCountries = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$countryRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$countryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCountries));
		$this->inject($this->subject, 'countryRepository', $countryRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('countries', $allCountries);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCountryToView() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('country', $country);

		$this->subject->showAction($country);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenCountryToView() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newCountry', $country);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($country);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCountryToCountryRepository() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$countryRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$countryRepository->expects($this->once())->method('add')->with($country);
		$this->inject($this->subject, 'countryRepository', $countryRepository);

		$this->subject->createAction($country);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCountryToView() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('country', $country);

		$this->subject->editAction($country);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCountryInCountryRepository() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$countryRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$countryRepository->expects($this->once())->method('update')->with($country);
		$this->inject($this->subject, 'countryRepository', $countryRepository);

		$this->subject->updateAction($country);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenCountryFromCountryRepository() {
		$country = new \S3b0\T3locations\Domain\Model\Country();

		$countryRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$countryRepository->expects($this->once())->method('remove')->with($country);
		$this->inject($this->subject, 'countryRepository', $countryRepository);

		$this->subject->deleteAction($country);
	}
}
