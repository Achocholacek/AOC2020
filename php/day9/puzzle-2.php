<?php
require_once('functions.php');
$filename = 'input.txt';
$preambleLength = 25;
$solveMatrix = generateMatrix($preambleLength);
$preamble = [];
$attackVector = null;
$encryptionFlaw = null;
$fp = @fopen($filename, 'r');
if ($fp) {
    $array = explode("\r\n", fread($fp, filesize($filename)));
    $arrLen = count($array);
    $i = 0;
    while ($i < $preambleLength) {
        array_push($preamble, $array[$i]);
        $i++;
    }
    while ($i < $arrLen) {
        if ($i  >= $preambleLength) {
            $num = $array[$i];
            $solutions = validXmas($num, $preamble, $solveMatrix);
            if ($solutions == 0) {
                $attackVector = $num;
                $i = $arrLen;
            }
            $preamble = advancePreamble($preamble, $num);                
        }
        $i++;
    }
    if ($attackVector != null) {
        $i = 0;
        while ($i < $arrLen) {
            $stop = false;
            $solved = false;
            $sum = 0;
            $a = $i;
            while (!$stop) {
                $sum += $array[$a];
                if ($sum == $attackVector) {
                    $solved = true;
                    $stop = true;
                } else if($sum > $attackVector) {
                    $stop = true;
                }
                else {
                    $a++;
                }
            }
            if ($solved) {
                $loop = $i;
                $sortArray = [];
                while ($loop <= $a) {
                    array_push($sortArray, $array[$loop]);
                    $loop++;
                }
                sort($sortArray);
                $sortLen = count($sortArray) - 1;
                $encryptionFlaw = ($sortArray[0] + $sortArray[$sortLen]);
                echo "The Flaw in the Encryption is " . $encryptionFlaw ."\n"; // 76688505
                $i = $arrLen;
            }
            $i++;
        }
    }
}