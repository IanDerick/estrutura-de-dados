<?php

class TabelaHashLinear {
    private $tamanho;
    private $tabela;
    private $ocupados;

    public function __construct($tamanho = 10) {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, null);
        $this->ocupados = 0;
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

        if ($this->ocupados >= $this->tamanho) {
            echo "Tabela cheia!\n";
            return false;
        }

        $indice = $this->hash($chave);

        while ($this->tabela[$indice] !== null) {

            if ($this->tabela[$indice]['chave'] === $chave) {
                $this->tabela[$indice]['valor'] = $valor;
                return true;
            }

            $indice = ($indice + 1) % $this->tamanho;
        }

        $this->tabela[$indice] = [
            'chave' => $chave,
            'valor' => $valor
        ];

        $this->ocupados++;
        return true;
    }

    public function buscar($chave) {
        $indice = $this->hash($chave);
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

    public function exibir() {
        for ($i = 0; $i < $this->tamanho; $i++) {
            if ($this->tabela[$i] !== null) {
                echo "Índice $i: ({$this->tabela[$i]['chave']}, {$this->tabela[$i]['valor']})\n";
            } else {
                echo "Índice $i: vazio\n";
            }
        }
    }
}

$tabela = new TabelaHashLinear(7);

$tabela->inserir(10, "Dez");
$tabela->inserir(17, "Dezessete");
$tabela->inserir(24, "Vinte e quatro");
$tabela->inserir(31, "Trinta e um");

echo "Buscar 17: " . $tabela->buscar(17) . "\n\n";

$tabela->exibir();

?>