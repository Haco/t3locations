<?php
namespace S3b0\T3locations\Domain\Model;


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
 * Map
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $title = '';

	/**
	 * @var string
	 */
	protected $coordinates = '';

	/**
	 * @var string
	 */
	protected $linkQueryParam = '';

	/**
	 * @var string
	 */
	protected $backgroundColor = 'white';

	/**
	 * @var integer
	 */
	protected $mapType = 0;

	/**
	 * @var boolean
	 */
	protected $mapTypeControl = TRUE;

	/**
	 * @var integer
	 */
	protected $mapTypeControlStyle = 1;

	/**
	 * @var integer
	 */
	protected $mapTypeControlPosition = 9;

	/**
	 * @var integer
	 */
	protected $zoom = 8;

	/**
	 * @var boolean
	 */
	protected $zoomControl = TRUE;

	/**
	 * @var integer
	 */
	protected $zoomControlStyle = 0;

	/**
	 * @var integer
	 */
	protected $zoomControlPosition = 4;

	/**
	 * @var integer
	 */
	protected $additionalFeatures = 99;

	/**
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return array|null $coordinates
	 */
	public function getCoordinates() {
		if ( !$this->coordinates && $this->linkQueryParam ) {
			$json = json_decode(\S3b0\T3locations\Utility\Div::getUrl('https://maps.google.com/maps/api/geocode/json?sensor=false&address=' . preg_replace('/\s+/i', '+', $this->linkQueryParam)));
			if ( $json->status === 'OK' ) {
				$this->coordinates = $json->results[0]->geometry->location->lat . ',' . $json->results[0]->geometry->location->lng;
			}
		}

		return $this->coordinates ? \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->coordinates, TRUE, 2) : NULL;
	}

	/**
	 * @param string $coordinates
	 * @return void
	 */
	public function setCoordinates($coordinates) {
		$this->coordinates = $coordinates;
	}

	/**
	 * @return string $linkQueryParam
	 */
	public function getLinkQueryParam() {
		return $this->linkQueryParam;
	}

	/**
	 * @param string $linkQueryParam
	 * @return void
	 */
	public function setLinkQueryParam($linkQueryParam) {
		$this->linkQueryParam = $linkQueryParam;
	}

	/**
	 * @return string
	 */
	public function getBackgroundColor() {
		return $this->backgroundColor;
	}

	/**
	 * @return integer
	 */
	public function getMapType() {
		return $this->mapType;
	}

	/**
	 * @return boolean
	 */
	public function isMapTypeControl() {
		return $this->mapTypeControl;
	}

	/**
	 * @return integer
	 */
	public function getMapTypeControlStyle() {
		return $this->mapTypeControlStyle;
	}

	/**
	 * @return integer
	 */
	public function getMapTypeControlPosition() {
		return $this->mapTypeControlPosition;
	}

	/**
	 * @return integer
	 */
	public function getZoom() {
		return $this->zoom;
	}

	/**
	 * @return boolean
	 */
	public function isZoomControl() {
		return $this->zoomControl;
	}

	/**
	 * @return integer
	 */
	public function getZoomControlStyle() {
		return $this->zoomControlStyle;
	}

	/**
	 * @return integer
	 */
	public function getZoomControlPosition() {
		return $this->zoomControlPosition;
	}

	/**
	 * @return array
	 */
	public function getAdditionalFeatures() {
		return array(
			boolval($this->additionalFeatures & 1),
			boolval($this->additionalFeatures & 2),
			boolval($this->additionalFeatures & 4),
			boolval($this->additionalFeatures & 8),
			boolval($this->additionalFeatures & 16),
			boolval($this->additionalFeatures & 32),
			boolval($this->additionalFeatures & 64),
			boolval($this->additionalFeatures & 128)
		);
	}

}