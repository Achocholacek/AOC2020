<?php
require_once('p2functions.php');
$array = f2a('input.txt');
$addresses = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$currentMask = "";
$tempArray = [];
foreach ($array as $line) {
    $line = explode(" ", $line);
    if ($line[0] == "mask") {
        $currentMask = $line[2];
    }
    else {
        parseInstruction($line[0], $line[2], $currentMask);
    }
}
$answerVal = 0;
foreach ($addresses as $add => $value) {
        $answerVal += $value;
}
echo "The answer is " . $answerVal . "\n"; // 3435342392262