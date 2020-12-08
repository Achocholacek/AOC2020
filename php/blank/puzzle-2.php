<?php
require_once('functions.php');
$filename = 'input.txt';
    $fp = @fopen($filename, 'r');
    if ($fp) {


       //$array = explode("\n", fread($fp, filesize($filename)));
       //$arrLen = count($array);
    
}

echo "There are " . $validCount . " valid passwords in this file.\n";