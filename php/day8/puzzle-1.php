<?php
require_once('functions.php');
$filename = 'input.txt';
    $fp = @fopen($filename, 'r');
    if ($fp) {
        $array = explode("\n", fread($fp, filesize($filename)));
        $arrLen = count($array);
        $executedInstructions = [];
        $idx = 0;
        while ($idx < $arrLen) {
            $array[$idx] = clb($array[$idx]);
            $idx++;
        }
        $ptr = 0;
        $acc = 0;
        $looping = false;
        while (!$looping) {
            $cmd = explode(" ", $array[$ptr]);
            $val = $cmd[1];
            $cmd = $cmd[0];
            if (in_array($ptr, $executedInstructions)) {
                $looping = true;
            }
            if (!$looping) {
                switch($cmd) {
                    case 'jmp':
                        array_push($executedInstructions, $ptr);
                        $ptr += intval($val);
                    break;
                    case 'acc':
                        $acc += intval($val);               
                    case 'nop':
                    default:
                        array_push($executedInstructions, $ptr); 
                        $ptr++;
                    break;
                }
            }
       }
       echo "The accumulator val prior to looped instructions is " . $acc ."\n"; // 1331
}

