<?php

class Recaptcha
{
    private static $secretKey;
    private static $siteKey;

    private static function init()
    {
        self::$secretKey = Env::get('RECAPTCHA_SECRET_KEY');
        self::$siteKey   = Env::get('RECAPTCHA_SITE_KEY');
    }

    public static function getSiteKey()
    {
        self::init();
        return self::$siteKey;
    }

    //  v3 script (IMPORTANT: render=site_key)
    public static function getScript()
    {
        self::init();
        return '<script src="https://www.google.com/recaptcha/api.js?render=' . self::$siteKey . '"></script>';
    }

    //  Generate JS for any form (dynamic action)
    public static function renderScript($action = 'submit', $formId = null)
    {
        self::init();

        $formSelector = $formId 
        ? "document.getElementById('$formId')" 
        : "document.forms[0]";

        return "
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('" . self::$siteKey . "', {action: '{$action}'}).then(function(token) {
                    let input = document.getElementById('recaptcha_token');

                    if (!input) {
                        input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'recaptcha_token';
                        input.id = 'recaptcha_token';
                        document.forms[0].appendChild(input);
                    }

                    input.value = token;
                });
            });
        </script>
        ";
    }

    public static function getToken()
    {
        return $_POST['recaptcha_token'] ?? null;
    }

    public static function validateToken($token, $minScore = 0.5)
    {
        self::init();

        if (!$token) {
            return false;
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = [
            'secret'   => self::$secretKey,
            'response' => $token
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result  = @file_get_contents($url, false, $context);

        if ($result === false) {
            return false;
        }

        $response = json_decode($result, true);

        //  strict validation
        if (!isset($response['success']) || $response['success'] !== true) {
            return false;
        }

        //  score check (v3)
        if (($response['score'] ?? 0) < $minScore) {
            return false;
        }

        return true;
    }
}