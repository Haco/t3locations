<?php
/**
 * Created by PhpStorm.
 * User: sebo
 * Date: 05.02.15
 * Time: 10:57
 */

namespace S3b0\T3locations\Controller;

use \TYPO3\CMS\Core\Utility as CoreUtility;

/**
 * Class AbstractController
 *
 * @package S3b0
 * @subpackage t3locations
 */
class ExtensionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * locationRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository = NULL;

	/**
	 * locationTypeRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\LocationTypeRepository
	 * @inject
	 */
	protected $locationTypeRepository = NULL;

	/**
	 * regionRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\RegionRepository
	 * @inject
	 */
	protected $regionRepository = NULL;

	/**
	 * socialMediaRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\SocialMediaRepository
	 * @inject
	 */
	protected $socialMediaRepository = NULL;

	/**
	 * stateRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\StateRepository
	 * @inject
	 */
	protected $stateRepository = NULL;

	/**
	 * territoryRepository
	 *
	 * @var \S3b0\T3locations\Domain\Repository\TerritoryRepository
	 * @inject
	 */
	protected $territoryRepository = NULL;

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
	 */
	protected function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		parent::initializeView($view);
		$actionsRequiringExtSettings = array('adminList', 'new', 'create', 'edit', 'update', 'delete', 'verify');

		/** Only load settings if needed, for performance reasons */
		if ( in_array($this->request->getControllerActionName(), $actionsRequiringExtSettings) ) {
			$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ strtolower($this->extensionName) ]);
			$view->assign('extSettings', $settings);
		}
		$view->assignMultiple(array(
			'pageUid' => $GLOBALS['TSFE']->id,
			'language' => $GLOBALS['TSFE']->sys_language_uid
		));
	}

	/**
	 * Initialize action
	 * Check sensitive actions for security, only validated BE users belonging to corresponding group will gain access!
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	protected function initializeAction() {
		/** Generally deny access to the "Manager" plugin for not authenticated users */
		if ( $this->request->getPluginName() === 'Manager' && !\S3b0\T3locations\Utility\Security::isAuthenticated() ) {
			$this->throwStatus(404, 'Access denied');
		}

		/** @var array $actionsRequiringAccessRights List of actions that require at least editor access */
		$actionsRequiringAccessRights = array('new', 'create', 'edit', 'update', 'delete', 'verify');
		/** @var array $actionsRequiringAdminRights List of actions that require admin access */
		$actionsRequiringAdminRights = array('delete', 'verify');

		/**
		 * Check for access rights
		 */
		if ( in_array($this->request->getControllerActionName(), $actionsRequiringAccessRights) ) {
			$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][strtolower($this->extensionName)]);
			$checkFailed = TRUE;
			if ( \S3b0\T3locations\Utility\Security::isAuthenticated() ) {
				/** Check administrative rights */
				if ( in_array($this->request->getControllerActionName(), $actionsRequiringAdminRights) ) {
					$checkFailed = \S3b0\T3locations\Utility\Security::checkForUserRoles(array($settings['admins'])) ? FALSE : TRUE;
				/** Check editor rights */
				} else {
					$checkFailed = \S3b0\T3locations\Utility\Security::checkForUserRoles(array($settings['admins'], $settings['editors'])) ? FALSE : TRUE;
				}
			}

			if ( $checkFailed )
				$this->throwStatus(404, 'Access denied');
		}
	}

	/**
	 * @param string $translateId
	 * @param int    $status
	 * @param array  $translateArguments
	 * @return void
	 */
	protected function addMessage($translateId = '', $status = \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, $translateArguments = array()) {
		$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($translateId, $this->extensionName, $translateArguments), '', $status);
	}

	/**
	 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject $object
	 * @param string                                               $redirectAction
	 */
	protected function verifyAction(\TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject $object, $redirectAction = 'adminList') {
		$domainModel = '\\' . $this->request->getControllerVendorName() . '\\' . $this->request->getControllerExtensionName() . '\\Domain\\Model\\' . $this->request->getControllerName();
		$repository = lcfirst($this->request->getControllerName()) . 'Repository';

		/** @var \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject $object */
		if ( $object instanceof $domainModel ) {
			if ( $object->_hasProperty('verified') ) {
				$object->setVerified(TRUE);
				$this->addMessage('message.entry_verified', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO, array($object->_hasProperty('title') ? $object->getTitle() : ''));
				$this->{$repository}->update($object);
			} else {
				$this->addMessage('message.error_property', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array('verified'));
			}
		} else {
			$this->addMessage('message.error_model', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, array($domainModel));
		}

		$this->redirect($redirectAction);
	}

	/**
	 * Add map markers prior to map creation (looped in gmaps.js)
	 *
	 * @param \Countable $locations
	 * @param boolean    $returnData
	 *
	 * @return array|void
	 */
	protected function addMapMarkerJS(\Countable $locations, $returnData = FALSE) {
		$data = array();
		$js = 'mapData = new Array();';
		$i = 0;
		/** @var \S3b0\T3locations\Domain\Model\Location $location */
		foreach ( $locations as $location ) {
			if ( $location instanceof \S3b0\T3locations\Domain\Model\Location && $location->getGoogleMaps() instanceof \S3b0\T3locations\Domain\Model\Map && $location->getGoogleMaps()->getCoordinates() ) {
				$data[$i] = array(
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
					CoreUtility\GeneralUtility::slashJS($location->getHeadline()),
					CoreUtility\GeneralUtility::slashJS($location->getType()->getTitle()),
					CoreUtility\GeneralUtility::slashJS($location->getCountry()->getTitle()),
					CoreUtility\GeneralUtility::slashJS('https://www.google.com/maps/dir//' . preg_replace('/\s+/i', '+', $location->getGoogleMaps()->getLinkQueryParam())),
					CoreUtility\GeneralUtility::slashJS(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('output.map_link_text', $this->extensionName)),
					CoreUtility\GeneralUtility::slashJS($location->getCountry()->getIsoCodeA2()),
					($location->getCoverage()->count() ? CoreUtility\GeneralUtility::slashJS(implode(',', \S3b0\T3locations\Utility\Div::getCoverageList($location->getCoverage()))) : '')
				);
				$js .= 'mapData[' . $i . '] = ' . json_encode($data[$i]) . ';';
				$i++;
			}
		}

		if ( $returnData ) {
			return $data;
		} else {
			$GLOBALS['TSFE']->additionalHeaderData[] = '<script type="text/javascript">' . $js . '</script>';
		}
	}

	/**
	 * @return bool
	 */
	protected function getErrorFlashMessage() {
		return FALSE;
	}

}