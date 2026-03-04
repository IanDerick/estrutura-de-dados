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

function removerNumero(&$vetor, $posicao) {
    if (isset($vetor[$posicao])) {
        unset($vetor[$posicao]);
        $vetor = array_values($vetor);
        return "Elemento removido com sucesso.";
    } else {
        return "Elemento não encontrado.";
    }
}

$numero = 1; 
echo buscarNumero($numeros, $numero);
echo removerNumero($numeros, 3);
print_r($numeros);
?>