<?php

include 'src/advenced_en_decode.php';

if (!isset($argv[1])) {
    echo "KO\n";
} elseif (!isset($argv[2])) {
    echo "KO\n";
} elseif (!isset($argv[3])) {
    echo "KO\n";
} else {

    switch ($argv[1]) {
        case "encode":
            if (encode_advanced_rle($argv[2], $argv[3])) echo "KO\n";
            else echo "OK\n";
            break;
        case "decode":
            if (decode_advanced_rle($argv[2], $argv[3])) echo "KO\n";
            else echo "OK\n";
            break;
        default:
            echo "KO\n";
    }

}
?>