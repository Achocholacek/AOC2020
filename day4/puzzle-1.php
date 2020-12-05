<?php

function validateField($field, $value) {
    switch($field) {
        case 'byr':
            if (is_int($field) && $field >= 1920 && $field <= 2002) return true;
            else return false;
        break;
        case 'iyr':
            if (is_int($field) && $field >= 2010 && $field <= 2020) return true;
            else return false;
        break;
        case 'eyr':
            if (is_int($field) && $field >= 2020 && $field <= 2030) return true;
            else return false;
        break;
        case 'hgt':
            if (strpos($field, 'cm') !== false) {

            }
            if (strpos($field, 'in') !== false) {
                
            }
            else {
                return false;
            }    
        break;
    }
}

function validateData($string) {
    $reqFields =['byr', 'iyr', 'eyr', 'hgt', 'hcl','ecl', 'pid', 'cid'];
    $validFields = 0;
    $chunks = explode(" ", $string);
    $rqFieldCt = 7;
    foreach ($chunks as $chunk) {
        $kvPair = explode(":", $chunk);
            if (in_array($kvPair[0], $reqFields)) {
                $validFields++;
            }
            if ($kvPair[0] == 'cid') {
                $rqFieldCt = 8;
            }
        
    }
    if ($validFields >= $rqFieldCt) {
        return true;
    }
    else {
        return false;
    }
}


$validCount = 0;
$filename = 'input.txt';
$lineNum = 1;
$validPassports = 0;
$handle = fopen("inputclean.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (validateData($line)) {
            $validPassports++;
        }
        $lineNum++;
    }
}

echo "There are " . $validPassports . " valid passports in this file.\n";
// Examples

// echo validateData("ecl:gry pid:860033327 eyr:2020 hcl:#fffffd byr:1937 iyr:2017 cid:147 hgt:183cm") .  " should be 1\n";
// echo validateData("iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884 hcl:#cfa07d byr:1929") .  " should be 0\n";
// echo validateData("hcl:#ae17e1 iyr:2013 eyr:2024 ecl:brn pid:760753108 byr:1931 hgt:179cm") .  " should be 1\n";
// echo validateData("hcl:#cfa07d eyr:2025 pid:166559648 iyr:2011 ecl:brn hgt:59in") .  " should be 0\n";
// 
// 
// 