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
 * RegionController
 */
class RegionController extends ExtensionController {

	/**
	 * action list
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @return void
	 */
	public function listAction(\S3b0\T3locations\Domain\Model\Territory $territory = NULL) {
		$regions = $territory instanceof \S3b0\T3locations\Domain\Model\Territory ? $this->regionRepository->findByTerritory($territory) : $this->regionRepository->findByUidList($this->settings[ 'countries' ] ? CoreUtility\GeneralUtility::intExplode(',', $this->settings[ 'countries' ], TRUE) : array(), (int) $this->settings[ 'modeInclude' ]);
		/** @var \S3b0\T3locations\Domain\Model\Region $region */
		foreach ( $regions as $region ) {
			$region->setLocationAmount($this->locationRepository->findByRegion($region)->count());
		}
		$this->view->assign('regions', $regions);
	}

	/**
	 * action adminList
	 *
	 * @return void
	 */
	public function adminListAction() {
		$this->view->assign('regions', $this->regionRepository->findAll());
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
		$this->view->assignMultiple(array(
			'newRegion' => $newRegion,
			'countries' => $this->regionRepository->findByType(0),
			'territories' => $this->territoryRepository->findAll()
		));
	}

	/**
	 * action create
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $newRegion
	 * @return void
	 */
	public function createAction(\S3b0\T3locations\Domain\Model\Region $newRegion) {
		$this->addMessage('message.entry_created', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->regionRepository->add($newRegion);

		$this->redirect('adminList');
	}

	/**
	 * action edit
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @ignorevalidation $region
	 * @return void
	 */
	public function editAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->view->assignMultiple(array(
			'region' => $region,
			'countries' => $this->regionRepository->findByType(0),
			'territories' => $this->territoryRepository->findAll()
		));
	}

	/**
	 * action update
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function updateAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->addMessage('message.entry_updated', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING, array($region->getTitle()));
		$this->regionRepository->update($region);

		$this->redirect('adminList');
	}

	/**
	 * action delete
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function deleteAction(\S3b0\T3locations\Domain\Model\Region $region) {
		$this->addMessage('message.entry_deleted', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array($region->getTitle()));
		$this->regionRepository->remove($region);

		$this->redirect('adminList');
	}

	/**
	 * action verify
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @return void
	 */
	public function verifyAction(\S3b0\T3locations\Domain\Model\Region $region) {
		parent::verifyAction($region);
	}

}