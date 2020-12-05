<?php

// This cropped the last line and I am too lazy to figure out why so I just put it back in manually

$myfile = fopen("inputclean.txt", "w") or die("Unable to open file!");

$handle = fopen("input.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if ($line == PHP_EOL) {
            echo "break!\n";
            $passText .= "\n";
            fwrite($myfile, $passText);
            $passText = "";        }
        else {
                $line = str_replace("\n", "", $line);
                $line = str_replace("\r", "", $line);
            $passText .= " " . $line;
        }
    }
}