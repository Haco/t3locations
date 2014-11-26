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
 * Test case for class S3b0\T3locations\Controller\LocationTypeController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class LocationTypeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\T3locations\Controller\LocationTypeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\T3locations\\Controller\\LocationTypeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllLocationTypesFromRepositoryAndAssignsThemToView() {

		$allLocationTypes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$locationTypeRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$locationTypeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allLocationTypes));
		$this->inject($this->subject, 'locationTypeRepository', $locationTypeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('locationTypes', $allLocationTypes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenLocationTypeToView() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('locationType', $locationType);

		$this->subject->showAction($locationType);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenLocationTypeToView() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newLocationType', $locationType);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($locationType);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenLocationTypeToLocationTypeRepository() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$locationTypeRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$locationTypeRepository->expects($this->once())->method('add')->with($locationType);
		$this->inject($this->subject, 'locationTypeRepository', $locationTypeRepository);

		$this->subject->createAction($locationType);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenLocationTypeToView() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('locationType', $locationType);

		$this->subject->editAction($locationType);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenLocationTypeInLocationTypeRepository() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$locationTypeRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$locationTypeRepository->expects($this->once())->method('update')->with($locationType);
		$this->inject($this->subject, 'locationTypeRepository', $locationTypeRepository);

		$this->subject->updateAction($locationType);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenLocationTypeFromLocationTypeRepository() {
		$locationType = new \S3b0\T3locations\Domain\Model\LocationType();

		$locationTypeRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$locationTypeRepository->expects($this->once())->method('remove')->with($locationType);
		$this->inject($this->subject, 'locationTypeRepository', $locationTypeRepository);

		$this->subject->deleteAction($locationType);
	}
}
