<?php

function fatorial($n) {
    if ($n < 0) {
        throw new Error("Fatorial negativo");
    }

    if ($n === 0 || $n === 1) {
        return 1;
    } 

    return $n * fatorial($n - 1);
}
echo fatorial(11);

/*Complexidade de tempo: O(n) linear*/

?>