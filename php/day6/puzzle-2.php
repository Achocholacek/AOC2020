<?php
$yesCount = 0;
$filename = 'input.txt';
$fp = @fopen($filename, 'r');

function parseGroup($groupData) {
    $yesCount = 0;
    $pplCount = count($groupData);
    $peopleAnswers = [];
    foreach ($groupData as $data) {
        $tempArray = str_split($data);
        sort($tempArray);
        $questions = [];
        foreach ($tempArray as $question) {
            if (!in_array($question, $questions)) {
                array_push($questions, $question);
            }
        }
        sort($questions);
        array_push($peopleAnswers, $questions);
    }
    
    foreach ($peopleAnswers[0] as $k => $v) {
        $loop = 1;
       if ($pplCount == 1) {
           $yesCount++;
       }
       else {
            $allAnswered = true;
            while ($loop < $pplCount) {
                if (!in_array($v, $peopleAnswers[$loop])) {
                    $allAnswered = false;
                }
                $loop++;
            }
            if ($allAnswered) {
                $yesCount++;
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





