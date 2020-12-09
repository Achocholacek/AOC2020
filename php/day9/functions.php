<?php

function clb($string) {
            $string = str_replace("\n\r", "", $string);
            $string = str_replace("\r\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\n", "", $string);
            return $string;
}

function advancePreamble($preamble, $num) {
    $newPreamble = [];
    $first = true;
    foreach ($preamble as $pre) {
        if (!$first) {
            array_push($newPreamble, $pre);
        }
        else {
            $first = false;
        }
    }
    array_push($newPreamble, $num);
    return $newPreamble;
}

function validXmas($number, $preamble, $matrix) {
    $validSolutions = 0;
    foreach ($matrix as $ints) {
        if ($preamble[$ints[0]] + $preamble[$ints[1]] == $number) $validSolutions++;
    }
    return $validSolutions;   
}


function generateMatrix($size) {
    $matrix = [];
    $a = 0;
    while ($a < $size) {
        $b = $a + 1;
        while ($b <= $size) {
            array_push($matrix, [$a, $b]);
            $b++;
        }
        $a++;   
    }
    return $matrix;
}