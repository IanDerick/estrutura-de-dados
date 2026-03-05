<?php

class No {
    public $palavra;
    public $significado;
    public $proximo;

    public function __construct($palavra, $significado) {
        $this->palavra = $palavra;
        $this->significado = $significado;
        $this->proximo = null;
    }
}

class Dicionario {
    private $tamanho;
    private $tabela;

    public function __construct($tamanho = 101) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
    }

    private function hash($palavra) {
        $soma = 0;
        for ($i = 0; $i < strlen($palavra); $i++) {
            $soma += ord($palavra[$i]);
        }
        return $soma % $this->tamanho;
    }

    public function inserir($palavra, $significado) {
        $indice = $this->hash($palavra);
        $atual = $this->tabela[$indice];

        while ($atual !== null) {
            if ($atual->palavra === $palavra) {
                $atual->significado = $significado;
                echo "Palavra atualizada!\n";
                return;
            }
            $atual = $atual->proximo;
        }

        $novo = new No($palavra, $significado);
        $novo->proximo = $this->tabela[$indice];
        $this->tabela[$indice] = $novo;

        echo "Palavra inserida com sucesso!\n";
    }

    public function buscar($palavra) {
        $indice = $this->hash($palavra);
        $atual = $this->tabela[$indice];

        while ($atual !== null) {
            if ($atual->palavra === $palavra) {
                return $atual->significado;
            }
            $atual = $atual->proximo;
        }

        return null;
    }

    public function remover($palavra) {
        $indice = $this->hash($palavra);
        $atual = $this->tabela[$indice];
        $anterior = null;

        while ($atual !== null) {

            if ($atual->palavra === $palavra) {

                if ($anterior === null) {
                    $this->tabela[$indice] = $atual->proximo;
                } else {
                    $anterior->proximo = $atual->proximo;
                }

                echo "Palavra removida com sucesso!\n";
                return;
            }

            $anterior = $atual;
            $atual = $atual->proximo;
        }

        echo "Palavra não encontrada para remoção.\n";
    }
}


$dicionario = new Dicionario();

$dicionario->inserir("php", "Linguagem de programação para web.");
$dicionario->inserir("hash", "Estrutura de dados baseada em função hash.");
$dicionario->inserir("algoritmo", "Sequência finita de passos para resolver um problema.");

echo "\nBuscando 'php':\n";
$resultado = $dicionario->buscar("php");

if ($resultado !== null) {
    echo "Significado: $resultado\n";
} else {
    echo "Palavra não encontrada no dicionário.\n";
}

echo "\nBuscando 'estrutura':\n";
$resultado = $dicionario->buscar("estrutura");

if ($resultado !== null) {
    echo "Significado: $resultado\n";
} else {
    echo "Palavra não encontrada no dicionário.\n";
}

echo "\nRemovendo 'hash':\n";
$dicionario->remover("hash");

echo "\nBuscando 'hash' novamente:\n";
$resultado = $dicionario->buscar("hash");

if ($resultado !== null) {
    echo "Significado: $resultado\n";
} else {
    echo "Palavra não encontrada no dicionário.\n";
}

?>