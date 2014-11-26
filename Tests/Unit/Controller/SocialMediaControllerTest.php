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
 * Test case for class S3b0\T3locations\Controller\SocialMediaController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class SocialMediaControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\T3locations\Controller\SocialMediaController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\T3locations\\Controller\\SocialMediaController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSocialMediasFromRepositoryAndAssignsThemToView() {

		$allSocialMedias = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$socialMediaRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$socialMediaRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSocialMedias));
		$this->inject($this->subject, 'socialMediaRepository', $socialMediaRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('socialMedias', $allSocialMedias);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenSocialMediaToView() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('socialMedia', $socialMedia);

		$this->subject->showAction($socialMedia);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenSocialMediaToView() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newSocialMedia', $socialMedia);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($socialMedia);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSocialMediaToSocialMediaRepository() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$socialMediaRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$socialMediaRepository->expects($this->once())->method('add')->with($socialMedia);
		$this->inject($this->subject, 'socialMediaRepository', $socialMediaRepository);

		$this->subject->createAction($socialMedia);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenSocialMediaToView() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('socialMedia', $socialMedia);

		$this->subject->editAction($socialMedia);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenSocialMediaInSocialMediaRepository() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$socialMediaRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$socialMediaRepository->expects($this->once())->method('update')->with($socialMedia);
		$this->inject($this->subject, 'socialMediaRepository', $socialMediaRepository);

		$this->subject->updateAction($socialMedia);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenSocialMediaFromSocialMediaRepository() {
		$socialMedia = new \S3b0\T3locations\Domain\Model\SocialMedia();

		$socialMediaRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$socialMediaRepository->expects($this->once())->method('remove')->with($socialMedia);
		$this->inject($this->subject, 'socialMediaRepository', $socialMediaRepository);

		$this->subject->deleteAction($socialMedia);
	}
}
