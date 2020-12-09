<?php
require_once('functions.php');
$filename = 'input.txt';
$preambleLength = 25;
$solveMatrix = generateMatrix($preambleLength);
$preamble = [];
$attackVector = null;

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
            }
            $preamble = advancePreamble($preamble, $num);
        }
        $i++;
    }
}

echo "The attack vector in the number list is the number " . $attackVector ."\n"; // 507622668