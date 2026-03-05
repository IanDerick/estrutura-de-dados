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

    public function __construct($tamanho) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
    }

    private function hash($chave) {
        $A = 0.6180339887;
        $valor = $chave * $A;
        return (int) floor($this->tamanho * ($valor - floor($valor)));
    }

    public function inserir($chave, $valor) {
        $indice = $this->hash($chave);
        $novo = new No($chave, $valor);
        $novo->proximo = $this->tabela[$indice];
        $this->tabela[$indice] = $novo;
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
}

define("N", 500);
$tamanhos = [50, 100, 250];

foreach ($tamanhos as $tam) {

    $hash = new TabelaHash($tam);
    $dados = range(1, N);
    shuffle($dados);

    foreach ($dados as $d) {
        $hash->inserir($d, $d);
    }

    $inicioBusca = microtime(true);
    foreach ($dados as $d) {
        $hash->buscar($d);
    }
    $tempoBusca = (microtime(true) - $inicioBusca) / N;

    $inicioRem = microtime(true);
    foreach ($dados as $d) {
        $hash->remover($d);
    }
    $tempoRem = (microtime(true) - $inicioRem) / N;

    echo "Tamanho da tabela: $tam\n";
    echo "Load factor (λ): " . (N / $tam) . "\n";
    echo "Tempo médio busca: $tempoBusca\n";
    echo "Tempo médio remoção: $tempoRem\n";
    echo "-----------------------------\n";
}

?>