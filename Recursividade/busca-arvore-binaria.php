<?php

class No {
    public $valor;
    public $esquerda;
    public $direita;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->esquerda = null;
        $this->direita = null;
    }
}

function buscar($raiz, $valor) {
    if ($raiz === null) {
        return false;
    }

    if ($raiz->valor == $valor) {
        return true;
    }

    if ($valor < $raiz->valor) {
        return buscar($raiz->esquerda, $valor);
    }

    return buscar($raiz->direita, $valor);
}

$raiz = new No(10);
$raiz->esquerda = new No(5);
$raiz->direita = new No(15);

$valor = 115;

if (buscar($raiz, $valor)) {
    echo "Valor $valor encontrado!";
} else {
    echo "Valor $valor não encontrado!";
}

?>