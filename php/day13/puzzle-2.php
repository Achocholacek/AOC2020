<?php
require_once('functions.php');
$array = f2a('input.txt');
$buses = explode(",", $array[1]);
$offsets = [];
$busList = [];
$firstBus = null;
$busRuns = [];
$timeStamp = 0;

foreach ($buses as $bus) {
    if ($firstBus == null) {
        $firstBus = $bus;
    }
    if ($bus != "x") {
            if ($bus != $firstBus) {
                array_push($busList, $bus);
            }
            $offsets[$bus] = $timeStamp; 
            $busRuns[$bus] = [];
    }
   $timeStamp++;
}
$startTs = $inc = $firstBus;
foreach ($busList as $bus) {
    $res = findDiffs($startTs, $inc, $bus);
    $startTs = $res['ts'];
    $inc = $res['inc'];
}
echo "the answer for part 2 is " . $startTs . "\n"; // 560214575859998