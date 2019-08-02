<?php
namespace AppBundle\Entity\Helpers;

class Generate
{
    public static function randomString(int $length)
    {
        //return base64_encode(openssl_random_pseudo_bytes(3 * ($length >> 2)));
        return substr(md5(microtime()), rand(0, 26), 8);
    }
}