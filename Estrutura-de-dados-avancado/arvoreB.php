<?php

class BTreeNode {
    public $keys = [];
    public $children = [];
    public $leaf;
    public $t;

    public function __construct($t, $leaf = true) {
        $this->t = $t;
        $this->leaf = $leaf;
    }

    public function traverse($nivel = 0) {
        echo str_repeat("  ", $nivel) . "[" . implode(", ", $this->keys) . "]\n";

        if (!$this->leaf) {
            foreach ($this->children as $child) {
                $child->traverse($nivel + 1);
            }
        }
    }

    public function insertNonFull($k) {
        $i = count($this->keys) - 1;

        if ($this->leaf) {
            $this->keys[] = 0;

            while ($i >= 0 && $k < $this->keys[$i]) {
                $this->keys[$i + 1] = $this->keys[$i];
                $i--;
            }

            $this->keys[$i + 1] = $k;

        } else {

            while ($i >= 0 && $k < $this->keys[$i]) {
                $i--;
            }

            $i++;

            if (count($this->children[$i]->keys) == 2 * $this->t - 1) {
                $this->splitChild($i, $this->children[$i]);

                if ($k > $this->keys[$i]) {
                    $i++;
                }
            }

            $this->children[$i]->insertNonFull($k);
        }
    }

    public function splitChild($i, $y) {

        $t = $this->t;

        $z = new BTreeNode($t, $y->leaf);

        $z->keys = array_slice($y->keys, $t);
        $y->keys = array_slice($y->keys, 0, $t - 1);

        if (!$y->leaf) {
            $z->children = array_slice($y->children, $t);
            $y->children = array_slice($y->children, 0, $t);
        }

        array_splice($this->children, $i + 1, 0, [$z]);
        array_splice($this->keys, $i, 0, [$y->keys[$t - 1] ?? null]);
    }
}

class BTree {

    public $root;
    public $t;

    public function __construct($t) {
        $this->root = new BTreeNode($t);
        $this->t = $t;
    }

    public function insert($k) {

        $r = $this->root;

        if (count($r->keys) == 2 * $this->t - 1) {

            $s = new BTreeNode($this->t, false);
            $s->children[] = $r;

            $s->splitChild(0, $r);

            $i = 0;

            if ($s->keys[0] < $k) {
                $i++;
            }

            $s->children[$i]->insertNonFull($k);

            $this->root = $s;

        } else {
            $r->insertNonFull($k);
        }
    }

    public function show() {
        $this->root->traverse();
        echo "\n";
    }
}
$btree = new BTree(3);

$valores = [10,20,5,6,12,30,7,17];

foreach ($valores as $v) {

    echo "Inserindo $v\n";

    $btree->insert($v);

    $btree->show();
}