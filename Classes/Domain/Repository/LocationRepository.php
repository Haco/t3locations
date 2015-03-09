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

/**
 * The repository for Locations
 */
class LocationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/**
	 * findByRegion - special function, because regions are defined in multiple fields in different relations (n:1|m:n)
	 *
	 * @param \S3b0\T3locations\Domain\Model\Region $region
	 * @param boolean                               $filterByFieldToUseInSearchMask
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByRegion(\S3b0\T3locations\Domain\Model\Region $region, $filterByFieldToUseInSearchMask = FALSE) {
		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalOr(array(
				$query->equals('country', $region),
				$query->contains('coverage', $region),
				$query->equals('region', $region)
			))
		)->execute();

		if ( $filterByFieldToUseInSearchMask && $result->count() ) {
			$return = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
			/** @var \S3b0\T3locations\Domain\Model\Location $location */
			foreach ( $result as $location ) {
				$setup = $location->getFieldToUseInSearchMask();
				/** Country */
				if ( $setup & 1 ) {
					if ( $region === $location->getCountry() && !$return->contains($location) ) {
						$return->attach($location);
					}
				}
				/** Coverage */
				if ( $setup & 2 && $location->getCoverage()->count() ) {
					/** @var \S3b0\T3locations\Domain\Model\Region $country */
					foreach ( $location->getCoverage() as $country ) {
						if ( $region === $country && !$return->contains($location) ) {
							$return->attach($location);
						}
					}
				}
				/** Region */
				if ( $setup & 4 && $location->getRegion() instanceof \S3b0\T3locations\Domain\Model\Region ) {
					if ( $region === $location->getRegion() && !$return->contains($location) ) {
						$return->attach($location);
					}
				}
			}
		} else {
			$return = $result;
		}

		return $return;
	}

	/**
	 * findByUidList - find and sort entities defined by list
	 *
	 * @param array   $list
	 * @param integer $mode Current modes are 0=excludeList, default=addList
	 * @return null|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByUidList(array $list = array(), $mode = 1) {
		/** In order to keep orderings as set in flexForm, we fetch record by record, storing them into an ObjectStorage */
		$return = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		if ( $mode === 0 ) {
			/** @var \S3b0\T3locations\Domain\Model\Location $location */
			foreach ( $this->findAll() as $location ) {
				if ( $location instanceof \S3b0\T3locations\Domain\Model\Location && !in_array($location->getUid(), $list) ) {
					$return->attach($location);
				}
			}
		} else {
			foreach ( $list as $uid ) {
				/** @var \S3b0\T3locations\Domain\Model\Location $location */
				$location = $this->findByUid($uid);
				if ( $location instanceof \S3b0\T3locations\Domain\Model\Location ) {
					$return->attach($location);
				}
			}
		}

		return $return;
	}

	/**
	 * Find previous record by sorting
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @return \S3b0\T3locations\Domain\Model\Location|null
	 */
	public function findPrevious(\S3b0\T3locations\Domain\Model\Location $location) {
		$query = $this->createQuery();

		return $query->matching(
			$query->logicalAnd(array(
				$query->equals('pid', $location->getPid()),
				$query->lessThan('sorting', $location->getSorting())
			))
		)->setOrderings(
			array(
				'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
			)
		)->execute()->getFirst();
	}

	/**
	 * Find next record by sorting
	 *
	 * @param \S3b0\T3locations\Domain\Model\Location $location
	 * @return \S3b0\T3locations\Domain\Model\Location|null
	 */
	public function findNext(\S3b0\T3locations\Domain\Model\Location $location) {
		$query = $this->createQuery();

		return $query->matching(
			$query->logicalAnd(array(
				$query->equals('pid', $location->getPid()),
				$query->greaterThan('sorting', $location->getSorting())
			))
		)->setOrderings(
			array(
				'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
			)
		)->execute()->getFirst();
	}
}