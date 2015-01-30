<?php
namespace S3b0\T3locations\Utility;

/**
 * Created by PhpStorm.
 * User: sebo
 * Date: 08.01.15
 * Time: 09:49
 */

use \TYPO3\CMS\Core\Utility\GeneralUtility;

class Div {

	/**
	 * @param \Countable $coverage
	 * @param string     $property
	 *
	 * @return array
	 */
	final public static function getCoverageList($coverage, $property = 'isoCodeA2') {
		$list = array();
		if ( $coverage instanceof \Countable ) {
			/** @var \S3b0\T3locations\Domain\Model\Region $country */
			foreach ( $coverage as $country ) {
				if ( $country instanceof \S3b0\T3locations\Domain\Model\Region && $country->_hasProperty($property) && $country->_getProperty($property) ) {
					$list[] = $country->_getProperty($property);
				}
			}
			$list = array_unique($list); // Remove duplicates
		}

		return $list;
	}

	/**
	 * getUrl
	 *
	 * @param string $requestUri
	 * @return mixed
	 */
	public static function getUrl($requestUri) {
		$response = GeneralUtility::getUrl($requestUri, 0, array(TYPO3_user_agent));
		// No response, force cURL if disabled in configuration but found in system
		if ( $response === FALSE && function_exists('curl_init') && empty($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse']) ) {
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] = TRUE;
			$response = GeneralUtility::getUrl($requestUri, 0, array(TYPO3_user_agent));
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] = FALSE;
		}

		// Still no response, try file_get_contents if allow_url_fopen is enabled
		if ( $response === FALSE && function_exists('file_get_contents') && ini_get('allow_url_fopen') ) {
			$response = file_get_contents($requestUri);
		}

		// Can not fetch url, return
		if ( $response === FALSE ) {
			return FALSE;
		}

		return $response;
	}

}