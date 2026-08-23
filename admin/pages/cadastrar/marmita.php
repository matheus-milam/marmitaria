<?php
if (!isset($pagina)) exit;

$dias = $pdo->query("SELECT id_dia, nm_dia FROM diasemana ORDER BY id_dia")->fetchAll(PDO::FETCH_OBJ);

$diasSelecionados = [];

if (!empty($id)) {
    $sql = "SELECT id_marmita, nm_marmita, ds_marmita, nr_preco, img_marmita FROM marmita WHERE id_marmita = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dadosCadastro = $consulta->fetch(PDO::FETCH_OBJ);

    $sqlDias = "SELECT id_dia FROM dia_marmita WHERE id_marmita = :id";
    $consultaDias = $pdo->prepare($sqlDias);
    $consultaDias->bindParam(":id", $id);
    $consultaDias->execute();
    $diasSelecionados = $consultaDias->fetchAll(PDO::FETCH_COLUMN);
}

$id_marmita = $dadosCadastro->id_marmita ?? null;
$nm_marmita = $dadosCadastro->nm_marmita ?? null;
$ds_marmita = $dadosCadastro->ds_marmita ?? null;
$nr_preco = $dadosCadastro->nr_preco ?? null;
$img_marmita = $dadosCadastro->img_marmita ?? null;
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Marmita</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/marmita" class="btn btn-success">Novo Registro</a>
            <a href="listar/marmita" class="btn btn-primary">Listar Registros</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="salvar/marmita" enctype="multipart/form-data">
            <input type="hidden" name="id_marmita" value="<?= htmlspecialchars($id_marmita) ?>">
            <input type="hidden" name="img_atual" value="<?= htmlspecialchars($img_marmita) ?>">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label">Nome da Marmita</label>
                    <input type="text" name="nm_marmita" class="form-control" required value="<?= htmlspecialchars($nm_marmita) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Preço</label>
                    <input type="number" step="0.01" name="nr_preco" class="form-control" required value="<?= htmlspecialchars($nr_preco) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descrição</label>
                    <textarea name="ds_marmita" class="form-control" rows="3"><?= htmlspecialchars($ds_marmita) ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Imagem</label>
                    <input type="file" name="img_marmita" class="form-control" accept=".jpg,.jpeg,.png">
                    <?php if (!empty($img_marmita)) { ?>
                        <img src="../imgs/<?= htmlspecialchars($img_marmita) ?>" alt="Imagem atual" class="img-thumbnail mt-2" width="150">
                    <?php } ?>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dias em que essa marmita é servida</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($dias as $d) { ?>
                            <div class="form-check">
                                <input type="checkbox" name="dias[]" value="<?= $d->id_dia ?>" class="form-check-input" id="dia_<?= $d->id_dia ?>"
                                    <?= in_array($d->id_dia, $diasSelecionados) ? "checked" : "" ?>>
                                <label class="form-check-label" for="dia_<?= $d->id_dia ?>"><?= htmlspecialchars($d->nm_dia) ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">Salvar Dados</button>
        </form>
    </div>
</div>