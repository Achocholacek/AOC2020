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
$builtIn = $highestJoltage + 3; 
array_push($array, $builtIn);
$blockLength = 1;
$combos = 1;
$trib = [0, 1, 1, 2, 4, 7, 13, 24, 44, 81, 149, 274, 504, 927, 1705, 3136, 5768, 10609, 19513, 35890, 66012, 121415, 223317, 410744, 755476, 1389537, 2555757, 4700770, 8646064, 15902591, 29249425, 53798080, 98950096, 181997601, 334745777, 615693474, 1132436852];
$loop = 0;
while ($loop < count($array)) {
    
    $diff = abs($array[$loop-1] - $array[$loop]);
    if ($diff == 1) {
        $blockLength++;
        $diffs[$diff] += 1;
        $effJoltage += $diff;
    }
    else if ($diff == 3) {
        $diffs[$diff] += 1;
        echo "checking BL at " . $blockLength . "\n";
        $combos = $combos * $trib[$blockLength];
        $blockLength = 1;
    }
    $loop++;
}
  
echo "The Answer is " . $combos . "\n";