<?php
require_once('functions.php');
$array = f2a('input.txt');
$eDep = $array[0];
$busesTemp = explode(",", $array[1]);
$buses = array_filter($busesTemp,"notX");
$timeResults = [];
$lowestWait = null;
$answer = null;

foreach ($buses as $bus) {
    $runTotal = 0;
    while ($runTotal <= $eDep) $runTotal += $bus;
    $waitTime = ($runTotal - $eDep);
    $tempAnswer = $waitTime * $bus;
    if ($lowestWait == null || $waitTime < $lowestWait) {
        $lowestWait = $waitTime;
        $answer = $tempAnswer;
    }
}
echo "the answer for part 1 is " . $answer . "\n"; // 2238