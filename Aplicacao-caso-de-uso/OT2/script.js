const cidades5 = [
    [0, 2, 9, 10, 7],
    [2, 0, 6, 4, 3],
    [9, 6, 0, 8, 5],
    [10,4, 8, 0, 6],
    [7, 3, 5, 6, 0]
];

function permutacoes(arr) {

    if (arr.length === 1) return [arr];

    let result = [];

    for (let i = 0; i < arr.length; i++) {

        let atual = arr[i];
        let resto = arr.slice(0, i).concat(arr.slice(i + 1));

        let perms = permutacoes(resto);

        perms.forEach(p => {
            result.push([atual].concat(p));
        });

    }

    return result;
}


function tspForcaBruta(dist) {

    let n = dist.length;

    let cidades = [];
    for (let i = 1; i < n; i++) cidades.push(i);

    let perms = permutacoes(cidades);

    let melhorCusto = Infinity;
    let melhorRota = [];

    perms.forEach(p => {

        let rota = [0].concat(p).concat([0]);

        let custo = 0;

        for (let i = 0; i < rota.length - 1; i++) {
            custo += dist[rota[i]][rota[i+1]];
        }

        if (custo < melhorCusto) {
            melhorCusto = custo;
            melhorRota = rota;
        }

    });

    return {rota: melhorRota, custo: melhorCusto};
}

function vizinhoMaisProximo(dist){

    let n = dist.length;

    let visitado = Array(n).fill(false);

    let rota = [0];
    visitado[0] = true;

    let atual = 0;
    let custo = 0;

    for(let i=1;i<n;i++){

        let menor = Infinity;
        let prox = -1;

        for(let j=0;j<n;j++){

            if(!visitado[j] && dist[atual][j] < menor){
                menor = dist[atual][j];
                prox = j;
            }

        }

        rota.push(prox);
        visitado[prox] = true;
        custo += menor;
        atual = prox;

    }

    custo += dist[atual][0];
    rota.push(0);

    return {rota, custo};
}

console.log("===== TSP FORÇA BRUTA (5 cidades) =====");
let resultado1 = tspForcaBruta(cidades5);
console.log("Rota:", resultado1.rota);
console.log("Custo:", resultado1.custo);


function gerarMatriz(n){

    let matriz = [];

    for(let i=0;i<n;i++){
        matriz[i] = [];

        for(let j=0;j<n;j++){

            if(i===j) matriz[i][j]=0;
            else matriz[i][j]=Math.floor(Math.random()*20)+1;

        }
    }

    return matriz;
}

let cidades10 = gerarMatriz(10);

console.log("===== TSP Vizinho Mais Próximo (10 cidades) =====");

let resultado2 = vizinhoMaisProximo(cidades10);

console.log("Rota:", resultado2.rota);
console.log("Custo:", resultado2.custo);