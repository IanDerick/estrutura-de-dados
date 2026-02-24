<?php

function torreDeHanoi($qtd_disco, $origem, $destino, $auxiliar) {
    if ($qtd_disco == 1) {
        echo "Mover disco 1 de $origem para $destino\n";
        return 1;
    }

    $movimentos = torreDeHanoi($qtd_disco - 1, $origem, $auxiliar, $destino);

    echo "Mover disco $qtd_disco de $origem para $destino\n";
    $movimentos++;
    
    $movimentos += torreDeHanoi($qtd_disco - 1, $auxiliar, $destino, $origem);

    return $movimentos;
}

//quantidade de discos
$qtd_disco = 6;
$totalMovimentos = torreDeHanoi($qtd_disco, 'A', 'C', 'B');

echo "\nTotal de movimentos: $totalMovimentos\n";

?>