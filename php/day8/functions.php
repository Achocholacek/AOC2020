<?php

function clb($string) {
            $string = str_replace("\n\r", "", $string);
            $string = str_replace("\r\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\n", "", $string);
            return $string;
}

function findJmpNop($array) {
    $idx = 0;
    $list = [];
    foreach ($array as $cmdLine) {
        if (strpos($cmdLine,"nop") !== false || strpos($cmdLine,"jmp") !== false) {
            array_push($list, $idx);
        }
        $idx++;
    }
    return $list;
}

