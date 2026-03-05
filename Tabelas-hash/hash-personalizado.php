<?php

define("TAMANHO", 100);
define("N", 500);

function hashString($str, $tamanho = 100) {
    $hash = 0;
    $p = 31;

    for ($i = 0; $i < strlen($str); $i++) {
        $hash = ($hash * $p + ord($str[$i])) % $tamanho;
    }

    return $hash;
}

// Gerar dados
$dados = [];
for ($i = 0; $i < N; $i++) {
    $dados[] = "palavra" . $i;
}

$indices = array_fill(0, TAMANHO, 0);

// Distribuição
foreach ($dados as $d) {
    $indice = hashString($d);
    $indices[$indice]++;
}

// Contar colisões
$colisoes = 0;
foreach ($indices as $qtd) {
    if ($qtd > 1) {
        $colisoes += ($qtd - 1);
    }
}

// Exibir resultado
echo "Total de elementos: " . N . "\n";
echo "Tamanho tabela: " . TAMANHO . "\n";
echo "Colisões: $colisoes\n";
echo "Proporção de colisões: " . ($colisoes / N) . "\n";

?>