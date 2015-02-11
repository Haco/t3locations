<?php
/**
 * Created by PhpStorm.
 * User: sebo
 * Date: 09.02.15
 * Time: 11:36
 */

namespace S3b0\T3locations\Utility;


/**
 * Class Security
 *
 * @package S3b0\T3locations\Utility
 */
class Security {

	/**
	 * Check if user is authenticated
	 * @thought Might switch BE/FE access with extConf constant ... Version later
	 *
	 * @return bool
	 */
	public static function isAuthenticated() {
		return isset($GLOBALS['BE_USER']) && $GLOBALS['BE_USER']->user['uid'] > 0;
	}

	/**
	 * Check authenticated user against his roles
	 *
	 * @param array $roles
	 * @return bool
	 */
	public static function checkForUserRoles($roles = array()) {
		if ( count($roles) ) {
			foreach ( $roles as $role ) {
				if ( is_array($GLOBALS['BE_USER']->userGroups) && \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($role) ) {
					foreach ( $GLOBALS['BE_USER']->userGroups as $userGroup ) {
						if ( (int)$userGroup['uid'] === (int)$role ) {
							return TRUE;
						}
					}
				}
			}
		}

		return FALSE;
	}

}