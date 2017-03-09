<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 11:02
 */

namespace AppBundle\Service\Utils;


class StringUtils
{
    public function generateUniqString($length){
        return $result = bin2hex(openssl_random_pseudo_bytes($length/2));
    }

    public function getSlug($string){
        $string = preg_replace("/['’]/", ' ', $string);
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
        $string = preg_replace('/[-\s]+/', '-', $string);
        return trim($string, '-');
    }
}