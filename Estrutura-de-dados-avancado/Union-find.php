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
            // Path compression
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
                $this->rank[$rootX] += 1;
            }
        }
    }
}
$uf = new UnionFind(5);

$uf->union(0, 1);
$uf->union(1, 2);
$uf->union(3, 4);

echo $uf->find(0) . PHP_EOL; 
echo $uf->find(2) . PHP_EOL; 
echo $uf->find(3) . PHP_EOL; 