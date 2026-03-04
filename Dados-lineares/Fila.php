<?php

class Fila {
    private $itens = [];

    public function enqueue($valor) {
        array_push($this->itens, $valor);
        return "Cliente $valor entrou na fila.";
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            return "Fila vazia.";
        }
        return array_shift($this->itens);
    }

    public function isEmpty() {
        return empty($this->itens);
    }

    public function exibir() {
        echo "Fila: ";
        foreach ($this->itens as $item) {
            echo $item . " <- ";
        }
        echo "Fim";
    }
}
class FilaCircular {
    private $fila;
    private $inicio = 0;
    private $fim = 0;
    private $tamanho = 0;
    private $capacidade;

    public function __construct($capacidade) {
        $this->capacidade = $capacidade;
        $this->fila = array_fill(0, $capacidade, null);
    }

    public function isEmpty() {
        return $this->tamanho == 0;
    }

    public function isFull() {
        return $this->tamanho == $this->capacidade;
    }

    public function enqueue($valor) {
        if ($this->isFull()) {
            return "Fila cheia!";
        }

        $this->fila[$this->fim] = $valor;
        $this->fim = ($this->fim + 1) % $this->capacidade;
        $this->tamanho++;

        return "Elemento $valor inserido.";
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            return "Fila vazia!";
        }

        $valor = $this->fila[$this->inicio];
        $this->inicio = ($this->inicio + 1) % $this->capacidade;
        $this->tamanho--;

        return $valor;
    }
}
echo "Simulação Banco";
echo "\n";

$filaBanco = new Fila();

$filaBanco->enqueue("João");
$filaBanco->enqueue("Maria");
$filaBanco->enqueue("Carlos");
$filaBanco->enqueue("Ana");

$filaBanco->exibir();
echo "\n";

while (!$filaBanco->isEmpty()) {
    $cliente = $filaBanco->dequeue();
    echo "Atendendo cliente: $cliente";
    echo "\n";
}

echo "Todos os clientes foram atendidos.";
?>