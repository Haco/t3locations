<?php
namespace S3b0\T3locations\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
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
 * AjaxRequestController
 */
class AjaxRequestController extends \S3b0\T3locations\Controller\ExtensionController {

	/**
	 * @var \TYPO3\CMS\Extbase\Mvc\View\JsonView $view
	 */
	protected $view;

	/**
	 * @var string
	 */
	protected $defaultViewObjectName = 'TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView';

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * Override this method to solve tasks which all actions have in
	 * common.
	 *
	 * @return void
	 * @api
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	public function initializeAction() {
		global $TYPO3_CONF_VARS;
		/** !!! IMPORTANT TO MAKE JSON WORK !!! */
		$TYPO3_CONF_VARS['FE']['debug'] = '0';
	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
	public function initializeGetDataAction() {
		if ( $this->request->hasArgument('territory') && !$this->request->getArgument('territory') instanceof \S3b0\T3locations\Domain\Model\Territory ) {
			if ( \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($this->request->getArgument('territory')) ) {
				$this->request->setArgument('territory', $this->territoryRepository->findByUid($this->request->getArgument('territory')));
			} else {
				$this->request->setArgument('territory', NULL);
			}
		}
		if ( $this->request->hasArgument('region') && !$this->request->getArgument('region') instanceof \S3b0\T3locations\Domain\Model\Region ) {
			if ( \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($this->request->getArgument('region')) ) {
				$this->request->setArgument('region', $this->regionRepository->findByUid($this->request->getArgument('region')));
			} else {
				$this->request->setArgument('region', NULL);
			}
		}
		if ( !$this->request->hasArgument('territory') && $this->request->hasArgument('region') && $this->request->getArgument('region') instanceof \S3b0\T3locations\Domain\Model\Region ) {
			$this->request->setArgument('territory', $this->request->getArgument('region')->getTerritory());
		}
	}

	/**
	 * action getData
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 *
	 * @return void
	 */
	public function getDataAction(\S3b0\T3locations\Domain\Model\Territory $territory, \S3b0\T3locations\Domain\Model\Region $region = NULL) {
		if ( $locations = $this->locationRepository->setExtQuerySettings()->findAll() ) {
			if ( $locations->count() ) {
				$this->getValue($locations, $territory, $region);
			}
		}
	}

	/**
	 * Second search step (select country)
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $locations
	 * @param \S3b0\T3locations\Domain\Model\Territory            $territory
	 * @param \S3b0\T3locations\Domain\Model\Region               $region
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 * @return void
	 */
	private function getValue(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $locations, \S3b0\T3locations\Domain\Model\Territory $territory, \S3b0\T3locations\Domain\Model\Region $region = NULL) {
		if ( is_object($region) && !$region instanceof \S3b0\T3locations\Domain\Model\Region ) {
			$this->throwStatus(404, 'An error occurred!');
		}

		/** Initialize new ObjectStorage to be filled with selectable regions */
		$regions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		/** @var \S3b0\T3locations\Domain\Model\Location $location */
		foreach ( $locations as $location ) {
			$setup = $location->getFieldToUseInSearchMask();
			/** Country */
			if ( $setup & 1 ) {
				if ( $location->getCountry()->getTerritory() === $territory && !$regions->contains($location->getCountry()) ) {
					$regions->attach($location->getCountry());
				}
			}
			/** Coverage */
			if ( $setup & 2 && $location->getCoverage()->count() ) {
				/** @var \S3b0\T3locations\Domain\Model\Region $country */
				foreach ( $location->getCoverage() as $country ) {
					if ( $country->getTerritory() === $territory && !$regions->contains($country) ) {
						$regions->attach($country);
					}
				}
			}
			/** Region */
			if ( $setup & 4 && $location->getRegion() instanceof \S3b0\T3locations\Domain\Model\Region ) {
				if ( $location->getRegion()->getTerritory() === $territory && !$regions->contains($location->getRegion()) ) {
					$regions->attach($location->getRegion());
				}
			}
		}

		/** Fetch locations if region is set */
		if ( $region instanceof \S3b0\T3locations\Domain\Model\Region ) {
			$locations = $this->locationRepository->findByRegion($region, TRUE);
			$mapData = $this->addMapMarkerJS($locations, TRUE);
			$addMapCanvas = FALSE;
			/** @var \S3b0\T3locations\Domain\Model\Location $location */
			foreach ( $locations as $location ) {
				if ( $location->getGoogleMaps() instanceof \S3b0\T3locations\Domain\Model\Map ) {
					$addMapCanvas = TRUE;
					break;
				}
			}
			$html = $this->getHTML('ResultingLocations', ['locations' => $locations, 'region' => $region, 'addMapCanvas' => $addMapCanvas, 'gmJS' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScripts/gmaps.min.js']);
			$this->view->assign('value', new \ArrayObject(array(
				'html' => $html,
				'mapData' => $mapData,
				'addMapCanvas' => $addMapCanvas
			)));
		} else {
			$this->view->assign('value', \S3b0\T3locations\Utility\ObjectStorageSortingUtility::sortByProperty('firstLetter', $regions, TRUE));
		}
	}

	/**
	 * @param string $templateName template name (UpperCamelCase)
	 * @param array $variables variables to be passed to the Fluid view
	 *
	 * @return string
	 */
	private function getHTML($templateName, array $variables = array()) {
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath'] ?: end($extbaseFrameworkConfiguration['view']['templateRootPaths']));
		$partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath'] ?: end($extbaseFrameworkConfiguration['view']['partialRootPaths']));
		$templatePathAndFilename = $templateRootPath . 'StandAloneViews/' . $templateName . '.html';
		$view->setTemplatePathAndFilename($templatePathAndFilename);
		$view->setPartialRootPaths(array($partialRootPath));
		$view->assignMultiple($variables);
		$view->setFormat('html');

		return $view->render();
	}

}
