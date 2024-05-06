<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 19/10/2018
 * Time: 12:09
 */

namespace App\Utils;


class CodeHelper
{
    public static function generateCode($random_string_length){
        $characters = 'abcdefghijkmnpqrstuvwxyz123456789';
        $max = strlen($characters) - 1;
        $code = "";
        for ($i = 0; $i < $random_string_length; $i++) {
            $code .= $characters[mt_rand(0, $max)];
        }
        return $code;
    }
}