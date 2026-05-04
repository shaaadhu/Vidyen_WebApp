<?php

class Env
{
    private static $data = [];

    public static function load($path)
    {
        if (!file_exists($path)) {
            die(".env file not found");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($key, $value) = explode('=', $line, 2);
            self::$data[trim($key)] = trim($value);
        }
    }

    public static function get($key, $default = null)
    {
        return self::$data[$key] ?? $default;
    }
}