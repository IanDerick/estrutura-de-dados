<?php

class MaxHeap {
    private $heap = [];

    public function inserir($valor) {
        $this->heap[] = $valor;
        $this->heapifyUp(count($this->heap) - 1);
    }

    private function heapifyUp($indice) {
        while ($indice > 0) {
            $pai = intval(($indice - 1) / 2);

            if ($this->heap[$indice] > $this->heap[$pai]) {
                $this->trocar($indice, $pai);
                $indice = $pai;
            } else {
                break;
            }
        }
    }

    public function extrairMax() {
        if ($this->estaVazio()) {
            return null;
        }

        $max = $this->heap[0];
        $ultimo = array_pop($this->heap);

        if (!empty($this->heap)) {
            $this->heap[0] = $ultimo;
            $this->heapifyDown(0);
        }

        return $max;
    }

    private function heapifyDown($indice) {
        $tamanho = count($this->heap);

        while (true) {
            $maior = $indice;
            $esq = 2 * $indice + 1;
            $dir = 2 * $indice + 2;

            if ($esq < $tamanho && $this->heap[$esq] > $this->heap[$maior]) {
                $maior = $esq;
            }

            if ($dir < $tamanho && $this->heap[$dir] > $this->heap[$maior]) {
                $maior = $dir;
            }

            if ($maior != $indice) {
                $this->trocar($indice, $maior);
                $indice = $maior;
            } else {
                break;
            }
        }
    }

    private function trocar($i, $j) {
        $temp = $this->heap[$i];
        $this->heap[$i] = $this->heap[$j];
        $this->heap[$j] = $temp;
    }

    public function estaVazio() {
        return empty($this->heap);
    }

    public function imprimir() {
        print_r($this->heap);
    }
}

class FilaPrioridade {
    private $heap;

    public function __construct() {
        $this->heap = new MaxHeap();
    }

    public function inserir($valor) {
        $this->heap->inserir($valor);
    }

    public function removerMaior() {
        return $this->heap->extrairMax();
    }
}

$fila = new FilaPrioridade();

$fila->inserir(10);
$fila->inserir(40);
$fila->inserir(20);
$fila->inserir(5);
$fila->inserir(60);
$fila->inserir(100);
$fila->inserir(1);

echo "Removendo elementos por prioridade:\n";

while (true) {
    $maior = $fila->removerMaior();
    if ($maior === null) break;
    echo $maior . "\n";
}

?>