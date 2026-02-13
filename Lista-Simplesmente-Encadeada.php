<?php

class No {
    public $valor;
    public $proximo;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->proximo = null;
    }
}

class ListaEncadeada {
    private $inicio = null;

    public function inserirInicio($valor) {
        $novoNo = new No($valor);
        $novoNo->proximo = $this->inicio;
        $this->inicio = $novoNo;
    }

    public function inserirFinal($valor) {
        $novoNo = new No($valor);

        if ($this->inicio == null) {
            $this->inicio = $novoNo;
            return;
        }
        $atual = $this->inicio;
        while ($atual->proximo != null) {
            $atual = $atual->proximo;
        }

        $atual->proximo = $novoNo;
    }

    public function removerPosicao($posicao) {
        if ($this->inicio == null) {
            return "Lista vazia.";
        }
        if ($posicao == 0) {
            $this->inicio = $this->inicio->proximo;
            return "Elemento removido com sucesso.";
        }

        $atual = $this->inicio;
        $indice = 0;

        while ($atual != null && $indice < $posicao - 1) {
            $atual = $atual->proximo;
            $indice++;
        }
        if ($atual == null || $atual->proximo == null) {
            return "Posição inválida.";
        }
        $atual->proximo = $atual->proximo->proximo;

        return "Elemento removido com sucesso.";
    }

    public function buscar($valor) {
        $atual = $this->inicio;
        $posicao = 0;

        while ($atual != null) {
            if ($atual->valor == $valor) {
                return "Valor ($valor) encontrado na posição $posicao.";
            }
            $atual = $atual->proximo;
            $posicao++;
        }

        return "Valor ($valor) não encontrado na lista.";
    }

    public function exibir() {
        $atual = $this->inicio;
        while ($atual != null) {
            echo $atual->valor . " -> ";
            $atual = $atual->proximo;
        }
        echo "NULL";
    }
}

$lista = new ListaEncadeada();

$lista->inserirInicio(10);
$lista->inserirInicio(5);
$lista->inserirFinal(20);
$lista->inserirFinal(30);

echo $lista->buscar(20);
echo "\n";
echo $lista->buscar(99);
echo "\n";

echo "Lista atual:";
$lista->exibir();
echo "\n";

echo $lista->removerPosicao(2);
echo "\n";

echo "Lista após remoção:";
$lista->exibir();

?>