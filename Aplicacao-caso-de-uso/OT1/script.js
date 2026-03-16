/* ---------- FILA ---------- */

let fila = [];

function adicionar(){
    let nome = document.getElementById("doc").value;

    if(nome === "") return;

    fila.push(nome);
    document.getElementById("doc").value = "";

    atualizarFila();
}

function imprimir(){

    if(fila.length === 0) return;

    fila.shift();

    atualizarFila();
}

function atualizarFila(){

    let lista = document.getElementById("fila");
    lista.innerHTML = "";

    fila.forEach(doc => {

        let li = document.createElement("li");
        li.textContent = doc;

        lista.appendChild(li);

    });

}


/* ---------- PILHA ---------- */

let pilha = [];
let atual = null;

function visitar(pagina){

    if(atual !== null){
        pilha.push(atual);
    }

    atual = pagina;

    atualizarPilha();
}

function voltar(){

    if(pilha.length === 0) return;

    atual = pilha.pop();

    atualizarPilha();
}

function atualizarPilha(){

    document.getElementById("atual").textContent = atual || "Nenhuma";

    let lista = document.getElementById("pilha");
    lista.innerHTML = "";

    pilha.slice().reverse().forEach(p => {

        let li = document.createElement("li");
        li.textContent = p;

        lista.appendChild(li);

    });

}