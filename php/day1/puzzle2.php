<?php
    $filename = 'p1input.txt';
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\n", fread($fp, filesize($filename)));
       $arrLen = count($array);
    }
    $solved = false;
    $idx = 0;

    function solve($a, $b, $c) {
        $sum = 0;
        $sum = $a + $b + $c;
        if ($sum == 2020) {
            $solution = $a * $b * $c;
        }
        else {
            $solution = false;
        }
        return $solution;
    }

    while ($idx <= $arrLen && $solved == $false) {
        $aIdx = $idx;
        $bIdx = $idx + 1;
        $cIdx = $idx + 2; 
        while ($bIdx <= $arrLen && $solved == false) {
            while ($cIdx <= $arrLen && $solved == false) {
                $a = $array[$aIdx];
                $b = $array[$bIdx];
                $c = $array[$cIdx];
                $solved = solve($a, $b, $c);
                if ($solved  == false) {
                    $cIdx++;
                }
                else {
                    echo "\nAnswer: " . $solved . "\n";
                break;
                }
            }
            $bIdx++;
            $cIdx = $bIdx + 1;
        }
        $idx++;
    }