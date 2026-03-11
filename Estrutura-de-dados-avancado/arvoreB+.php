<?php

class BMaisNode {
    public $keys = [];
    public $children = [];
    public $leaf;
    public $next = null;

    public function __construct($leaf = true) {
        $this->leaf = $leaf;
    }
}

class BMaisTree {

    private $root;
    private $t;

    public function __construct($t) {
        $this->t = $t;
        $this->root = new BMaisNode(true);
    }

    public function insert($key) {

        $root = $this->root;

        if (count($root->keys) == 2*$this->t -1) {

            $newRoot = new BMaisNode(false);
            $newRoot->children[] = $root;

            $this->splitChild($newRoot,0);

            $this->root = $newRoot;
        }

        $this->insertNonFull($this->root,$key);
    }

    private function insertNonFull($node,$key){

        if($node->leaf){

            $node->keys[] = $key;
            sort($node->keys);

        } else {

            $i = count($node->keys)-1;

            while($i>=0 && $key < $node->keys[$i]){
                $i--;
            }

            $i++;

            if(count($node->children[$i]->keys) == 2*$this->t-1){

                $this->splitChild($node,$i);

                if($key > $node->keys[$i]){
                    $i++;
                }
            }

            $this->insertNonFull($node->children[$i],$key);
        }
    }

    private function splitChild($parent,$index){

        $t = $this->t;

        $node = $parent->children[$index];
        $newNode = new BMaisNode($node->leaf);

        $mid = $t-1;

        $parentKey = $node->keys[$mid];

        $newNode->keys = array_slice($node->keys,$mid+1);
        $node->keys = array_slice($node->keys,0,$mid);

        if(!$node->leaf){
            $newNode->children = array_slice($node->children,$t);
            $node->children = array_slice($node->children,0,$t);
        }

        array_splice($parent->keys,$index,0,[$parentKey]);
        array_splice($parent->children,$index+1,0,[$newNode]);

        if($node->leaf){
            $newNode->next = $node->next;
            $node->next = $newNode;
        }
    }

    public function printTree($node=null,$level=0){

        if($node==null){
            $node=$this->root;
        }

        echo str_repeat("  ",$level);

        if($node->leaf){
            echo "Folha: ";
        } else {
            echo "Interno: ";
        }

        echo "[".implode(", ",$node->keys)."]\n";

        foreach($node->children as $child){
            $this->printTree($child,$level+1);
        }
    }
}
$tree = new BMaisTree(2);

$valores = [15,5,25,10,20,30,35];

foreach($valores as $v){

    echo "Inserindo $v\n";

    $tree->insert($v);

    $tree->printTree();

    echo "\n";
}