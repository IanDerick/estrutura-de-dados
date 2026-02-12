<?php

$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

function buscarNumero($vetor, $numeroProcurado) {
    foreach ($vetor as $indice => $valor) {
        if ($valor == $numeroProcurado) {
            return "Número encontrado na posição $indice.";
        }
    }
    return "Número NÂO encontrado no vetor.";
}

$numero = 18; 
echo buscarNumero($numeros, $numero);
?>