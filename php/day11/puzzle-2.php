<?php
require_once('functions.php');
$array = f2a('input.txt');
$run = 1;
$stable = false;
$maxSeats = 5;
while (!$stable) {
    $oldArray = implode("", $array);
    $array = runSeating($array, false);
    $newArray = implode("", $array);
    if ($oldArray == $newArray) {
        $occSeats = substr_count($oldArray, "#");
        echo "We're Stable and there are " . $occSeats . " occupied seats."; // 2032
        $stable = true;
    }
    $run++;
}