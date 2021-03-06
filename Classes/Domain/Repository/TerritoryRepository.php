<?php
namespace S3b0\T3locations\Domain\Repository;


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
use Ecom\EcomToolbox\Domain\Repository\AbstractRepository;

/**
 * The repository for Territories
 */
class TerritoryRepository extends AbstractRepository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = [
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	];

	/**
	 * Set repository wide settings
	 */
	public function initializeObject() {
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
		$querySettings->setRespectStoragePage(FALSE); // Disable storage pid
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * findByUidList - find and sort entities defined by list
	 *
	 * @param array $list
	 *
	 * @return null|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByUidList(array $list = []) {
		if ( count($list) === 0 ) {
			return NULL;
		}

		/** In order to keep orderings as set in flexForm, we fetch record by record, storing them into an ObjectStorage */
		$return = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		foreach ( $list as $uid ) {
			/** @var \S3b0\T3locations\Domain\Model\Territory $territory */
			$territory = $this->findByUid($uid);
			if ( $territory instanceof \S3b0\T3locations\Domain\Model\Territory && $territory->isVerified() ) {
				$return->attach($territory);
			}
		}

		return $return;
	}

}