<?php
$yesCount = 0;
$filename = 'input.txt';
$fp = @fopen($filename, 'r');

function parseGroup($groupData) {
    $yesCount = 0;
    $yeses = [];
    foreach ($groupData as $data) {
        $tempArray = str_split($data);
        sort($tempArray);
        foreach ($tempArray as $answer) {
            if (!in_array($answer, $yeses)) {
                $yesCount++;
                array_push($yeses, $answer);
            }
        }
    }
    return $yesCount;
}

if ($fp) {
    $array = explode("\n", fread($fp, filesize($filename)));
    $idx = 0;
    $arrLen = count($array);
    $groupArray = [];
    while ($idx < $arrLen) {
        $line = str_replace("\n", "", $array[$idx]);
        $line = str_replace("\r", "", $line);
        if($line === "") {
            $yesCount += parseGroup($groupArray);
            $groupArray = [];
        }
        else {
            array_push($groupArray, $line);
        }
        $idx++;
    }
    $yesCount += parseGroup($groupArray);
    $groupArray = [];
    
}

echo "Yes Count is " . $yesCount . "\n";





