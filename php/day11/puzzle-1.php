<?php
require_once('functions.php');
$array = f2a('input.txt');
$run = 1;
$stable = false;
$maxSeats = 4;
while (!$stable) {
    $oldArray = implode("", $array);
    $array = runSeating($array, true);
    $newArray = implode("", $array);
    if ($oldArray == $newArray) {
        $occSeats = substr_count($oldArray, "#");
        echo "We're Stable and there are " . $occSeats . " occupied seats."; // 2222
        $stable = true;
    }
    $run++;
}