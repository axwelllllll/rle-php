<?php

include 'src/en_decode.php';

if (!isset($argv[1])) echo "$$$\n";
elseif (!isset($argv[2])) echo "$$$\n";
else {

    switch ($argv[1]) {
        case "encode":
            echo encode_rle($argv[2]), "\n";
            break;
        case "decode":
            echo decode_rle($argv[2]), "\n";
            break;
        default:
            echo "$$$\n";
    }

}
?>