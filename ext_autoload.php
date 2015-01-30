<?php
/**
 * Created by PhpStorm.
 * User: sebo
 * Date: 07.07.14
 * Time: 08:31
 */

	$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3locations') . 'Classes/';

	return array(
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\CheckForExistingResourceViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/CheckForExistingResourceViewHelper.php'
	);