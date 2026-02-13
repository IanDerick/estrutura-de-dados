<?php

class Pilha {
    private $itens = [];
    private $tamanhoMaximo;

    public function __construct($tamanhoMaximo) {
        $this->tamanhoMaximo = $tamanhoMaximo;
    }

    // Verifica se está vazia
    public function isEmpty() {
        return empty($this->itens);
    }

    // Verifica se está cheia
    public function isFull() {
        return count($this->itens) == $this->tamanhoMaximo;
    }

    // Empilhar (push)
    public function push($valor) {
        if ($this->isFull()) {
            return "Pilha cheia!";
        }
        array_push($this->itens, $valor);
        return "Elemento '$valor' inserido.";
    }

    // Desempilhar (pop)
    public function pop() {
        if ($this->isEmpty()) {
            return "Pilha vazia!";
        }
        return array_pop($this->itens);
    }

    // Visualizar topo
    public function top() {
        if ($this->isEmpty()) {
            return null;
        }
        return end($this->itens);
    }
}

function verificarParenteses($expressao) {
    $pilha = new Pilha(strlen($expressao));

    for ($i = 0; $i < strlen($expressao); $i++) {
        $char = $expressao[$i];

        if ($char == "(") {
            $pilha->push($char);
        }

        if ($char == ")") {
            if ($pilha->isEmpty()) {
                return "Expressão NÃO balanceada.";
            }
            $pilha->pop();
        }
    }

    if ($pilha->isEmpty()) {
        return "Expressão ($expressao) balanceada.";
    } else {
        return "Expressão ($expressao) NÃO balanceada.";
    }
}

$expressao1 = "((1+2) * (3/4))";
$expressao2 = "((1+2) * (3/4)";

echo verificarParenteses($expressao1);
echo "\n";
echo verificarParenteses($expressao2);

?>
