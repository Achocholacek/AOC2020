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

function applyBitmask($value, $bitmask) {
    $newValue = "";
    $value = decbin($value);
    $valLen = strlen($value);
      if ($valLen < 36) {
        while (strlen($value) < 36) {
            $value = "0" . $value;
        }
    }
    $charIdx = strlen($value) -1;
    $maskIdx = strlen($bitmask) -1;
    while ($charIdx >= 0) {
        $valueBit = substr($value, $charIdx, 1);
        $maskBit = substr($bitmask, $maskIdx, 1);
        if ($maskBit != "X") {
            if ($maskBit == "0") $valueBit = 0;
            else $valueBit = 1;
        }
        $newValue = $valueBit . $newValue;
        $charIdx--;
        $maskIdx--;
    }
    return bindec($newValue);
}

function parseInstruction($address, $value, $currentMask) {
    global $addresses;
    $address = str_replace('mem[', '', $address);
    $address = str_replace(']', '', $address);
    $valueAfterMask = applyBitmask($value, $currentMask);
    $memIdx = intval($address) -1;
    $addresses[$memIdx] = $valueAfterMask;
}