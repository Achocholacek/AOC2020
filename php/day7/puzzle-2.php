<?php
$validCount = 0;
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
$allBags = [];

$bagCount = 0;
$contains = [];
if ($fp) {

   $array = explode("\n", fread($fp, filesize($filename)));

   foreach ($array as $bagLine) {
        $bagInfo = explode(" contain ", $bagLine);
        $bagArray = [];
        $bagName = rtrim($bagInfo[0], "s");
        $bagHolds = explode(", ", $bagInfo[1]);
        foreach ($bagHolds as $bh) {
            $len = strlen($bh);
            $bagHold = substr($bh,2,$len);
            $bagHold = str_replace("\n\r", "", $bagHold);
            $bagHold = str_replace("\r\n", "", $bagHold);
            $bagHold = str_replace("\r", "", $bagHold);
            $bagHold = str_replace("\n", "", $bagHold);
            $bagHold = str_replace(".", "", $bagHold);
            $bagHold = rtrim($bagHold, "s");
        if ($bagHold == " other bag") {
                $bagHold = "no other bag";
            }
            else {
                $tempArray['name'] = $bagHold;
                $tempArray['qty'] = intval(substr($bh,0,2));
                array_push($bagArray, $tempArray);
            }

            
        }
        if (count($bagArray) > 0) {
            $allBags[$bagName] = $bagArray;
        }
        
    }

    function getChildBags($bagName) {
        global $allBags;
        $children = [];
        if ($bagName != 'no other bag') {
            if (isset($allBags[$bagName])) {
                $bagData = $allBags[$bagName];
                foreach ($bagData as $bag) {
                    $qty = $bag['qty'];
                    $i = 1;
                    while ($i <= $qty) {
                        $searchArray = [];
                        $bagLooper = getChildBags($bag['name']);
                        $searchArray[$bag['name']] = $bagLooper;
                        array_push($children, $searchArray);
                        $i++;
                    }
                }
            }
        }
        return $children;
    }


    function countChildren($array) {
       $count = count($array);
        if ($count >= 1) {
            foreach ($array as $k => $v) {
                $count += countChildren($v);
            }
        }
        return $count;
    }

    $bagFinal = getChildBags('shiny gold bag');
    $finalCount = countChildren($bagFinal) / 2;
    // I have no idea why this happens but the recursive count function ends up returning exactly twice as many as it should
    echo "Each Gold Bag Has " . $finalCount . " bags inside it.\n"; // 6006   
}