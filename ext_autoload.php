<?php
/**
 * Created by PhpStorm.
 * User: sebo
 * Date: 07.07.14
 * Time: 08:31
 */

	$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3locations') . 'Classes/';

	return array(
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\CheckForExistingResourceViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/CheckForExistingResourceViewHelper.php',
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\NegateViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/NegateViewHelper.php',
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\String\ConvertUtf8ToAsciiViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/String/ConvertUtf8ToAsciiViewHelper.php',
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\String\ReplaceViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/String/ReplaceViewHelper.php',
		'TYPO3\CMS\Fluid\ViewHelpers\S3b0\String\StripWhitespacesViewHelper' => $extensionClassesPath . 'ViewHelpers/S3b0/String/StripWhitespacesViewHelper.php'
	);