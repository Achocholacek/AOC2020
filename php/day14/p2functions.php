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
        if ($maskBit != "0") {
            if ($maskBit == "1") $valueBit = 1;
            else $valueBit = "X";
        }
        $newValue = $valueBit . $newValue;
        $charIdx--;
        $maskIdx--;
    }
  return generateAddArray($newValue);
}

function generateAddArray($decString) {
    $floatCount = substr_count($decString, "X");
    $bitChanges = pow(2, $floatCount);
    $array = [];
    while (count($array) <= $bitChanges) {
       array_push($array, findFloaters($decString,0));
    }
}

function findFloaters($str, $index) 
{ 
    global $tempArray;
    if ($index == strlen($str)) 
    { 
        if (!in_array($str, $tempArray)) array_push($tempArray, $str);
        return; 
    } 
    if ($str[$index] == 'X') 
    { 
        $str[$index] = '0'; 
        findFloaters($str, $index + 1); 
        $str[$index] = '1'; 
        findFloaters($str, $index + 1);
    } 
  
    else
        findFloaters($str, $index + 1); 
} 

function parseInstruction($address, $value, $currentMask) {
    global $addresses, $fuckArray;
    $address = str_replace('mem[', '', $address);
    $address = str_replace(']', '', $address);
    applyBitmask($address, $currentMask);
    $destAddresses = $fuckArray;
    $fuckArray = [];
    foreach ($destAddresses as $dest) {
        $addr = bindec($dest);
        $memIdx = intval($addr) -1;
        $addresses[$memIdx] = $value;
    }
}