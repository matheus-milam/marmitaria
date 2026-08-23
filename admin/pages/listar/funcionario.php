<?php
if (!isset($pagina)) exit;

$funcionarios = $pdo->query("SELECT id_funcionario, nm_funcionario, nm_cargo, nr_telefone, nr_salario FROM funcionario ORDER BY nm_funcionario")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Funcionários</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/funcionario" class="btn btn-success">Novo Registro</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($funcionarios as $f) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($f->nm_funcionario) ?></h5>
                            <p class="card-text">
                                Cargo: <?= htmlspecialchars($f->nm_cargo) ?><br>
                                Telefone: <?= htmlspecialchars($f->nr_telefone) ?><br>
                                Salário: R$ <?= number_format($f->nr_salario, 2, ',', '.') ?>
                            </p>
                            <a href="cadastrar/funcionario?id=<?= $f->id_funcionario ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="excluir/funcionario?id=<?= $f->id_funcionario ?>" class="btn btn-sm btn-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>