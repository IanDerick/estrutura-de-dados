<?php

class Grafo {
    private $adjacencia = [];

    public function adicionarVertice($vertice) {
        if (!isset($this->adjacencia[$vertice])) {
            $this->adjacencia[$vertice] = [];
        }
    }

    public function adicionarAresta($v1, $v2) {
        $this->adjacencia[$v1][] = $v2;
        $this->adjacencia[$v2][] = $v1;
    }

    public function dfs($inicio, &$visitados = []) {
        if (!isset($visitados[$inicio])) {
            echo $inicio . " ";
            $visitados[$inicio] = true;

            foreach ($this->adjacencia[$inicio] as $vizinho) {
                $this->dfs($vizinho, $visitados);
            }
        }
    }

    public function bfs($inicio) {
        $fila = [];
        $visitados = [];

        array_push($fila, $inicio);
        $visitados[$inicio] = true;

        while (!empty($fila)) {
            $vertice = array_shift($fila);
            echo $vertice . " ";

            foreach ($this->adjacencia[$vertice] as $vizinho) {
                if (!isset($visitados[$vizinho])) {
                    $visitados[$vizinho] = true;
                    array_push($fila, $vizinho);
                }
            }
        }
    }
}

class GrafoDirecionado {
    private $adjacencia = [];

    public function adicionarVertice($vertice) {
        if (!isset($this->adjacencia[$vertice])) {
            $this->adjacencia[$vertice] = [];
        }
    }

    public function adicionarAresta($origem, $destino, $peso) {
        $this->adjacencia[$origem][$destino] = $peso;
    }

    public function dijkstra($inicio) {
        $distancias = [];
        $visitados = [];

        foreach ($this->adjacencia as $vertice => $v) {
            $distancias[$vertice] = INF;
        }

        $distancias[$inicio] = 0;

        while (count($visitados) < count($this->adjacencia)) {

            $menorDist = INF;
            $verticeAtual = null;

            foreach ($distancias as $vertice => $dist) {
                if (!isset($visitados[$vertice]) && $dist < $menorDist) {
                    $menorDist = $dist;
                    $verticeAtual = $vertice;
                }
            }

            if ($verticeAtual === null) {
                break;
            }

            $visitados[$verticeAtual] = true;

            foreach ($this->adjacencia[$verticeAtual] as $vizinho => $peso) {
                $novaDist = $distancias[$verticeAtual] + $peso;

                if ($novaDist < $distancias[$vizinho]) {
                    $distancias[$vizinho] = $novaDist;
                }
            }
        }

        return $distancias;
    }
}

$grafo = new Grafo();

$grafo->adicionarVertice("A");
$grafo->adicionarVertice("B");
$grafo->adicionarVertice("C");
$grafo->adicionarVertice("D");

$grafo->adicionarAresta("A", "B");
$grafo->adicionarAresta("A", "C");
$grafo->adicionarAresta("B", "D");
$grafo->adicionarAresta("C", "D");

echo "DFS: ";
$grafo->dfs("A");

echo "\nBFS: ";
$grafo->bfs("A");

/*--------------------------------*/

$grafo = new GrafoDirecionado();

$grafo->adicionarVertice("A");
$grafo->adicionarVertice("B");
$grafo->adicionarVertice("C");
$grafo->adicionarVertice("D");

$grafo->adicionarAresta("A", "B", 1);
$grafo->adicionarAresta("A", "C", 4);
$grafo->adicionarAresta("B", "C", 2);
$grafo->adicionarAresta("B", "D", 5);
$grafo->adicionarAresta("C", "D", 1);

$distancias = $grafo->dijkstra("A");

echo "Menores distâncias a partir de A:\n";
print_r($distancias);