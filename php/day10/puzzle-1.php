<?php
require_once('functions.php');
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
if ($fp) {
    $array = explode("\r\n", fread($fp, filesize($filename)));
    $arrLen = count($array);
}


sort($array);
$highestJoltage = $array[$arrLen-1];
array_push($array, $highestJoltage + 3);
$diffs = [];

$effJoltage = 0;
foreach ($array as $joltage) {
    $diff = $joltage - $effJoltage;
    if ($diff <= 3) {
        $diffs[$diff] += 1;
        $effJoltage += $diff;
    }
}

echo "The Answer is " . $diffs[1] * $diffs[3] . "\n";