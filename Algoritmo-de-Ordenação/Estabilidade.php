<?php

function heapify(&$arr, $n, $i) {
    $maior = $i;
    $esq = 2 * $i + 1;
    $dir = 2 * $i + 2;

    if ($esq < $n && comparar($arr[$esq], $arr[$maior]) > 0) {
        $maior = $esq;
    }

    if ($dir < $n && comparar($arr[$dir], $arr[$maior]) > 0) {
        $maior = $dir;
    }

    if ($maior != $i) {
        $temp = $arr[$i];
        $arr[$i] = $arr[$maior];
        $arr[$maior] = $temp;

        heapify($arr, $n, $maior);
    }
}

function comparar($a, $b) {

    if ($a['valor'] == $b['valor']) {
        return $b['indice'] - $a['indice'];
    }

    return $a['valor'] - $b['valor'];
}

function heapSortEstavel($array) {

    $arr = [];

    foreach ($array as $i => $valor) {
        $arr[] = ['valor' => $valor, 'indice' => $i];
    }

    $n = count($arr);

    for ($i = intdiv($n,2)-1; $i >= 0; $i--) {
        heapify($arr, $n, $i);
    }

    for ($i = $n-1; $i >= 0; $i--) {
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;

        heapify($arr, $i, 0);
    }

    $resultado = [];
    foreach ($arr as $item) {
        $resultado[] = $item['valor'];
    }

    return $resultado;
}

$lista = [5,3,5,2,8,3];

print_r(heapSortEstavel($lista));

?>