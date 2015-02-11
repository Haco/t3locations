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
 * StateController
 */
class StateController extends ExtensionController {

	/**
	 * action adminList
	 *
	 * @return void
	 */
	public function adminListAction() {
		$states = $this->stateRepository->findAll();
		$this->view->assign('states', $states);
	}

	/**
	 * action new
	 *
	 * @param \S3b0\T3locations\Domain\Model\State $newState
	 * @ignorevalidation $newState
	 * @return void
	 */
	public function newAction(\S3b0\T3locations\Domain\Model\State $newState = NULL) {
		$this->view->assign('countries', $this->regionRepository->findByType(0));
		$this->view->assign('newState', $newState);
	}

	/**
	 * action create
	 *
	 * @param \S3b0\T3locations\Domain\Model\State $newState
	 * @return void
	 */
	public function createAction(\S3b0\T3locations\Domain\Model\State $newState) {
		$this->addMessage('message.entry_created', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->stateRepository->add($newState);

		$this->redirect('adminList');
	}

	/**
	 * action delete
	 *
	 * @param \S3b0\T3locations\Domain\Model\State $state
	 * @return void
	 */
	public function deleteAction(\S3b0\T3locations\Domain\Model\State $state) {
		$this->addMessage('message.entry_deleted', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array($state->getTitle()));
		$this->stateRepository->remove($state);

		$this->redirect('adminList');
	}

	/**
	 * action verify
	 *
	 * @param \S3b0\T3locations\Domain\Model\State $state
	 * @return void
	 */
	public function verifyAction(\S3b0\T3locations\Domain\Model\State $state) {
		parent::verifyAction($state);
	}

}