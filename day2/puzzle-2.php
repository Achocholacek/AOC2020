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
           $pos1 = $reqNums[0];
           $pos2 = $reqNums[1];
           $first = substr($passString,$pos1, 1);
           $last = substr($passString,$pos2, 1);
           if ( (($first == $reqLetter) && ($last != $reqLetter)) || (($first != $reqLetter) && ($last == $reqLetter)) ) {
               $validCount++;
           }
       }
}

echo "There are " . $validCount . " valid passwords in this file.\n";