<?php
require_once('p1functions.php');
$array = f2a('input.txt');
$arrLen = count($array);
$shipDir = "E";
$shipX = 0;
$shipY = 0;
foreach ($array as $heading) {
    $dataSet = getHeading($heading);
    if (isset($dataSet['dis'])) {
        $shipX += $dataSet['dis'] * $dataSet["vel"]["x"];
        $shipY += $dataSet['dis'] * $dataSet["vel"]["y"];
    }
}
$manDis = abs($shipX) + abs($shipY);
echo "The Answer is X(" . abs($shipX) . ") x Y(" . abs($shipY) . ") -- " . $manDis . "\n"; // 998