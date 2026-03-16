class Grafo {

    constructor() {
        this.lista = {};
    }

    adicionarUsuario(usuario) {

        if (!this.lista[usuario]) {
            this.lista[usuario] = [];
        }

    }

    adicionarAmizade(u1, u2) {

        this.adicionarUsuario(u1);
        this.adicionarUsuario(u2);

        this.lista[u1].push(u2);
        this.lista[u2].push(u1);

    }

    menorDistancia(inicio, destino) {

        let fila = [inicio];
        let visitado = {};
        let distancia = {};

        visitado[inicio] = true;
        distancia[inicio] = 0;

        while (fila.length > 0) {

            let atual = fila.shift();

            if (atual === destino) {
                return distancia[atual];
            }

            for (let vizinho of this.lista[atual]) {

                if (!visitado[vizinho]) {

                    visitado[vizinho] = true;

                    distancia[vizinho] = distancia[atual] + 1;

                    fila.push(vizinho);

                }

            }

        }

        return -1;
    }

}
let rede = new Grafo();

rede.adicionarAmizade("Ana", "Bruno");
rede.adicionarAmizade("Ana", "Carlos");
rede.adicionarAmizade("Bruno", "Daniel");
rede.adicionarAmizade("Carlos", "Eduardo");
rede.adicionarAmizade("Daniel", "Fernanda");
rede.adicionarAmizade("Eduardo", "Fernanda");

let distancia = rede.menorDistancia("Ana", "Fernanda");

console.log("Menor distância entre Ana e Fernanda:", distancia);