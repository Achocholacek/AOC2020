<?php
    $filename = 'p1input.txt';
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\n", fread($fp, filesize($filename)));
       $arrLen = count($array);
    $arrPos = 1;
    $curPos = 0;
    $solved = false;
    $solution = 0;
    foreach ($array as $value) {
        if (!$solved) {
            $curPos = $arrPos;
            while ($curPos <= $arrLen) {
                $sum = $value + $array[$curPos + 1];
                if ($sum == 2020) {
                    $solution = $value * $array[$curPos + 1];
                    $solved = true;
                }
                $curPos++;
            }            
        }
        $arrPos++;
    }
        echo "The Solution is " . $solution ."\n";
    }
    

    
    
   