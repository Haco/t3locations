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
 * LocationController
 */
class LocationController extends ExtensionController {

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();

		/** @var array $actionsRequiringAdminRights Set default query settings enabling hidden records to be displayed in admin areas/actions */
		$actionsRequiringAdminRights = array('adminList', 'show', 'create', 'edit', 'update', 'delete', 'toggleVisibility', 'moveRecord');
		if ( in_array($this->request->getControllerActionName(), $actionsRequiringAdminRights) && \S3b0\T3locations\Utility\Security::isAuthenticated() ) {
			/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
			$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
			$querySettings->setEnableFieldsToBeIgnored(array( 'disabled' ));
			$querySettings->setIgnoreEnableFields(TRUE);
			$querySettings->setRespectStoragePage(FALSE); // Disable storage pid
			$this->locationRepository->setDefaultQuerySettings($querySettings);
		}

		/** @var array $actionsRequiringLocationModel pre-parsing argument to ensure an instance of \S3b0\T3locations\Domain\Model\Location is given */
		$actionsRequiringLocationModel = array('show', 'edit', 'delete', 'toggleVisibility', 'moveRecord');
		if ( in_array($this->request->getControllerActionName(), $actionsRequiringLocationModel) ) {
			if ( $this->request->hasArgument('location') ) {
				$arg = $this->request->getArgument('location');
				if ( !$arg instanceof \S3b0\T3locations\Domain\Model\Location ) {
					if ( CoreUtility\MathUtility::canBeInterpretedAsInteger($arg) ) {
						$this->request->setArgument('location', $this->locationRepository->findByUid(CoreUtility\MathUtility::convertToPositiveInteger($arg)));
					} elseif ( is_array($arg) && array_key_exists('__identity', $arg) ) {
						$this->request->setArgument('location', $this->locationRepository->findByUid(CoreUtility\MathUtility::convertToPositiveInteger($arg['__identity'])));
					} else {
						$this->request->setArgument('location', NULL);
					}
				}
			} else {
				$this->request->setArgument('location', NULL);
			}
		}
	}

	/**
	 * action list
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region (optional)
	 * @return void
	 */
	public function listAction(\S3b0\T3locations\Domain\Model\Region $region = NULL) {
		$locations = $region instanceof \S3b0\T3locations\Domain\Model\Region ? $this->locationRepository->findByRegion($region) : $this->locationRepository->findByUidList($this->settings['locations'] ? CoreUtility\GeneralUtility::intExplode(',', $this->settings['locations'], TRUE) : array(), (int) $this->settings['modeInclude']);
		$this->view->assign('locations', $locations);
	}

	/**
	 * action adminList
	 *
	 * @return void
	 */
	public function adminListAction() {
		$this->view->assign('locations', $this->locationRepository->findAll());
	}

	/**
	 * action show
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @return void
	 */
	public function showAction(\S3b0\T3locations\Domain\Model\Location $location) {
		$this->addMapMarkerJS(new \ArrayObject(array($location)));
		$this->view->assign('location', $location);
	}

	/**
	 * action new
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $newLocation
	 * @ignorevalidation $newLocation
	 * @return void
	 */
	public function newAction(\S3b0\T3locations\Domain\Model\Location $newLocation = NULL) {
		$this->view->assignMultiple(array(
			'newLocation' => $newLocation,
			'locationTypes' => $this->locationTypeRepository->findAll(),
			'countries' => $this->regionRepository->findByType(0),
			'regions' => $this->regionRepository->findByType(1)
		));
	}

	/**
	 * action create
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $newLocation
	 * @param string                                  $redirect
	 * @return void
	 */
	public function createAction(\S3b0\T3locations\Domain\Model\Location $newLocation, $redirect = 'adminList') {
		$this->addMessage('message.entry_created', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->locationRepository->add($newLocation);
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager */
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();

		$this->redirect($redirect, NULL, NULL, array('location' => $newLocation));
	}

	/**
	 * action edit
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @ignorevalidation $location
	 * @return void
	 */
	public function editAction(\S3b0\T3locations\Domain\Model\Location $location) {
		$this->view->assignMultiple(array(
			'location' => $location,
			'locationTypes' => $this->locationTypeRepository->findAll(),
			'countries' => $this->regionRepository->findByType(0),
			'states' => $this->stateRepository->findByCountry($location->getCountry()),
			'regions' => $this->regionRepository->findByType(1)
		));
	}

	/**
	 * action update
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @param string                                  $redirect
	 * @return void
	 */
	public function updateAction(\S3b0\T3locations\Domain\Model\Location $location, $redirect = 'adminList') {
		$this->addMessage('message.entry_updated', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING, array($location->getHeadline()));
		$this->locationRepository->update($location);

		$this->redirect($redirect, NULL, NULL, array('location' => $location));
	}

	/**
	 * action delete
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @return void
	 */
	public function deleteAction(\S3b0\T3locations\Domain\Model\Location $location) {
		$this->addMessage('message.entry_deleted', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array($location->getHeadline()));
		$this->locationRepository->remove($location);

		$this->redirect('adminList');
	}

	/**
	 * action toggleVisibility
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @return void
	 */
	public function toggleVisibilityAction(\S3b0\T3locations\Domain\Model\Location $location) {
		$location->setHidden(!$location->isHidden());
		$this->addMessage('message.entry_updated', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING, array($location->getHeadline()));
		$this->locationRepository->update($location);

		$this->redirect('adminList');
	}

	/**
	 * action moveRecord
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @param string                                  $dir
	 * @return void
	 */
	public function moveRecordAction(\S3b0\T3locations\Domain\Model\Location $location, $dir = 'up') {
		$origin = $location->getSorting();
		$destination = NULL;
		if ( $dir === 'up' ) {
			$destination = $this->locationRepository->findPrevious($location);
		} elseif ( $dir === 'down' ) {
			$destination = $this->locationRepository->findNext($location);
		}
		if ( $destination instanceof \S3b0\T3locations\Domain\Model\Location ) {
			$location->setSorting($destination->getSorting());
			$destination->setSorting($origin);
			$this->addMessage('message.entry_updated', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING, array($location->getHeadline()));
			$this->locationRepository->update($location);
			$this->locationRepository->update($destination);
		}

		$this->redirect('adminList');
	}

}