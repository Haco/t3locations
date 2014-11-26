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
 * Test case for class S3b0\T3locations\Controller\StateController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class StateControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\T3locations\Controller\StateController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\T3locations\\Controller\\StateController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllStatesFromRepositoryAndAssignsThemToView() {

		$allStates = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$stateRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$stateRepository->expects($this->once())->method('findAll')->will($this->returnValue($allStates));
		$this->inject($this->subject, 'stateRepository', $stateRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('states', $allStates);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenStateToView() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('state', $state);

		$this->subject->showAction($state);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenStateToView() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newState', $state);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($state);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenStateToStateRepository() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$stateRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$stateRepository->expects($this->once())->method('add')->with($state);
		$this->inject($this->subject, 'stateRepository', $stateRepository);

		$this->subject->createAction($state);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenStateToView() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('state', $state);

		$this->subject->editAction($state);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenStateInStateRepository() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$stateRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$stateRepository->expects($this->once())->method('update')->with($state);
		$this->inject($this->subject, 'stateRepository', $stateRepository);

		$this->subject->updateAction($state);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenStateFromStateRepository() {
		$state = new \S3b0\T3locations\Domain\Model\State();

		$stateRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$stateRepository->expects($this->once())->method('remove')->with($state);
		$this->inject($this->subject, 'stateRepository', $stateRepository);

		$this->subject->deleteAction($state);
	}
}
