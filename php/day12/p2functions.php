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

function rotateWaypoint($direction, $steps) {
    global $wayX, $wayY;
    $newX = 0;
    $newY = 0;
    $runs = 0;
    while ($runs < $steps) {
        if ($direction == "L") {
            if ($wayX > 0) $newY = $wayX;
            else $newY = $wayX;
            if ($wayY > 0) $newX = abs($wayY) * -1;
            else $newX = abs($wayY);
            $wayX = $newX;
            $wayY = $newY;
        }
        else if ($direction == "R") {
            if ($wayX > 0) $newY = -1 * $wayX;
            else $newY = abs($wayX);
            if ($wayY > 0) $newX = $wayY;
            else $newX = abs($wayY) * -1;
            $wayX = $newX;
            $wayY = $newY;
        }
        $runs++;
    }
}

function getHeading($entry) {
    global $shipDir, $wayX, $wayY, $shipX, $shipY;
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
        $data['vel'] = 0;
        $newX =  $velocity['x'] * $distance;
        $newY =  $velocity['y'] * $distance;
        $wayX += $newX;
        $wayY += $newY;
        $data['moveBoat'] = false;
    }
    else if (in_array($heading, $turns)) {
        $inc = intval(substr($entry,1,strlen($entry))) / 90;
        rotateWaypoint($heading, $inc);   
        $data['moveBoat'] = false;
    }
    else {
        $velocity = getVelocity($heading);
        $velocity['x'] = $wayX;
        $velocity['y'] = $wayY;
        $velocity['x'] *= $distance;
        $velocity['y'] *= $distance;
        $data['dir'] = $shipDir;
        $data['vel'] = $velocity;
        $data['moveBoat'] = true;
    }
    return $data;
}