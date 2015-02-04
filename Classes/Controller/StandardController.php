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
 * StandardController
 */
class StandardController extends \S3b0\T3locations\Controller\LocationController {

	/**
	 * territoryRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\TerritoryRepository
	 * @inject
	 */
	protected $territoryRepository = NULL;

	/**
	 * Initializes the search action
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 * @return void
	 */
	public function initializeSearchAction() {
		/** All properties without any value (uid, string, array ...) are set to NULL */
		foreach ( $this->request->getArguments() as $property => $value ) {
			if ( !$value || (is_array($value) && array_key_exists('__identity', $value) && !$value['__identity']) ) {
				$this->request->setArgument($property, NULL);
			}
		}
	}

	/**
	 * action search
	 *
	 * @param \S3b0\T3locations\Domain\Model\Territory $territory
	 * @param \S3b0\T3locations\Domain\Model\Region    $region
	 * @return void
	 */
	public function searchAction(\S3b0\T3locations\Domain\Model\Territory $territory = NULL, \S3b0\T3locations\Domain\Model\Region $region = NULL) {
		$locations = NULL;

		/** Reset region if territory has been switched */
		if ( $region instanceof \S3b0\T3locations\Domain\Model\Region && $region->getTerritory() !== $territory ) {
			$region = NULL;
		}
		if ( $territory instanceof \S3b0\T3locations\Domain\Model\Territory && $locations = $this->locationRepository->findAll() ) {
			if ( $locations->count() ) {
				$this->moveToSecondSearchStep($locations, $territory, $region);
			}
		} elseif ( is_object($territory) ) {
			$this->throwStatus(404, 'Try another server dude!');
		}

		$this->view->assignMultiple(array(
			'pid' => $GLOBALS['TSFE']->id,
			'territory' => $territory,
			'territories' => $this->territoryRepository->findByUidList($this->settings['territories'] ? CoreUtility\GeneralUtility::intExplode(',', $this->settings['territories'], TRUE) : array())
		));
	}

	/**
	 * action admin
	 *
	 * @return void
	 */
	public function adminAction() {

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
	protected function moveToSecondSearchStep(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $locations, \S3b0\T3locations\Domain\Model\Territory $territory, \S3b0\T3locations\Domain\Model\Region $region = NULL) {
		if ( is_object($region) && !$region instanceof \S3b0\T3locations\Domain\Model\Region ) {
			$this->throwStatus(404, 'Try another server dude!');
		}

		/** Fetch locations if region is set */
		if ( $region instanceof \S3b0\T3locations\Domain\Model\Region ) {
			$locations = $this->locationRepository->findByRegion($region);
			$this->addMapMarkerJS($locations);
			$this->view->assign('locations', $locations);
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
			if ( $setup & 4 ) {
				if ( $location->getRegion()->getTerritory() === $territory && !$regions->contains($location->getRegion()) ) {
					$regions->attach($location->getRegion());
				}
			}
		}

		$this->view->assignMultiple(array(
			'region' => $region,
			'regions' => $regions
		));
	}

	/**
	 * Add map markers prior to map creation (looped in gmaps.js)
	 *
	 * @param \Countable $locations
	 * @return void
	 */
	public static function addMapMarkerJS(\Countable $locations) {
		$js = 'mapData = new Array();';
		$i = 0;
		/** @var \S3b0\T3locations\Domain\Model\Location $location */
		foreach ( $locations as $location ) {
			if ( $location->getGoogleMaps() && $location->getGoogleMaps()->getCoordinates() ) {
				$data = array(
					$location->getGoogleMaps()->getCoordinates()[0],
					$location->getGoogleMaps()->getCoordinates()[1],
					$location->getUid(),
					array(
						'"' . $location->getGoogleMaps()->getBackgroundColor() . '"',
						$location->getGoogleMaps()->getMapType(),
						$location->getGoogleMaps()->isMapTypeControl(),
						$location->getGoogleMaps()->getMapTypeControlStyle(),
						$location->getGoogleMaps()->getMapTypeControlPosition(),
						$location->getGoogleMaps()->getZoom(),
						$location->getGoogleMaps()->isZoomControl(),
						$location->getGoogleMaps()->getZoomControlStyle(),
						$location->getGoogleMaps()->getZoomControlPosition(),
						$location->getGoogleMaps()->getAdditionalFeatures()
					),
					'"' . CoreUtility\GeneralUtility::slashJS($location->getHeadline()) . '"',
					'"' . CoreUtility\GeneralUtility::slashJS($location->getType()->getTitle()) . '"',
					'"' . CoreUtility\GeneralUtility::slashJS($location->getCountry()->getTitle()) . '"',
					'"' . CoreUtility\GeneralUtility::slashJS('https://www.google.com/maps/dir//' . preg_replace('/\s+/i', '+', $location->getGoogleMaps()->getLinkQueryParam())) . '"',
					'"' . CoreUtility\GeneralUtility::slashJS(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('output.map_link_text', 't3locations')) . '"',
					'"' . CoreUtility\GeneralUtility::slashJS($location->getCountry()->getIsoCodeA2()) . '"',
					'"' . ($location->getCoverage()->count() ? CoreUtility\GeneralUtility::slashJS(implode(',', \S3b0\T3locations\Utility\Div::getCoverageList($location->getCoverage()))) : '') . '"'
				);
				$js .= 'mapData[' . $i . '] = ' . json_encode($data) . ';';
				$i++;
			}
		}
		$GLOBALS['TSFE']->additionalHeaderData[] = '<script type="text/javascript">' . $js . '//console.log(mapData);</script>';
	}

}