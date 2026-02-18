<?php

/*function fibonacci($n) { 
    if ($n === 0) {
        return 0;
    }elseif ($n === 1) {
        return 1;
    }
    return fibonacci($n - 1) + fibonacci($n - 2); 
}
echo fibonacci(20);

?>*/



function fibonacci($n, &$memo = []) {
    if ($n < 0) {
        throw new Exception("Número inválido");
    }

    if ($n === 0) return 0;
    if ($n === 1) return 1;

    if (isset($memo[$n])) {
        return $memo[$n];
    }

    $memo[$n] = fibonacci($n - 1, $memo) + fibonacci($n - 2, $memo);

    return $memo[$n];
}

echo fibonacci(200);

?>
