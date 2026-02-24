<?php

class No {
    public $valor;
    public $proximo;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->proximo = null;
    }
}

function contarNos($no) {
    if ($no === null) {
        return 0;
    }

    return 1 + contarNos($no->proximo);
}

$no1 = new No(10);
$no2 = new No(20);
$no3 = new No(30);
$no4 = new No(40);

$no1->proximo = $no2;
$no2->proximo = $no3;
$no3->proximo = $no4;
echo "Quantidade de nós: " . contarNos($no1);

?>