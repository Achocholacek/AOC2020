<?php

function validateField($field, $value, $lineNum) {
    $value = trim(preg_replace('/\s\s+/', '', $value));
    switch($field) {
        case 'byr':
            $value = intval($value);
            if ($value >= 1920 && $value <= 2002) return true;
            else return false;
        break;
        case 'iyr':
            $value = intval($value);
            if ($value >= 2010 && $value <= 2020) return true;
            else return false;
        break;
        case 'eyr':
            $value = intval($value);
            if ($value >= 2020 && $value <= 2030) return true;
            else return false;
        break;
        case 'hgt':
            if (strpos($value, 'cm') !== false) {
                $value = str_replace(' ', '', $value);
                $value = str_replace('cm', '', $value);
                $value = intval($value);
                if ($value >= 150 && $value <= 193) return true;
                else return false;      
            }
            else if (strpos($value, 'in') !== false) {
                $value = str_replace(' ', '', $value);
                $value = str_replace('in', '', $value);
                $value = intval($value);
               
                if ($value >= 59 && $value <= 76) return true;
                else return false;
            }
            else {
                return false;
            }            
        break;
        case 'hcl':
            if (substr($value,0,1) === "#") {
                $cc = substr($value, 1, 6);
                if (preg_match('/([a-fA-F0-9]{6,6})/', $cc)) return true;
                else return false;
            }
            else {
                return false;
            }   
        break;
        case 'ecl':
            $validCol = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
            if (in_array($value, $validCol)) return true;
            else return false;
        break;
        case 'pid':
                if (strlen($value) == 9 && preg_match('/([0-9]{9})/', $value)) return true;
                else return false;            
        break;
        default:
            return false;
        break;
    }
}

function validateData($string, $lineNum) {
    $reqFields =['byr', 'iyr', 'eyr', 'hgt', 'hcl','ecl', 'pid'];
    $usedFields = [];
    $validFields = 0;
    $chunks = explode(" ", $string);
    $rqFieldCt = 7;
    foreach ($chunks as $chunk) {
        $kvPair = explode(":", $chunk);
        if ($kvPair[0] !== "cid") {
            if (in_array($kvPair[0], $reqFields) && !in_array($kvPair[0], $usedFields)) {
                if (validateField($kvPair[0], $kvPair[1], $lineNum)) {
                    array_push($usedFields, $kvPair[0]);                    
                    $validFields++;
                } 
            }
        }  
    }
    if ($validFields >= $rqFieldCt) return true;
    else return false;
}
$validPassports = 0;
$handle = fopen("inputclean.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (validateData($line, $lineNum)) $validPassports++;
    }
    echo "There are " . $validPassports . " valid passports\n";
}

// Examples
//  echo "!" . validateData("eyr:1972 cid:100 hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926", 0) .  "! should be 0\n";
//  echo "!" . validateData("iyr:2019 hcl:#602927 eyr:1967 hgt:170cm ecl:grn pid:012533040 byr:1946", 0) .  "! should be 0\n";
//  echo "!" . validateData("hcl:dab227 iyr:2012 ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277", 0) .  "! should be 0\n";
//  echo "!" . validateData("hgt:59cm ecl:zzz eyr:2038 hcl:74454a iyr:2023 pid:3556412378 byr:2007", 0) .  "! should be 0\n";

//  echo "!" . validateData("pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980 hcl:#623a2f", 0) .  "! should be 1\n";
//  echo "!" . validateData("eyr:2029 ecl:blu cid:129 byr:1989 iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm", 0) .  "! should be 1\n";
//  echo "!" . validateData("hcl:#888785 hgt:164cm byr:2001 iyr:2015 cid:88 pid:545766238 ecl:hzl eyr:2022", 0) .  "! should be 1\n";
//  echo "!" . validateData("iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719", 0) .  "! should be 1\n";