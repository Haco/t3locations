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
 * Test case for class S3b0\T3locations\Controller\RegionController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class RegionControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\T3locations\Controller\RegionController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\T3locations\\Controller\\RegionController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllRegionsFromRepositoryAndAssignsThemToView() {

		$allRegions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$regionRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$regionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allRegions));
		$this->inject($this->subject, 'regionRepository', $regionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('regions', $allRegions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenRegionToView() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('region', $region);

		$this->subject->showAction($region);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenRegionToView() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newRegion', $region);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($region);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenRegionToRegionRepository() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$regionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$regionRepository->expects($this->once())->method('add')->with($region);
		$this->inject($this->subject, 'regionRepository', $regionRepository);

		$this->subject->createAction($region);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenRegionToView() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('region', $region);

		$this->subject->editAction($region);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenRegionInRegionRepository() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$regionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$regionRepository->expects($this->once())->method('update')->with($region);
		$this->inject($this->subject, 'regionRepository', $regionRepository);

		$this->subject->updateAction($region);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenRegionFromRegionRepository() {
		$region = new \S3b0\T3locations\Domain\Model\Region();

		$regionRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$regionRepository->expects($this->once())->method('remove')->with($region);
		$this->inject($this->subject, 'regionRepository', $regionRepository);

		$this->subject->deleteAction($region);
	}
}
