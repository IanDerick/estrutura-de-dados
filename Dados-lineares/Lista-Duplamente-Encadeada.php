<?php

// Classe do Nó
class No {
    public $valor;
    public $proximo;
    public $anterior;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->proximo = null;
        $this->anterior = null;
    }
}

class ListaDuplamenteEncadeada {
    private $inicio = null;
    private $fim = null;

    public function inserirInicio($valor) {
        $novoNo = new No($valor);

        if ($this->inicio == null) {
            $this->inicio = $novoNo;
            $this->fim = $novoNo;
        } else {
            $novoNo->proximo = $this->inicio;
            $this->inicio->anterior = $novoNo;
            $this->inicio = $novoNo;
        }
    }

    public function removerFinal() {
        if ($this->fim == null) {
            return "Lista vazia.";
        }

        $valorRemovido = $this->fim->valor;

        if ($this->inicio == $this->fim) { 
            $this->inicio = null;
            $this->fim = null;
        } else {
            $this->fim = $this->fim->anterior;
            $this->fim->proximo = null;
        }

        return "Elemento removido: $valorRemovido";
    }

    public function percorrerFrente() {
        $atual = $this->inicio;
        while ($atual != null) {
            echo $atual->valor . " <-> ";
            $atual = $atual->proximo;
        }
        echo "NULL";
    }

    public function percorrerTras() {
        $atual = $this->fim;
        while ($atual != null) {
            echo $atual->valor . " <-> ";
            $atual = $atual->anterior;
        }
        echo "NULL";
    }
}

$lista = new ListaDuplamenteEncadeada();

$lista->inserirInicio(10);
$lista->inserirInicio(20);
$lista->inserirInicio(30);

echo "início ao fim: ";
$lista->percorrerFrente();
echo "\n";

echo "fim ao início: ";
$lista->percorrerTras();
echo "\n";

echo $lista->removerFinal();
echo "\n";

echo "Após remover do final: ";
$lista->percorrerFrente();

?>
