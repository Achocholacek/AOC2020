<?php

function getSeatID($row, $column) {
    return ($row * 8) + $column;
}

function makeRowArray() {
    $array = [];
    $int = 0;
    while ($int < 128) {
        array_push($array, $int);
        $int++;
    }
    return $array;
}

function decodeRow($rowString) {
    $rowArray = makeRowArray();
    $decodeArray = str_split($rowString);
    foreach ($decodeArray as $code) {
        $arrLen = count($rowArray);
        $midPoint = floor(count($rowArray)/2);
        if($code == "F") {
            $rowArray = array_slice($rowArray, 0, $midPoint);
        }
        else {
            $rowArray = array_slice($rowArray, $midPoint, $arrLen);
        }
    }
    return intval($rowArray[0]);
}

function decodeCol($colString) {
    $solution = "01234567";
    $first = substr($colString, 0,1);
    $second = substr($colString, 1,1);
    $third = substr($colString, 2,1);
    if ($first == "R") {
        $solution = substr($solution, 4,4);
    }
    else {
        $solution = substr($solution, 0,4);
    }

    if ($second == "R") {
        $solution = substr($solution, 2, 2);
    }
    else {
        $solution = substr($solution, 0, 2);
    }
    if ($third == "R") {
        $solution = substr($solution, 1, 1);
    }
    else {
        $solution = substr($solution, 0, 1);
    }
    return intval($solution);
}

function parseSeatString($seatString) {
    $rowString = substr($seatString,0,7);
    $colString = substr($seatString,7,3);
    $col = decodeCol($colString);
    $row = decodeRow($rowString);
    return getSeatID($row, $col);
}

$validCount = 0;
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
$highestID = 0;
if ($fp) {
    $array = explode("\n", fread($fp, filesize($filename)));
    foreach ($array as $seatString) {
        $seatID = parseSeatString($seatString);
        if ($seatID > $highestID) {
            $highestID = $seatID;
        }
    }
}

echo "Highest Seat ID is " . $highestID . "\n";


// echo "Examples: \n";
// echo getSeatID(70, 7) . " S/B 567\n";
// echo getSeatID(14, 7) . " S/B 119\n";
// echo getSeatID(102, 4) . " S/B 820\n";
// echo decodeCol('RRR') . " S/B 7\n";
// echo decodeCol('LLL') . " S/B 0\n";
// echo decodeCol('RLL') . " S/B 4\n";
// echo decodeRow('FBFBBFF') .  " S/B 44\n";
// echo decodeRow('BFFFBBF') . " S/B 70\n";
// echo decodeRow('FFFBBBF') . " S/B 14\n";
// echo decodeRow('BBFFBBF') . " S/B 102\n";
// echo parseSeatString('BFFFBBFRRR') . " S/B 567\n";
// echo parseSeatString('FFFBBBFRRR') . " S/B 119\n";
// echo parseSeatString('BBFFBBFRLL') . " S/B 820\n";


