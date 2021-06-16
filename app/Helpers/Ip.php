<?php

namespace App\Helpers;

class Ip
{
    /**
     * Get request ip address
     *
     * @return string
     */
    public static function getRequestIp(): string
    {
        // If cloudflare
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        return @$_SERVER['REMOTE_ADDR'] ?: '';
    }

    /**
     * Get request country code
     *
     * @return string
     */
    public static function getRequestCountryCode(): string
    {
        if (isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {
            return $_SERVER['HTTP_CF_IPCOUNTRY'];
        }

        return 'XX';
    }
}
