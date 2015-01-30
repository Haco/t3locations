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
 * SocialMediaLink
 */
class SocialMediaLink extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * link
	 *
	 * @var string
	 */
	protected $link = '';

	/**
	 * socialMedia
	 *
	 * @var \S3b0\T3locations\Domain\Model\SocialMedia
	 */
	protected $socialMedia = NULL;

	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		if ( $this->link && $this->socialMedia->getMode() === 1 || ($this->socialMedia->getMode() !== 1 && !file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->socialMedia->getIconOrClassName()))) ) {
			$linkconf = \TYPO3\CMS\Core\Utility\GeneralUtility::unQuoteFilenames($this->link, TRUE);
			if ( is_array($linkconf) && count($linkconf) ) {
				$linkconf[1] = $linkconf[1] ?: $GLOBALS['TSFE']->tmpl->extTarget ?: '_blank'; // Set target if not set
				$linkconf[2] = ($linkconf[2] ? $linkconf[2] . ' ' : '') . $this->socialMedia->getIconOrClassName(); // Add specified class name
				return '"' . implode('" "', $linkconf) . '"';
			}
		}

		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the socialMedia
	 *
	 * @return \S3b0\T3locations\Domain\Model\SocialMedia $socialMedia
	 */
	public function getSocialMedia() {
		return $this->socialMedia;
	}

	/**
	 * Sets the socialMedia
	 *
	 * @param \S3b0\T3locations\Domain\Model\SocialMedia $socialMedia
	 * @return void
	 */
	public function setSocialMedia(\S3b0\T3locations\Domain\Model\SocialMedia $socialMedia) {
		$this->socialMedia = $socialMedia;
	}

}