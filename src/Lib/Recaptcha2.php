<?php

namespace GoogleRecaptcha\Lib;

use Cake\Log\Log;
use GoogleRecaptcha\Exception\VerificationException;

class Recaptcha2
{
    /**
     * Verify a GoogleRecaptchaV2 response
     *
     * @link https://developers.google.com/recaptcha/docs/verify
     *
     * @param string $secretKey Google Recaptcha v2 site key
     * @param string $response Google Recaptcha response
     * @param string|null $remoteIp Client remote IP
     * @return bool
     * @throws VerificationException
     */
    public static function verify(string $secretKey, string $response, ?string $remoteIp = null)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['secret' => $secretKey, 'response' => $response/*, 'remoteIp' => $remoteIp*/]
        ]);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        self::log(sprintf("Result for %s: %s", $response, $result));

        if ($info['http_code'] != 200) {
            throw new VerificationException('request-failed');
        }

        $data = json_decode($result, true);
        if (isset($data['error-codes'])) {
            self::log(sprintf("Verification errors for %s: %s", $response, join(',', $data['error-codes'])));
            throw new VerificationException($data['error-codes'][0]);
        }

        $success = $data['success'] ?? false;
        if (!$success) {
            throw new VerificationException('invalid-input-response');
        }

        self::log(sprintf("Verification SUCCESSFUL for %s", $response));

        return true;
    }

    /**
     * @param string $message Log message
     * @return void
     */
    protected static function log($message)
    {
        Log::debug($message, ['google_recaptcha']);
    }
}
