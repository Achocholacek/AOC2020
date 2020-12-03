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
$collisionResult = [];
$slopeList = [[1,1], [3,1], [5,1], [7,1], [1,2]];
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
   $lineCount = count($array);
}

if (!is_null($array)) {
    foreach ($slopeList as $xY) {
        $curX = 1;
        $curY = 0;
        echo "X: " . $xY[0] . " Y: " . $xY[1] . "\n";
        $slopeX = $xY[0];
        $slopeY = $xY[1];
        $collisions = 0;
        while ($curY <= $lineCount) {
            if ($curY > 0) {
                echo $curY."\n";
                $collisions += checkColl($curX, $array[$curY]);
            }
            $curY += $slopeY;
            $curX += $slopeX;
        }
        array_push($collisionResult, $collisions);
    }
}
$result = $collisionResult[0] * $collisionResult[1] * $collisionResult[2] * $collisionResult[3] * $collisionResult[4];
echo "Your multiplication result is: " . $result . "\n";
