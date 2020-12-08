<?php
$validCount = 0;
$filename = 'input.txt';
$targetBagName = "shiny gold bag";
$targetBag = [];
$fp = @fopen($filename, 'r');
$targetBags = [];
$allBags = [];
if ($fp) {

   $array = explode("\n", fread($fp, filesize($filename)));
   foreach ($array as $bagLine) {
       $canHold = canHoldbag($targetBagName, $bagLine);
       if ($canHold !== false) {
           $targetBag[$canHold] = [];
           if (!in_array($canHold, $targetBags)) {
               array_push($targetBags, $canHold);
               $bagResults++;
           }
       }
   }
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
            if ($bagHold == " other bag") $bagHold = "no other bag";
            array_push($bagArray, $bagHold);
        }
        $allBags[$bagName] = $bagArray;
    }
    $bagResults = count($targetBags);
   
    while ($bagResults > 0) { 
        foreach ($targetBags as $tBag) {
            foreach ($allBags as $k => $v) {;
                if (in_array($tBag, $v)) {
                    if (!in_array($k, $targetBags)) {
                        array_push($targetBags, $k);
                        $bagResults++;
                    }
                }
            }
        }
        $bagResults--;
    }   
}
   echo "There are " . count($targetBags) . " bags that can hold at least one " . $targetBagName . "\n";
   

function canHoldBag($targetBagName, $bagLine) {
    $bagInfo = explode(" contain ", $bagLine);
    if (strpos($bagInfo[1], $targetBagName) !== false) {
        $bagInfo[0] = rtrim($bagInfo[0], 's');
        return $bagInfo[0];
    }
    else {
        return false;
    }
}