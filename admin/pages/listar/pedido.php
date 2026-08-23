<?php
if (!isset($pagina)) exit;

$pedidos = $pdo->query("
    SELECT p.id_pedido, p.nm_cliente, p.nr_qnt, m.nm_marmita, m.nr_preco
    FROM pedido p
    INNER JOIN marmita m ON m.id_marmita = p.id_marmita
    ORDER BY p.id_pedido DESC
")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Pedidos</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/pedido" class="btn btn-success">Novo Registro</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($pedidos as $p) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($p->nm_cliente) ?></h5>
                            <p class="card-text">
                                Marmita: <?= htmlspecialchars($p->nm_marmita) ?><br>
                                Preço: R$ <?= number_format($p->nr_preco, 2, ',', '.') ?><br>
                                Quantidade: <?= $p->nr_qnt ?><br>
                                <strong>Total: R$ <?= number_format($p->nr_preco * $p->nr_qnt, 2, ',', '.') ?></strong>
                            </p>
                            <a href="cadastrar/pedido?id=<?= $p->id_pedido ?>" class="btn btn-sm btn-warning">Editar</a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="excluir(<?= $p->id_pedido ?>)">Excluir</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
function excluir(id) {

    if (confirm("Tem certeza que deseja excluir este registro?")) {
        location.href = "excluir/pedido?id=" + id;
    }

}
</script>