<?php

namespace GoogleRecaptcha\Exception;

class VerificationException extends \Exception
{
    /**
     * Get error message string from error code
     * @param string $errorCode Google Recaptcha verification error code
     * @return string
     */
    static protected function getErrorMessage(string $errorCode): string
    {
        $errorMessages = [
            'missing-input-secret' => __('The secret parameter is missing.'),
            'invalid-input-secret' => __('The secret parameter is invalid or malformed.'),
            'missing-input-response' => __('The response parameter is missing.'),
            'invalid-input-response' => __('The response parameter is invalid or malformed.'),
            'bad-request' => __('The request is invalid or malformed.'),
            'timeout-or-duplicate' => __('The response is no longer valid: either is too old or has been used previously.'),
        ];

        if (array_key_exists($errorCode, $errorMessages)) {
            return $errorMessages[$errorCode];
        }

        return __('Unknown error');
    }

    /**
     * @param string $errorCode Google Recaptcha verification error code
     */
    public function __construct(string $errorCode)
    {
        parent::__construct(self::getErrorMessage($errorCode));
    }
}
