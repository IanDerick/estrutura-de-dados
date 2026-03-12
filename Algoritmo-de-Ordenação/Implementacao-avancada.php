<?php

function mergeSort($array) {
    if (count($array) <= 1) {
        return $array;
    }

    $meio = intdiv(count($array), 2);

    $esquerda = mergeSort(array_slice($array, 0, $meio));
    $direita = mergeSort(array_slice($array, $meio));

    return merge($esquerda, $direita);
}

function merge($esquerda, $direita) {
    $resultado = [];

    while (count($esquerda) > 0 && count($direita) > 0) {
        if ($esquerda[0] <= $direita[0]) {
            $resultado[] = array_shift($esquerda);
        } else {
            $resultado[] = array_shift($direita);
        }
    }

    return array_merge($resultado, $esquerda, $direita);
}

function quickSort($array) {
    if (count($array) <= 1) {
        return $array;
    }

    $pivot = $array[0];
    $esq = [];
    $dir = [];

    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] <= $pivot) {
            $esq[] = $array[$i];
        } else {
            $dir[] = $array[$i];
        }
    }

    return array_merge(quickSort($esq), [$pivot], quickSort($dir));
}

function medianaDeTres($array) {
    $inicio = $array[0];
    $fim = $array[count($array)-1];
    $meio = $array[intdiv(count($array),2)];

    $valores = [$inicio, $meio, $fim];
    sort($valores);

    return $valores[1];
}

function quickSortMediana($array) {

    if (count($array) <= 1) {
        return $array;
    }

    $pivot = medianaDeTres($array);

    $esq = [];
    $dir = [];
    $igual = [];

    foreach ($array as $valor) {
        if ($valor < $pivot) {
            $esq[] = $valor;
        } elseif ($valor > $pivot) {
            $dir[] = $valor;
        } else {
            $igual[] = $valor;
        }
    }

    return array_merge(
        quickSortMediana($esq),
        $igual,
        quickSortMediana($dir)
    );
}


$lista = [];

for ($i = 0; $i < 50; $i++) {
    $lista[] = rand(1, 1000);
}

echo "Lista original:\n";
print_r($lista);

$inicio = microtime(true);
$mergeOrdenado = mergeSort($lista);
$fim = microtime(true);

$tempoMerge = $fim - $inicio;

$inicio = microtime(true);
$quickOrdenado = quickSort($lista);
$fim = microtime(true);

$tempoQuick = $fim - $inicio;


$inicio = microtime(true);
$quickMedianaOrdenado = quickSortMediana($lista);
$fim = microtime(true);

$tempoQuickMediana = $fim - $inicio;

echo "\nTempo Merge Sort: $tempoMerge segundos\n";
echo "Tempo Quick Sort: $tempoQuick segundos\n";
echo "Tempo Quick Sort (Mediana de 3): $tempoQuickMediana segundos\n";

?>