<?php

function clb($string) {
            $string = str_replace("\n\r", "", $string);
            $string = str_replace("\r\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\n", "", $string);
            return $string;
}

function f2a($filename) {
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\r\n", fread($fp, filesize($filename)));
       return $array;
    }
    else return false;
}


function runSeating($array, $justAdjacent = true) {
    $y = 0;
    $newSeats = [];
    foreach ($array as $seatRow) {
        $x = 0;
        $rowLen = strlen($seatRow);
        $newSeats[$y] = [];
        while ($x < $rowLen) {
            array_push($newSeats[$y], getNextSeatStatus($x, $y, $array, $justAdjacent));
            $x++;
        }
        $newSeats[$y] = implode($newSeats[$y]);
        $y++;
    }
    return $newSeats;
}

function getNextSeatStatus($x, $y, $array, $justAdjacent) {
    global $maxSeats;
    $adjInfo = getAdjacentInfo($x, $y, $array, $justAdjacent);
    $seat = substr($array[$y], $x, 1);
    switch ($seat) {
        case "L":
            if ($adjInfo == 0) return "#";
            else return "L";
        break;
        case "#":
            if ($adjInfo >= $maxSeats) return "L";
            else return "#";
        break;
        case ".":
        default: 
        return ".";
        break;
    }
}

function getAdjacentInfo($x, $y, $array, $justAdjacent) {
    $occupiedSeats = 0;
    $vars = [[-1, -1], [0, -1], [1, -1],
             [-1,  0],          [1,  0], 
             [-1,  1], [0,  1], [1,  1]];
    foreach($vars as $xy) {
        $run = 1;
        $foundSeat = false; 
        while (!$foundSeat) {
            $newX = $x + ($run * $xy[0]);
            $newY = $y + ($run * $xy[1]);
            if ($newX >= 0 && $newY >= 0) {
                $seat = substr($array[$newY], $newX, 1);
                if ($seat != ".") {
                    $foundSeat = true;
                    if ($seat == "#") $occupiedSeats++;
                    else $seat = "L";
                }
            }
            else $foundSeat = true;
            if ($justAdjacent) $foundSeat = true;
            else $run++;
        }
    }
    return $occupiedSeats;
}