<?php
require_once('p2functions.php');
$array = f2a('input.txt');
$arrLen = count($array);
$shipDir = "E";
$wayX = 10;
$wayY = 1;
$shipX = 0;
$shipY = 0;
foreach ($array as $heading) {
    $dataSet = getHeading($heading);
    if ($dataSet['moveBoat']) {
            $shipX += ($dataSet["vel"]["x"]);
            $shipY += ($dataSet["vel"]["y"]);
        }
}
$manDis = abs($shipX) + abs($shipY);
echo "The Answer is X(" . abs($shipX) . ") x Y(" . abs($shipY) . ") -- " . $manDis . "\n"; // 71586