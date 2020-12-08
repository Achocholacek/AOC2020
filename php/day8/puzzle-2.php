<?php
require_once('functions.php');
$filename = 'input.txt';
$fp = @fopen($filename, 'r');
if ($fp) {
    $array = explode("\n", fread($fp, filesize($filename)));
    $arrLen = count($array);
    $idx = 0;
    while ($idx < $arrLen) {
        $array[$idx] = clb($array[$idx]);
        $idx++;
    }
    $jmpNopList = findJmpNop($array);
    foreach ($jmpNopList as $jnl) {
        $tempArray = $array;
        $ptr = 0;
        $acc = 0;
        $cmd = explode(" ", $tempArray[$jnl]);
        $val = $cmd[1];
        $cmd = $cmd[0]; 
        ($cmd == "jmp") ? $cmd = "nop" : $cmd = "jmp";
        $tempArray[$jnl] = $cmd . " " . $val;
        $loop = 0;
        while ($loop <= 625) {
            $cmd = explode(" ", $tempArray[$ptr]);
            $val = $cmd[1];
            $cmd = $cmd[0]; 
            switch($cmd) {
                case 'jmp':
                 $ptr += intval($val);
                break;
                case 'acc':
                 $acc += intval($val);               
                case 'nop':
                 default:
                  $ptr++;
                 break;
            }
            $loop++;
            if ($ptr == $arrLen) {
                echo "successfully finished run with ptr at " . $ptr . "/" . $arrLen . " and acc at " . $acc . "\n"; // 1121
                exit();
            }
        } 
    }
}

