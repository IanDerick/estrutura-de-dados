<?php

function selectionSort($array) {
    $n = count($array);
    $comparacoes = 0;
    $trocas = 0;

    for ($i = 0; $i < $n - 1; $i++) {
        $min = $i;

        for ($j = $i + 1; $j < $n; $j++) {
            $comparacoes++;

            if ($array[$j] < $array[$min]) {
                $min = $j;
            }
        }

        if ($min != $i) {
            $temp = $array[$i];
            $array[$i] = $array[$min];
            $array[$min] = $temp;
            $trocas++;
        }
    }

    return [$array, $comparacoes, $trocas];
}

$numeros = [64, 25, 12, 22, 11, 90, 45, 33, 10, 5];

list($ordenado, $comparacoes, $trocas) = selectionSort($numeros);

echo "Lista ordenada: ";
print_r($ordenado);

echo "Comparações: $comparacoes\n";
echo "Trocas: $trocas\n";
?>