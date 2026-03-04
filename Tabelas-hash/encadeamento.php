<?php

class No {
    public $chave;
    public $valor;
    public $proximo;

    public function __construct($chave, $valor) {
        $this->chave = $chave;
        $this->valor = $valor;
        $this->proximo = null;
    }
}

class TabelaHash {
    private $tamanho;
    private $tabela;

    public function __construct($tamanho = 10) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
    }

    private function hash($chave) {
        if (is_int($chave)) {
            return $chave % $this->tamanho;
        } else {
            $soma = 0;
            for ($i = 0; $i < strlen($chave); $i++) {
                $soma += ord($chave[$i]);
            }
            return $soma % $this->tamanho;
        }
    }

    public function inserir($chave, $valor) {
        $indice = $this->hash($chave);
        $novoNo = new No($chave, $valor);

        if ($this->tabela[$indice] === null) {
            $this->tabela[$indice] = $novoNo;
        } else {
            $atual = $this->tabela[$indice];

            while ($atual !== null) {
                if ($atual->chave === $chave) {
                    $atual->valor = $valor;
                    return;
                }
                if ($atual->proximo === null) break;
                $atual = $atual->proximo;
            }

            $atual->proximo = $novoNo;
        }
    }

    public function buscar($chave) {
        $indice = $this->hash($chave);
        $atual = $this->tabela[$indice];

        while ($atual !== null) {
            if ($atual->chave === $chave) {
                return $atual->valor;
            }
            $atual = $atual->proximo;
        }

        return null;
    }

    public function remover($chave) {
        $indice = $this->hash($chave);
        $atual = $this->tabela[$indice];
        $anterior = null;

        while ($atual !== null) {
            if ($atual->chave === $chave) {

                if ($anterior === null) {
                    $this->tabela[$indice] = $atual->proximo;
                } else {
                    $anterior->proximo = $atual->proximo;
                }

                return true;
            }

            $anterior = $atual;
            $atual = $atual->proximo;
        }

        return false;
    }

    public function exibir() {
        for ($i = 0; $i < $this->tamanho; $i++) {
            echo "Índice $i: ";
            $atual = $this->tabela[$i];
            while ($atual !== null) {
                echo "({$atual->chave}, {$atual->valor}) -> ";
                $atual = $atual->proximo;
            }
            echo "null\n";
        }
    }
}

$tabela = new TabelaHash(10);

$tabela->inserir(10, "Dez");
$tabela->inserir(20, "Vinte");
$tabela->inserir("abc", "Texto ABC");
$tabela->inserir("cab", "Texto CAB");

echo "Buscar 10: " . $tabela->buscar(10) . "\n";
echo "Buscar abc: " . $tabela->buscar("abc") . "\n";

$tabela->remover(20);

echo "\nTabela após remoção:\n";
$tabela->exibir();

?>