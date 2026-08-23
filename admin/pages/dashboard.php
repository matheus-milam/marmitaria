<h2>Visão Geral de Pedidos</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-subtitle text-muted">Faturamento Total</h6>
                <h3 id="faturamento-total">Carregando...</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-subtitle text-muted">Marmita Mais Vendida</h6>
                <h3 id="marmita-destaque">Carregando...</h3>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    <label for="filtro-marmita" class="form-label">Filtrar por Marmita</label>
    <select id="filtro-marmita" class="form-select">
        <option value="todas">Todas</option>
    </select>
</div>

<div class="row" id="lista-pedidos">
    <p class="text-center">Carregando pedidos...</p>
</div>

<script src="dist/dashboard.js"></script>