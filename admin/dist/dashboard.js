"use strict";
async function carregarDashboard() {
    try {
        const resposta = await fetch("api/pedidos.php");
        if (!resposta.ok) {
            throw new Error(`Erro na requisição: Status ${resposta.status}`);
        }
        const pedidos = await resposta.json();
        atualizarCards(pedidos);
        preencherFiltro(pedidos);
        renderizarPedidos(pedidos);
        const filtro = document.getElementById("filtro-marmita");
        if (filtro) {
            filtro.addEventListener("change", () => {
                const pedidosFiltrados = filtrarPorMarmita(pedidos, filtro.value);
                renderizarPedidos(pedidosFiltrados);
            });
        }
    }
    catch (erro) {
        console.error("Falha ao carregar pedidos:", erro);
        const container = document.getElementById("lista-pedidos");
        if (container) {
            container.innerHTML = "<p class='text-center text-danger'>Não foi possível carregar os pedidos.</p>";
        }
    }
}
function atualizarCards(pedidos) {
    const elTotal = document.getElementById("faturamento-total");
    const elDestaque = document.getElementById("marmita-destaque");
    if (pedidos.length === 0) {
        if (elTotal)
            elTotal.innerText = formatarMoeda(0);
        if (elDestaque)
            elDestaque.innerText = "Nenhum pedido registrado";
        return;
    }
    const faturamentoTotal = pedidos.reduce((acumulador, item) => {
        return acumulador + item.nr_preco * item.nr_qnt;
    }, 0);
    const contagem = {};
    pedidos.forEach((item) => {
        contagem[item.nm_marmita] = (contagem[item.nm_marmita] || 0) + item.nr_qnt;
    });
    let marmitaDestaque = "";
    let maiorQuantidade = 0;
    for (const nome in contagem) {
        if (contagem[nome] > maiorQuantidade) {
            maiorQuantidade = contagem[nome];
            marmitaDestaque = nome;
        }
    }
    if (elTotal) {
        elTotal.innerText = formatarMoeda(faturamentoTotal);
    }
    if (elDestaque) {
        elDestaque.innerText = marmitaDestaque;
    }
}
function filtrarPorMarmita(pedidos, nomeMarmita) {
    if (nomeMarmita === "todas") {
        return pedidos;
    }
    return pedidos.filter((item) => item.nm_marmita === nomeMarmita);
}
function preencherFiltro(pedidos) {
    const filtro = document.getElementById("filtro-marmita");
    if (!filtro)
        return;
    const nomes = pedidos.map((item) => item.nm_marmita);
    const nomesUnicos = Array.from(new Set(nomes));
    filtro.innerHTML = '<option value="todas">Todas</option>';
    nomesUnicos.forEach((nome) => {
        const option = document.createElement("option");
        option.value = nome;
        option.innerText = nome;
        filtro.appendChild(option);
    });
}
function renderizarPedidos(pedidos) {
    const container = document.getElementById("lista-pedidos");
    if (!container)
        return;
    if (pedidos.length === 0) {
        container.innerHTML = "<p class='text-center'>Nenhum pedido registrado ainda.</p>";
        return;
    }
    const html = pedidos.map((item) => {
        const total = item.nr_preco * item.nr_qnt;
        return `
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${item.nm_cliente}</h5>
                        <p class="card-text">
                            Marmita: ${item.nm_marmita}<br>
                            Preço: ${formatarMoeda(item.nr_preco)}<br>
                            Quantidade: ${item.nr_qnt}<br>
                            <strong>Total: ${formatarMoeda(total)}</strong>
                        </p>
                    </div>
                </div>
            </div>
        `;
    }).join("");
    container.innerHTML = html;
}
function formatarMoeda(valor) {
    return valor.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL"
    });
}
document.addEventListener("DOMContentLoaded", () => {
    carregarDashboard();
});
