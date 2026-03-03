<?php

class NoAVL {
    public $valor;
    public $esquerda;
    public $direita;
    public $altura;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->esquerda = null;
        $this->direita = null;
        $this->altura = 1;
    }
}

class ArvoreAVL {
    private $raiz = null;

    private function altura($no) {
        return $no ? $no->altura : 0;
    }

    private function fatorBalanceamento($no) {
        return $no ? $this->altura($no->esquerda) - $this->altura($no->direita) : 0;
    }

    private function atualizarAltura($no) {
        $no->altura = 1 + max(
            $this->altura($no->esquerda),
            $this->altura($no->direita)
        );
    }

    private function rotacaoDireita($y) {
        $x = $y->esquerda;
        $t2 = $x->direita;

        $x->direita = $y;
        $y->esquerda = $t2;

        $this->atualizarAltura($y);
        $this->atualizarAltura($x);

        return $x;
    }

    private function rotacaoEsquerda($x) {
        $y = $x->direita;
        $t2 = $y->esquerda;

        $y->esquerda = $x;
        $x->direita = $t2;

        $this->atualizarAltura($x);
        $this->atualizarAltura($y);

        return $y;
    }

    public function inserir($valor) {
        $this->raiz = $this->inserirRec($this->raiz, $valor);
    }

    private function inserirRec($no, $valor) {
        if ($no === null) {
            return new NoAVL($valor);
        }

        if ($valor < $no->valor) {
            $no->esquerda = $this->inserirRec($no->esquerda, $valor);
        } elseif ($valor > $no->valor) {
            $no->direita = $this->inserirRec($no->direita, $valor);
        } else {
            return $no;
        }

        $this->atualizarAltura($no);
        $balance = $this->fatorBalanceamento($no);

        if ($balance > 1 && $valor < $no->esquerda->valor) {
            return $this->rotacaoDireita($no);
        }

        if ($balance < -1 && $valor > $no->direita->valor) {
            return $this->rotacaoEsquerda($no);
        }

        if ($balance > 1 && $valor > $no->esquerda->valor) {
            $no->esquerda = $this->rotacaoEsquerda($no->esquerda);
            return $this->rotacaoDireita($no);
        }

        if ($balance < -1 && $valor < $no->direita->valor) {
            $no->direita = $this->rotacaoDireita($no->direita);
            return $this->rotacaoEsquerda($no);
        }

        return $no;
    }

    public function remover($valor) {
        $this->raiz = $this->removerRec($this->raiz, $valor);
    }

    private function removerRec($no, $valor) {
        if ($no === null) return null;

        if ($valor < $no->valor) {
            $no->esquerda = $this->removerRec($no->esquerda, $valor);
        } elseif ($valor > $no->valor) {
            $no->direita = $this->removerRec($no->direita, $valor);
        } else {

            if ($no->esquerda === null || $no->direita === null) {
                $no = $no->esquerda ?? $no->direita;
            } else {
                $menor = $this->menorValor($no->direita);
                $no->valor = $menor->valor;
                $no->direita = $this->removerRec($no->direita, $menor->valor);
            }
        }

        if ($no === null) return null;

        $this->atualizarAltura($no);
        $balance = $this->fatorBalanceamento($no);

        if ($balance > 1 && $this->fatorBalanceamento($no->esquerda) >= 0) {
            return $this->rotacaoDireita($no);
        }

        if ($balance > 1 && $this->fatorBalanceamento($no->esquerda) < 0) {
            $no->esquerda = $this->rotacaoEsquerda($no->esquerda);
            return $this->rotacaoDireita($no);
        }

        if ($balance < -1 && $this->fatorBalanceamento($no->direita) <= 0) {
            return $this->rotacaoEsquerda($no);
        }

        if ($balance < -1 && $this->fatorBalanceamento($no->direita) > 0) {
            $no->direita = $this->rotacaoDireita($no->direita);
            return $this->rotacaoEsquerda($no);
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
}

$arvore = new ArvoreAVL();

$valores = [1, 2, 3, 4, 5, 10];

foreach ($valores as $v) {
    $arvore->inserir($v);
}

echo "In-Order após inserções:\n";
$arvore->inOrder();

$arvore->remover(4);

echo "In-Order após remoção do 4:\n";
$arvore->inOrder();

?>