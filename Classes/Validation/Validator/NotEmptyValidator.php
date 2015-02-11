<?php
namespace S3b0\T3locations\Validation\Validator;

/**
 * Validator for not empty values.
 */
class NotEmptyValidator extends AbstractValidator {

	/**
	 * This validator always needs to be executed even if the given value is empty.
	 * See AbstractValidator::validate()
	 *
	 * @var bool
	 */
	protected $acceptsEmptyValues = FALSE;

	/**
	 * Checks if the given property ($propertyValue) is not empty (NULL, empty string, empty array or empty object).
	 *
	 * If at least one error occurred, the result is FALSE.
	 *
	 * @param mixed $value The value that should be validated
	 * @return bool TRUE if the value is valid, FALSE if an error occurred
	 */
	public function isValid($value) {
		if ( $value === NULL ) {
			$this->addError(
				$this->translateErrorMessage(
					'validator.notempty.null',
					't3locations'
				), 1423127982);
		}
		if ( $value === '' ) {
			$this->addError(
				$this->translateErrorMessage(
					'validator.notempty.empty',
					't3locations'
				), 1423127983);
		}
		if ( is_array($value) && empty($value) ) {
			$this->addError(
				$this->translateErrorMessage(
					'validator.notempty.empty',
					't3locations'
				), 1423127984);
		}
		if ( is_object($value) && $value instanceof \Countable && $value->count() === 0 ) {
			$this->addError(
				$this->translateErrorMessage(
					'validator.notempty.empty',
					't3locations'
				), 1423127985);
		}
	}
}
