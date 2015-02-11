<?php
namespace S3b0\T3locations\Validation\Validator;

/**
 * Validator for list-values
 */
class InListValidator extends AbstractValidator {

	/**
	 * @var array
	 */
	protected $supportedOptions = array(
		'list' => array('', 'Comma-separated list of accepted values.', 'string', TRUE),
	);

	/**
	 * The given value is valid if appearing in the specified list.
	 *
	 * @param mixed $value The value that should be validated
	 * @return void
	 */
	public function isValid($value) {
		if ( !\TYPO3\CMS\Core\Utility\GeneralUtility::inList($this->options['list'], $value) ) {
			$this->addError(nl2br($this->translateErrorMessage(
				'validator.list.notinlist',
				't3locations',
				array(
					$this->options['list'],
					$value
				)
			)), 1423132575, array($this->options['list'], $value));
		}
	}
}