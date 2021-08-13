<?php

    // le code permettant de compresser :

function encode_advanced_rle(string $path_to_encode, string $result_path) {
    if (!file_exists($path_to_encode)) return 1;
    $codemotif = "";
    $hexa = bin2hex(file_get_contents($path_to_encode));
    $taille = strlen($hexa);

        // place un espace tout les deux carractère
    for ($i = 1; $i < $taille; $i += 2)
        $codemotif = $codemotif.$hexa[$i-1].$hexa[$i].' ';

    $taille2 = strlen($codemotif);
    $compress = "";

    if (file_exists("./a_test/pré-compress.txt")) unlink("./a_test/pré-compress.txt");
    file_put_contents("./a_test/pré-compress.txt", $codemotif);

    $i = 2;
    while ($i <= $taille2 - 3) {
        $pack = $codemotif[$i-2].$codemotif[$i-1].' ';
        $pack2 = $codemotif[$i+1].$codemotif[$i+2].' ';
        $count = 0;
        if ($pack == $pack2) {
            $count++;
            do {
                $count++;
                $i += 3;
                if ($i+1 >= $taille2) break;
                $pack = $codemotif[$i-2].$codemotif[$i-1].' ';
                $pack2 = $codemotif[$i+1].$codemotif[$i+2].' ';
            } while ($pack == $pack2);
            $compress .= $count.' '.$pack;
            $i += 3;
            if ($i+1 >= $taille2) break;
            $pack = $codemotif[$i-2].$codemotif[$i-1].' ';
            $pack2 = $codemotif[$i+1].$codemotif[$i+2].' ';
            $count = 0;
        }
        if ($pack != $pack2) {
            $j = $i;
            do {
                $count++;
                $i += 3;
                if ($i + 1 >= $taille2) {
                    $count++;
                    $i += 3;
                    break;
                }
                $pack = $codemotif[$i-2].$codemotif[$i-1].' ';
                $pack2 = $codemotif[$i+1].$codemotif[$i+2].' ';
            } while ($pack != $pack2);
            $compress .= '00 '.$count.' ';
            while ($j < $i) {
                $pack = $codemotif[$j-2].$codemotif[$j-1].' ';
                $compress = $compress.$pack;
                $j += 3;
            }
        }
    }

        // fait la sauvegarde
    if (file_exists($result_path)) unlink($result_path);
    file_put_contents($result_path, $compress);
    return 0;
}

    // le code permettant de décompresser :

function decode_advanced_rle(string $path_to_encode, string $result_path) {
    echo "\n\n____________________decode :_______________\n\n";
    if (!file_exists($path_to_encode)) return 1;
    $pack = explode(' ', file_get_contents($path_to_encode));
    $taille = count($pack);
    $decompress = "";
    $i = 0;

    while ($i < $taille) {
        switch ($pack[$i]) {
            case '00':
                $count = ((int) $pack[++$i]) + $i;
                // echo "\n$i - $count_";
                while (++$i <= $count){
                    // echo hex2bin($pack[$i]);
                    $decompress = $decompress.$pack[$i];}
                break;
            default:
                $count = (int) $pack[$i++];
                $j = 0;
                while ($j++ < $count) 
                    $decompress = $decompress.$pack[$i]; 
                $i++;
        }
    }
    // echo "\n$taille\n";
    $decompress = hex2bin($decompress);
    if (file_exists($result_path)) unlink($result_path);
        file_put_contents($result_path, $decompress);
    
    return 0;
}

// clear && php ./cp-rle.php decode /Users/pro/Documents/pro/RLE/2-advanced_rle/a_test/coucou.txt /Users/pro/Documents/pro/RLE/2-advanced_rle/test.txt
// clear && php ./cp-rle.php encode /Users/pro/Documents/pro/RLE/2-advanced_rle/a_test/laracroft.bmp /Users/pro/Documents/pro/RLE/2-advanced_rle/a_test/coucou.txt

?>