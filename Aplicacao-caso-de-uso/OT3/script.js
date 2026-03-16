function buscaForcaBruta(texto, padrao) {

    let posicoes = [];

    for (let i = 0; i <= texto.length - padrao.length; i++) {

        let j = 0;

        while (j < padrao.length && texto[i + j] === padrao[j]) {
            j++;
        }

        if (j === padrao.length) {
            posicoes.push(i);
        }
    }

    return posicoes;
}

function construirLPS(padrao) {

    let lps = new Array(padrao.length).fill(0);

    let comprimento = 0;
    let i = 1;

    while (i < padrao.length) {

        if (padrao[i] === padrao[comprimento]) {

            comprimento++;
            lps[i] = comprimento;
            i++;

        } else {

            if (comprimento !== 0) {
                comprimento = lps[comprimento - 1];
            } else {
                lps[i] = 0;
                i++;
            }

        }

    }

    return lps;
}

function buscaKMP(texto, padrao) {

    let lps = construirLPS(padrao);

    let posicoes = [];

    let i = 0;
    let j = 0;

    while (i < texto.length) {

        if (texto[i] === padrao[j]) {
            i++;
            j++;
        }

        if (j === padrao.length) {

            posicoes.push(i - j);
            j = lps[j - 1];

        } else if (i < texto.length && texto[i] !== padrao[j]) {

            if (j !== 0) {
                j = lps[j - 1];
            } else {
                i++;
            }

        }

    }

    return posicoes;
}

let textoPequeno = "ABABDABACDABABCABAB";
let padrao = "ABABCABAB";

let textoGrande = "A".repeat(100000) + "B";

console.log("==== TEXTO PEQUENO ====");

console.time("Força Bruta");
let r1 = buscaForcaBruta(textoPequeno, padrao);
console.timeEnd("Força Bruta");

console.time("KMP");
let r2 = buscaKMP(textoPequeno, padrao);
console.timeEnd("KMP");

console.log("Posições encontradas:", r1);


console.log("\n==== TEXTO GRANDE ====");

console.time("Força Bruta");
buscaForcaBruta(textoGrande, "AB");
console.timeEnd("Força Bruta");

console.time("KMP");
buscaKMP(textoGrande, "AB");
console.timeEnd("KMP");