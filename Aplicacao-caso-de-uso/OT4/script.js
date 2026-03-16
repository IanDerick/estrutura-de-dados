class Node {
    constructor(folha = false) {
        this.folha = folha;
        this.chaves = [];
        this.filhos = [];
    }
}

class BPlusTree {

    constructor() {
        this.dados = [];
    }

    inserir(arquivo) {
        this.dados.push(arquivo);
    }

    buscar(nome) {
        return this.dados.find(a => a.nome === nome);
    }

    remover(nome) {
        this.dados = this.dados.filter(a => a.nome !== nome);
    }

}

class SistemaArquivos {

    constructor() {
        this.arvore = new BPlusTree();
    }

    criarArquivo(nome) {
        this.arvore.inserir({ nome });
    }

    removerArquivo(nome) {
        this.arvore.remover(nome);
    }

    buscarArquivo(nome) {
        return this.arvore.buscar(nome);
    }
}

let fs = new SistemaArquivos();

let quantidade = 10000;


/* ---------- INSERÇÃO ---------- */

console.time("Tempo de inserção");

for (let i = 0; i < quantidade; i++) {

    fs.criarArquivo("arquivo_" + i + ".txt");

}

console.timeEnd("Tempo de inserção");


/* ---------- BUSCA ---------- */

console.time("Tempo de busca");

for (let i = 0; i < 1000; i++) {

    fs.buscarArquivo("arquivo_" + Math.floor(Math.random()*quantidade) + ".txt");

}

console.timeEnd("Tempo de busca");


/* ---------- REMOÇÃO ---------- */

console.time("Tempo de remoção");

for (let i = 0; i < 5000; i++) {

    fs.removerArquivo("arquivo_" + i + ".txt");

}

console.timeEnd("Tempo de remoção");


console.log("Arquivos restantes:", fs.arvore.dados.length);