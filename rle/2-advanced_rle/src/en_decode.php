<?php

if ($argv[1] == "encode") encode_rle($argv[2]);
if ($argv[1] == "decode") decode_rle($argv[2]);

function encode_rle(string $str) { // 20 lignes 
    if (!ctype_alpha($str)) return "$$$";
    $i = 0;
    $len = strlen($str);
    $new_str = "";

    while ($i < $len) {
        $lettre = $str[$i];
        $count = 1;
        $j = $i + 1;
        while ($j < $len) {
            if ($lettre != $str[$j]) break;
            $j++;
            $count++;
        }
        if ($count != 1) $new_str = "$new_str$count$lettre";
        else $new_str = "$new_str$lettre";
        $i = $j;
    }
    echo $new_str;
    return $new_str;
}

function decode_rle(string $str) { // 21 lignes
    if (!(ctype_alnum($str))) return "$$$";
    $i = 0;
    $len = strlen($str);
    $new_str = "";

    while ($i < $len) {
        $count = 0;
        while (ctype_digit($str[$i])) {
            $count *= 10;
            $count += (int) $str[$i];
            $i++;
        }
        if (!ctype_alpha($str[$i])) return "ERROR";
        $lettre = $str[$i];
        do {
            $new_str = "$new_str$lettre";
        } while (--$count > 0);
        $i++;
    }
    echo $new_str;
    return $new_str;
}

?>