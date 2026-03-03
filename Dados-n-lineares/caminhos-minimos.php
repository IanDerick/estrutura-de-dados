<?php

class Grafo {
    private $adj = [];

    public function adicionarVertice($v) {
        if (!isset($this->adj[$v])) {
            $this->adj[$v] = [];
        }
    }

    public function adicionarAresta($origem, $destino, $peso) {
        $this->adj[$origem][$destino] = $peso;
    }

    public function dijkstra($origem) {
        $dist = [];
        $visitados = [];

        foreach ($this->adj as $v => $edges) {
            $dist[$v] = INF;
        }

        $dist[$origem] = 0;

        while (count($visitados) < count($this->adj)) {

            $menorDist = INF;
            $u = null;

            foreach ($dist as $v => $d) {
                if (!isset($visitados[$v]) && $d < $menorDist) {
                    $menorDist = $d;
                    $u = $v;
                }
            }

            if ($u === null) break;

            $visitados[$u] = true;

            foreach ($this->adj[$u] as $vizinho => $peso) {
                $novaDist = $dist[$u] + $peso;
                if ($novaDist < $dist[$vizinho]) {
                    $dist[$vizinho] = $novaDist;
                }
            }
        }

        return $dist;
    }
}

$grafos = new Grafo();

$vertices = ["A","B","C","D"];
foreach ($vertices as $v) {
    $grafos->adicionarVertice($v);
}

$grafos->adicionarAresta("A","B",1);
$grafos->adicionarAresta("A","C",4);
$grafos->adicionarAresta("B","C",2);
$grafos->adicionarAresta("B","D",5);
$grafos->adicionarAresta("C","D",1);

$resultado = $grafos->dijkstra("A");

echo "Menores distâncias a partir de A:\n";
print_r($resultado);

function floydWarshall($grafo, $vertices) {

    $dist = [];

    foreach ($vertices as $i) {
        foreach ($vertices as $j) {
            if ($i == $j) {
                $dist[$i][$j] = 0;
            } elseif (isset($grafo[$i][$j])) {
                $dist[$i][$j] = $grafo[$i][$j];
            } else {
                $dist[$i][$j] = INF;
            }
        }
    }

    foreach ($vertices as $k) {
        foreach ($vertices as $i) {
            foreach ($vertices as $j) {
                if ($dist[$i][$k] + $dist[$k][$j] < $dist[$i][$j]) {
                    $dist[$i][$j] = $dist[$i][$k] + $dist[$k][$j];
                }
            }
        }
    }

    return $dist;
}

$vertices = ["A","B","C","D"];

$grafo = [
    "A" => ["B"=>1, "C"=>4],
    "B" => ["C"=>2, "D"=>5],
    "C" => ["D"=>1],
    "D" => []
];

$distancias = floydWarshall($grafo, $vertices);

echo "Matriz de menores distâncias:\n";
print_r($distancias);