<?php
$validCount = 0;
$filename = 'input.txt';
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\n", fread($fp, filesize($filename)));
       $arrLen = count($array);
       foreach($array as $passLine) {
           $passArray = explode(':', $passLine);
           $reqString = $passArray[0];
           $passString = $passArray[1];
           $reqBreak = explode(' ', $reqString);
           $reqRange = $reqBreak[0];
           $reqLetter = $reqBreak[1];
           $reqNums = explode('-', $reqRange);
           $low = $reqNums[0];
           $high = $reqNums[1];
           $count = substr_count($passString, $reqLetter);
           if ($count >= $low && $count <= $high) {
               $validCount++;
           }
       }
}

echo "There are " . $validCount . " valid passwords in this file.\n";