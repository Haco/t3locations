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

use \TYPO3\CMS\Core\Utility as CoreUtility;

/**
 * TerritoryController
 */
class TerritoryController extends ExtensionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$territories = $this->territoryRepository->findByUidList($this->settings['territories'] ? CoreUtility\GeneralUtility::intExplode(',', $this->settings['territories'], TRUE) : array());
		/** @var \S3b0\T3locations\Domain\Model\Territory $territory */
		foreach ( $territories as $territory ) {
			$territory->setRegionAmount($this->regionRepository->findByTerritory($territory)->count());
		}
		$this->view->assign('territories', $territories);
	}

	/**
	 * action adminList
	 *
	 * @return void
	 */
	public function adminListAction() {
		$this->view->assign('territories', $this->territoryRepository->findAll());
	}

	/**
	 * action new
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $newTerritory
	 * @ignorevalidation $newTerritory
	 * @return void
	 */
	public function newAction(\S3b0\T3locations\Domain\Model\Territory $newTerritory = NULL) {
		$this->view->assign('newTerritory', $newTerritory);
	}

	/**
	 * action create
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $newTerritory
	 * @return void
	 */
	public function createAction(\S3b0\T3locations\Domain\Model\Territory $newTerritory) {
		$this->addMessage('message.entry_created', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->territoryRepository->add($newTerritory);

		$this->redirect('adminList');
	}

	/**
	 * action delete
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @return void
	 */
	public function deleteAction(\S3b0\T3locations\Domain\Model\Territory $territory) {
		$this->addMessage('message.entry_deleted', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array($territory->getTitle()));
		$this->territoryRepository->remove($territory);

		$this->redirect('adminList');
	}

	/**
	 * action verify
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @return void
	 */
	public function verifyAction(\S3b0\T3locations\Domain\Model\Territory $territory) {
		parent::verifyAction($territory);
	}

}