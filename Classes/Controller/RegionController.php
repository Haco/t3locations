<?php
namespace S3b0\T3locations\Controller;


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
 * RegionController
 */
class RegionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$regions = $this->regionRepository->findAll();
		$this->view->assign('regions', $regions);
	}

	/**
	 * action show
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function showAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->view->assign('region', $region);
	}

	/**
	 * action new
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $newRegion
	 * @ignorevalidation $newRegion
	 * @return void
	 */
	public function newAction(\S3b0\T3locations\Domain\Model\Region $newRegion = NULL) {
		$this->view->assign('newRegion', $newRegion);
	}

	/**
	 * action create
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $newRegion
	 * @return void
	 */
	public function createAction(\S3b0\T3locations\Domain\Model\Region $newRegion) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->regionRepository->add($newRegion);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @ignorevalidation $region
	 * @return void
	 */
	public function editAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->view->assign('region', $region);
	}

	/**
	 * action update
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function updateAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->regionRepository->update($region);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function deleteAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->regionRepository->remove($region);
		$this->redirect('list');
	}

}