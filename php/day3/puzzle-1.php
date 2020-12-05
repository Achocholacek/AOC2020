<?php

function checkColl($x, $line) {
    $spot = substr($line, $x-1, 1);
    if ($spot == "#") {
        return 1;
    }
    else {
        return 0; 
    }
}
$validCount = 0;
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
$slopeX = 1;
$slopeY = 2;
$curX = 1;
$curY = 0;
$collisions = 0;
$handle = fopen("input.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if ($curY > 0) {
            $collisions += checkColl($curX, $line);
         }
         $curY += $slopeY;
         $curX += $slopeX;
    }
    fclose($handle);
} 
echo "There are " . $collisions . " collisions on this slope.\n";