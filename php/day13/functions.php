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

function findDiffs($startTs, $incVal, $magicBus) {
    global $busList, $offsets;
    $lastVal = 0;
    $diffCt = 0;
    $newTs = 0;
    $foundAnswer = false;
    while ($foundAnswer == false) {
        foreach($busList as $bus) {
            $target = $startTs + $offsets[$bus];
            if (($target % $bus) == 0) {
                if ($bus == $magicBus) {
                    $diff = (intval($startTs)-intval($lastVal));
                    $diffCt++;
                    if ($diffCt == 1) $newTs = $diff;
                    else if ($diffCt == 2) {
                        $result['inc'] = $diff;
                        $result['ts'] = $newTs;                       
                        $foundAnswer = true;
                    }
                   $lastVal = $diff;
                }
            }
            else break;
        }
        $startTs += $incVal;
    }
    return $result;
}

function notX ($value) {
    if ($value != "x") {
        return true;
    }
    else return false;
}