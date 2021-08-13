<?php

function encode_rle(string $str) { // 20 lignes 
    if (!ctype_alpha($str)) {
        if ($str == '') return '';
        return "$$$";
    }
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
        $new_str = "$new_str$count$lettre";
        $i = $j;
    }
    return $new_str;
}


function decode_rle(string $str) { // 22 lignes
    if (!(ctype_alnum($str))) {
        if ($str == '') return '';
        return "$$$";
    }
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
        if (!ctype_alpha($str[$i])) return "$$$";
        $lettre = $str[$i];
        do {
            $new_str = "$new_str$lettre";
            $count--;
        } while ($count > 0);
        $i++;
    }
    return $new_str;
}

?>