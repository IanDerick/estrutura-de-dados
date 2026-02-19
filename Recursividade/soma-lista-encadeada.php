<?php

class Node {
    public $value;
    public $next;

    public function __construct($value) {
        $this->value = $value;
        $this->next = null;
    }
}
function somaLista($node) {
    if ($node === null) {
        return 0;
    }

    return $node->value + somaLista($node->next);
}
$node1 = new Node(10);
$node2 = new Node(20);
$node3 = new Node(30);

$node1->next = $node2;
$node2->next = $node3;

echo somaLista($node1);
