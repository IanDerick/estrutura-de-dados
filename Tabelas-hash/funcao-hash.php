<?php

function hashInteiro($chave) {
    $tamanhoTabela = 10;
    return $chave % $tamanhoTabela;
}

function hashString($chave) {
    $tamanhoTabela = 10;
    $soma = 0;

    for ($i = 0; $i < strlen($chave); $i++) {
        $soma += ord($chave[$i]);
    }

    return $soma % $tamanhoTabela;
}
echo "Inteiro: \n";
echo hashInteiro(15) . "\n"; 
echo hashInteiro(27) . "\n"; 
echo hashInteiro(103) . "\n";
echo "String: \n";
echo hashString("ANA") . "\n";
echo hashString("Carlos") . "\n";
echo hashString("PHP") . "\n";