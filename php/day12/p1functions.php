<?php

function clb($string) {
            $string = str_replace("\n\r", "", $string);
            $string = str_replace("\r\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\n", "", $string);
            return $string;
}

function f2a($filename) {
    $fp = @fopen($filename, 'r');
    if ($fp) {
       $array = explode("\r\n", fread($fp, filesize($filename)));
       return $array;
    }
    else echo "wat";
}

function getVelocity($heading) {
    global $shipDir;
    $vel = [];
    $vel['x'] = 0;
    $vel['y'] = 0;
    if ($heading == "F") $heading = $shipDir;
    if ($heading == "N") {
        $vel['x'] = 0;
        $vel['y'] = 1;
    }
    else if ($heading == "S") {
        $vel['x'] = 0;
        $vel['y'] = -1;
    }
    if ($heading == "E") {
        $vel['x'] = 1;
        $vel['y'] = 0;
    }
    if ($heading == "W") {
        $vel['x'] = -1;
        $vel['y'] = 0;
    }
    return $vel;
}

function generateDirArray($startDir) {
    $dirs = ['N', 'E', 'S', 'W'];
    if ($startDir == "N") {
        $dirArray = ['E', 'S', 'W'];
    }
    if ($startDir == "E") {
        $dirArray = ['S', 'W', 'N'];
    }
    if ($startDir == "S") {
        $dirArray = ['W', 'N', 'E'];
    }
    if ($startDir == "W") {
        $dirArray = ['N', 'E', 'S'];
    }
    return $dirArray;
}

function getDirection($entry) {
    global $shipDir;
    $dirs =  generateDirArray($shipDir);
    if (substr($entry, 0, 1) == "L") {
        $inc = intval(substr($entry,1,strlen($entry))) / 90;
        $idx = 3 - $inc;
        $newDir = $dirs[$idx];
    }
    else if (substr($entry, 0, 1) == "R") {
        $inc = intval(substr($entry,1,strlen($entry))) / 90;
        $idx =  $inc - 1;
        $newDir = $dirs[$idx];
    }
    return $newDir;
}

function getHeading($entry) {
    global $shipDir;
    $directions = ['N', 'S', 'E', 'W'];
    $turns = ['L', 'R'];
    $heading = substr($entry, 0,1);
    $distance = substr($entry, 1, strlen($entry));
    $data['dir'] = "";
    $data['vel'] = "";
    $data['dis'] = $distance;
    if (in_array($heading, $directions)) {
        $velocity = getVelocity($heading);
        $data['dir'] = $shipDir;
        $data['vel'] = $velocity;
    }
    else if (in_array($heading, $turns)) {
        $shipDir = getDirection($entry);
        $data['dir'] = $shipDir;
        $data['vel'] = 0;
    }
    else {
        $velocity = getVelocity($heading);
        $data['dir'] = $shipDir;
        $data['vel'] = $velocity;
    }
    return $data;
}