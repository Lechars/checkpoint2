<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        $strTab = preg_split("/ /", $str);
        $strTabRev = array_reverse($strTab);
        $strTabRev[0] = ucfirst($strTabRev[0]);
        $strYoda = implode(" ", $strTabRev);
        return $strYoda;
    }
}
