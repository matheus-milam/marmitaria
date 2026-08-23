<?php
if (!isset($pagina)) exit;

if (!empty($id)) {
    $sql = "SELECT id_funcionario, nm_funcionario, nm_cargo, nr_telefone, nr_salario FROM funcionario WHERE id_funcionario = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dadosCadastro = $consulta->fetch(PDO::FETCH_OBJ);
}

$id_funcionario = $dadosCadastro->id_funcionario ?? null;
$nm_funcionario = $dadosCadastro->nm_funcionario ?? null;
$nm_cargo = $dadosCadastro->nm_cargo ?? null;
$nr_telefone = $dadosCadastro->nr_telefone ?? null;
$nr_salario = $dadosCadastro->nr_salario ?? null;
?>
<div class="card shadow m-3">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Funcionário</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/funcionario" class="btn btn-success">Novo Registro</a>
            <a href="listar/funcionario" class="btn btn-primary">Listar Registros</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="salvar/funcionario">
            <input type="hidden" name="id_funcionario" value="<?= htmlspecialchars($id_funcionario) ?>">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nm_funcionario" class="form-control" required value="<?= htmlspecialchars($nm_funcionario) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cargo</label>
                    <input type="text" name="nm_cargo" class="form-control" required value="<?= htmlspecialchars($nm_cargo) ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="nr_telefone" class="form-control" value="<?= htmlspecialchars($nr_telefone) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Salário</label>
                    <input type="number" step="0.01" name="nr_salario" class="form-control" required value="<?= htmlspecialchars($nr_salario) ?>">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">Salvar Dados</button>
        </form>
    </div>
</div>