<?php

class Node {
    public $value;
    public $left;
    public $right;

    public function __construct($value) {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

function preOrder($node) {
    if ($node !== null) {
        echo $node->value . " ";
        preOrder($node->left);
        preOrder($node->right);
    }
}
function inOrder($node) {
    if ($node !== null) {
        inOrder($node->left);
        echo $node->value . " ";
        inOrder($node->right);
    }
}
function postOrder($node) {
    if ($node !== null) {
        postOrder($node->left);
        postOrder($node->right);
        echo $node->value . " ";
    }
}
$root = new Node(10);
$root->left = new Node(5);
$root->right = new Node(15);

echo "In-Order: ";
inOrder($root);

echo "\nPre-Order: ";
preOrder($root);

echo "\nPost-Order: ";
postOrder($root);
?>