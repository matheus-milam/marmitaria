async function carregarDashboard(): Promise<void> {
    try {
        const resposta = await fetch("api/pedidos.php");

        if (!resposta.ok) {
            throw new Error("Erro na requisição: Status " + resposta.status);
        }

        const pedidos: Pedido[] = await resposta.json();

        atualizarCards(pedidos);
        preencherFiltro(pedidos);
        mostrarPedidos(pedidos);

        const filtro = document.getElementById("filtro-marmita") as HTMLSelectElement | null;

        if (filtro) {
            filtro.addEventListener("change", function () {
                const pedidosFiltrados = filtrarPorMarmita(pedidos, filtro.value);
                mostrarPedidos(pedidosFiltrados);
            });
        }

    } catch (erro) {
        console.error("Falha ao carregar pedidos:", erro);
        alert("Erro ao carregar os dados da API. Verifique o console.");
    }
}

function atualizarCards(pedidos: Pedido[]): void {
    const vlTotal = document.getElementById("faturamento-total");
    const mtDestaque = document.getElementById("marmita-destaque");

    if (pedidos.length === 0) {
        if (vlTotal) {
            vlTotal.innerText = formatarMoeda(0);
        }
        if (mtDestaque) {
            mtDestaque.innerText = "Nenhum pedido registrado";
        }
        return;
    }

    const faturamentoTotal = pedidos.reduce(function (soma, pedido) {
        return soma + pedido.nr_preco * pedido.nr_qnt;
    }, 0);

    const contagem: { [nome: string]: number } = {};

    for (let i = 0; i < pedidos.length; i++) {
        const nome = pedidos[i].nm_marmita;
        const quantidade = pedidos[i].nr_qnt;

        if (contagem[nome] === undefined) {
            contagem[nome] = 0;
        }

        contagem[nome] = contagem[nome] + quantidade;
    }

    let marmitaDestaque = "";
    let maiorQuantidade = 0;

    for (const nome in contagem) {
        if (contagem[nome] > maiorQuantidade) {
            maiorQuantidade = contagem[nome];
            marmitaDestaque = nome;
        }
    }

    if (vlTotal) {
        vlTotal.innerText = formatarMoeda(faturamentoTotal);
    }

    if (mtDestaque) {
        mtDestaque.innerText = marmitaDestaque;
    }
}

function filtrarPorMarmita(pedidos: Pedido[], nomeMarmita: string): Pedido[] {
    if (nomeMarmita === "todas") {
        return pedidos;
    }

    return pedidos.filter(function (pedido) {
        return pedido.nm_marmita === nomeMarmita;
    });
}

function preencherFiltro(pedidos: Pedido[]): void {
    const filtro = document.getElementById("filtro-marmita") as HTMLSelectElement | null;
    if (!filtro) return;

    const nomesJaAdicionados: string[] = [];
    let opcoes = "<option value='todas'>Todas</option>";

    for (let i = 0; i < pedidos.length; i++) {
        const nome = pedidos[i].nm_marmita;

        if (nomesJaAdicionados.indexOf(nome) === -1) {
            nomesJaAdicionados.push(nome);
            opcoes = opcoes + "<option value='" + nome + "'>" + nome + "</option>";
        }
    }

    filtro.innerHTML = opcoes;
}

function mostrarPedidos(pedidos: Pedido[]): void {
    const container = document.getElementById("lista-pedidos");
    if (!container) return;

    if (pedidos.length === 0) {
        container.innerHTML = "<p class='text-center'>Nenhum pedido registrado ainda.</p>";
        return;
    }

    const listaDeCards = pedidos.map(function (pedido) {
        const total = pedido.nr_preco * pedido.nr_qnt;

        return "<div class='col-md-4 mb-3'>" +
            "<div class='card'>" +
            "<div class='card-body'>" +
            "<h5 class='card-title'>" + pedido.nm_cliente + "</h5>" +
            "<p class='card-text'>" +
            "Marmita: " + pedido.nm_marmita + "<br>" +
            "Preço: " + formatarMoeda(pedido.nr_preco) + "<br>" +
            "Quantidade: " + pedido.nr_qnt + "<br>" +
            "<strong>Total: " + formatarMoeda(total) + "</strong>" +
            "</p>" +
            "</div>" +
            "</div>" +
            "</div>";
    });

    container.innerHTML = listaDeCards.join("");
}

function formatarMoeda(valor: number): string {
    return valor.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL"
    });
}

document.addEventListener("DOMContentLoaded", function () {
    carregarDashboard();
});