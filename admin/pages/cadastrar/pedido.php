<?php
if (!isset($pagina)) exit;

$marmitas = $pdo->query("SELECT id_marmita, nm_marmita, nr_preco FROM marmita ORDER BY nm_marmita")->fetchAll(PDO::FETCH_OBJ);

if (!empty($id)) {
    $sql = "SELECT id_pedido, nm_cliente, id_marmita, nr_qnt FROM pedido WHERE id_pedido = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dadosCadastro = $consulta->fetch(PDO::FETCH_OBJ);
}

$id_pedido = $dadosCadastro->id_pedido ?? null;
$nm_cliente = $dadosCadastro->nm_cliente ?? null;
$id_marmita_selecionada = $dadosCadastro->id_marmita ?? null;
$nr_qnt = $dadosCadastro->nr_qnt ?? 1;
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Pedido</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/pedido" class="btn btn-success">Novo Registro</a>
            <a href="listar/pedido" class="btn btn-primary">Listar Registros</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="salvar/pedido">
            <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($id_pedido) ?>">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nome Completo do Cliente</label>
                    <input type="text" name="nm_cliente" class="form-control" required value="<?= htmlspecialchars($nm_cliente) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Marmita</label>
                    <select name="id_marmita" class="form-select" required>
                        <?php foreach ($marmitas as $m) { ?>
                            <option value="<?= $m->id_marmita ?>" <?= $m->id_marmita == $id_marmita_selecionada ? "selected" : "" ?>>
                                <?= htmlspecialchars($m->nm_marmita) ?> - R$ <?= number_format($m->nr_preco, 2, ',', '.') ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Quantidade</label>
                    <input type="number" name="nr_qnt" class="form-control" min="1" required value="<?= htmlspecialchars($nr_qnt) ?>">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">Salvar Dados</button>
        </form>
    </div>
</div>