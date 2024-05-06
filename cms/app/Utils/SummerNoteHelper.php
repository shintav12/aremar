<?php
namespace App\Utils;


class SummerNoteHelper
{
    public static function cleanHTML(string $text){
        $result = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
        $matches = [];
        preg_match_all("/<\s*p[^>]*>([^<]*)<\s*\/\s*p\s*>/", $result,$matches);
        if(count($matches[0]) == 0){
            $result = "<p>".$result."</p>";
        }
        $result = str_replace('"', "'", $result);
        return json_encode($result);
    }
}