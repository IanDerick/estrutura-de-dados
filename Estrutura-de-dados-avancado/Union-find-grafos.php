<?php

class UnionFind {
    private $parent = [];
    private $rank = [];

    public function __construct($n) {
        for ($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i;
            $this->rank[$i] = 1;
        }
    }

    public function find($x) {
        if ($this->parent[$x] != $x) {
            $this->parent[$x] = $this->find($this->parent[$x]);
        }
        return $this->parent[$x];
    }

    public function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX != $rootY) {
            if ($this->rank[$rootX] > $this->rank[$rootY]) {
                $this->parent[$rootY] = $rootX;
            } elseif ($this->rank[$rootX] < $this->rank[$rootY]) {
                $this->parent[$rootX] = $rootY;
            } else {
                $this->parent[$rootY] = $rootX;
                $this->rank[$rootX]++;
            }
        }
    }
}
function kruskal($vertices, $edges) {

    usort($edges, function($a, $b) {
        return $a[2] - $b[2];
    });

    $uf = new UnionFind($vertices);

    $mst = [];
    $pesoTotal = 0;

    foreach ($edges as $edge) {

        $u = $edge[0];
        $v = $edge[1];
        $peso = $edge[2];

        if ($uf->find($u) != $uf->find($v)) {

            $uf->union($u, $v);

            $mst[] = $edge;
            $pesoTotal += $peso;

        } else {
            echo "Ciclo detectado na aresta ($u,$v)\n";
        }
    }

    return [$mst, $pesoTotal];
}

$vertices = 4;

$edges = [
    [0,1,10],
    [0,2,6],
    [0,3,5],
    [1,3,15],
    [2,3,4]
];

list($mst, $pesoTotal) = kruskal($vertices, $edges);

echo "Arestas da Árvore Geradora Mínima:\n";

foreach ($mst as $e) {
    echo $e[0] . " - " . $e[1] . " peso: " . $e[2] . "\n";
}

echo "Peso total da MST: $pesoTotal\n";