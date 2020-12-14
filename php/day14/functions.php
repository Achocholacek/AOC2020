<?php

function clb($string) {
            $string = str_replace("\n\r", "", $string);
            $string = str_replace("\r\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\n", "", $string);
            return $string;
}

function f2a($filename) {
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\r\n", fread($fp, filesize($filename)));
       return $array;
    }
    else return false;
}