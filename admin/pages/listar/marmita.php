<?php
if (!isset($pagina)) exit;

$marmitas = $pdo->query("SELECT id_marmita, nm_marmita, ds_marmita, nr_preco, img_marmita FROM marmita ORDER BY nm_marmita")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Marmitas</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/marmita" class="btn btn-success">Novo Registro</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($marmitas as $m) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <?php if (!empty($m->img_marmita)) { ?>
                            <img src="../imgs/<?= htmlspecialchars($m->img_marmita) ?>" class="card-img-top" alt="<?= htmlspecialchars($m->nm_marmita) ?>">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($m->nm_marmita) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($m->ds_marmita) ?></p>
                            <p class="card-text">R$ <?= number_format($m->nr_preco, 2, ',', '.') ?></p>
                            <a href="cadastrar/marmita?id=<?= $m->id_marmita ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="excluir/marmita?id=<?= $m->id_marmita ?>" class="btn btn-sm btn-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>