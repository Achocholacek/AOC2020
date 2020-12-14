<?php
require_once('p1functions.php');
$array = f2a('input.txt');
$addresses = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$currentMask = "";

foreach ($array as $line) {
    $line = explode(" ", $line);
    if ($line[0] == "mask") {
        // This is a mask line
        $currentMask = $line[2];
    }
    else {
        // This is an instruction line.
        $result = parseInstruction($line[0], $line[2], $currentMask);

    }
}
$answerVal = 0;
foreach ($addresses as $add => $value) {

        $answerVal += $value;
}
echo "The answer is " . $answerVal ."\n"; // 9879607673316