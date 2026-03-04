<?php

define("N", 1000);
define("TAMANHO", 1333);

function hashSimples($chave, $tamanho) {
    return $chave % $tamanho;
}

class TabelaEncadeamento {
    private $tabela;
    private $tamanho;

    public function __construct($tamanho) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
    }

    public function inserir($chave, $valor) {
        $indice = hashSimples($chave, $this->tamanho);
        $novo = ['chave' => $chave, 'valor' => $valor, 'prox' => $this->tabela[$indice]];
        $this->tabela[$indice] = $novo;
    }

    public function buscar($chave) {
        $indice = hashSimples($chave, $this->tamanho);
        $atual = $this->tabela[$indice];

        while ($atual !== null) {
            if ($atual['chave'] === $chave) {
                return $atual['valor'];
            }
            $atual = $atual['prox'];
        }
        return null;
    }
}

class TabelaLinear {
    private $tabela;
    private $tamanho;

    public function __construct($tamanho) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
    }

    public function inserir($chave, $valor) {
        $indice = hashSimples($chave, $this->tamanho);

        while ($this->tabela[$indice] !== null) {
            $indice = ($indice + 1) % $this->tamanho;
        }

        $this->tabela[$indice] = ['chave' => $chave, 'valor' => $valor];
    }

    public function buscar($chave) {
        $indice = hashSimples($chave, $this->tamanho);
        $contador = 0;

        while ($this->tabela[$indice] !== null && $contador < $this->tamanho) {
            if ($this->tabela[$indice]['chave'] === $chave) {
                return $this->tabela[$indice]['valor'];
            }
            $indice = ($indice + 1) % $this->tamanho;
            $contador++;
        }
        return null;
    }
}

$dados = range(1, N);
shuffle($dados);

$enc = new TabelaEncadeamento(TAMANHO);

$inicio = microtime(true);
foreach ($dados as $d) {
    $enc->inserir($d, $d);
}
foreach ($dados as $d) {
    $enc->buscar($d);
}
$tempoEnc = microtime(true) - $inicio;

$lin = new TabelaLinear(TAMANHO);

$inicio = microtime(true);
foreach ($dados as $d) {
    $lin->inserir($d, $d);
}
foreach ($dados as $d) {
    $lin->buscar($d);
}
$tempoLin = microtime(true) - $inicio;

echo "Encadeamento: " . $tempoEnc . " segundos\n";
echo "Probing Linear: " . $tempoLin . " segundos\n";

?>