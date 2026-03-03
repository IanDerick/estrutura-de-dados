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

class ArvoreBinariaBusca {
    private $raiz = null;

    public function inserir($valor) {
        $this->raiz = $this->inserirRec($this->raiz, $valor);
    }

    private function inserirRec($no, $valor) {
        if ($no === null) {
            return new No($valor);
        }

        if ($valor < $no->valor) {
            $no->esquerda = $this->inserirRec($no->esquerda, $valor);
        } else if ($valor > $no->valor) {
            $no->direita = $this->inserirRec($no->direita, $valor);
        }

        return $no;
    }

    public function buscar($valor) {
        return $this->buscarRec($this->raiz, $valor);
    }

    private function buscarRec($no, $valor) {
        if ($no === null || $no->valor == $valor) {
            return $no;
        }

        if ($valor < $no->valor) {
            return $this->buscarRec($no->esquerda, $valor);
        }

        return $this->buscarRec($no->direita, $valor);
    }

    public function remover($valor) {
        $this->raiz = $this->removerRec($this->raiz, $valor);
    }

    private function removerRec($no, $valor) {
        if ($no === null) {
            return null;
        }

        if ($valor < $no->valor) {
            $no->esquerda = $this->removerRec($no->esquerda, $valor);
        } else if ($valor > $no->valor) {
            $no->direita = $this->removerRec($no->direita, $valor);
        } else {

            if ($no->esquerda === null && $no->direita === null) {
                return null;
            }

            if ($no->esquerda === null) {
                return $no->direita;
            }

            if ($no->direita === null) {
                return $no->esquerda;
            }

            $menor = $this->menorValor($no->direita);
            $no->valor = $menor->valor;
            $no->direita = $this->removerRec($no->direita, $menor->valor);
        }

        return $no;
    }

    private function menorValor($no) {
        while ($no->esquerda !== null) {
            $no = $no->esquerda;
        }
        return $no;
    }

    public function inOrder() {
        $this->inOrderRec($this->raiz);
        echo PHP_EOL;
    }

    private function inOrderRec($no) {
        if ($no !== null) {
            $this->inOrderRec($no->esquerda);
            echo $no->valor . " ";
            $this->inOrderRec($no->direita);
        }
    }

    public function preOrder() {
        $this->preOrderRec($this->raiz);
        echo PHP_EOL;
    }

    private function preOrderRec($no) {
        if ($no !== null) {
            echo $no->valor . " ";
            $this->preOrderRec($no->esquerda);
            $this->preOrderRec($no->direita);
        }
    }

    public function postOrder() {
        $this->postOrderRec($this->raiz);
        echo PHP_EOL;
    }

    private function postOrderRec($no) {
        if ($no !== null) {
            $this->postOrderRec($no->esquerda);
            $this->postOrderRec($no->direita);
            echo $no->valor . " ";
        }
    }
}

$arvore = new ArvoreBinariaBusca();
$numeros = [1, 5, 3, 7, 2, 4, 6, 8];

foreach ($numeros as $num) {
    $arvore->inserir($num);
}

echo "In-Order: ";
$arvore->inOrder(); 

echo "Pre-Order: ";
$arvore->preOrder();

echo "Post-Order: ";
$arvore->postOrder();

echo "\nBuscando 40...\n";
$resultado = $arvore->buscar(4);
echo $resultado ? "Encontrado!\n" : "Não encontrado!\n";

echo "\nRemovendo 50...\n";
$arvore->remover(5);

echo "In-Order após remoção: ";
$arvore->inOrder();

?>