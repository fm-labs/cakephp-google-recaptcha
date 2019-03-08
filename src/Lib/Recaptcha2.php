<?php

namespace GoogleRecaptcha\Lib;

class Recaptcha2
{
    /**
     * Verify a google recaptcha response
     *
     * @link https://developers.google.com/recaptcha/docs/verify
     *
     * @param string $secretKey Google Recaptcha v2 site key
     * @param string $response Google Recaptcha response
     * @param null|string $remoteIp Client remote IP
     * @return bool
     */
    public static function verify($secretKey, $response, $remoteIp = null)
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

        if ($info['http_code'] != 200) {
            return false;
        }

        $data = json_decode($result, true);
        if (isset($data['success']) && $data['success'] == true) {
            return true;
        }

        return false;
    }
}
