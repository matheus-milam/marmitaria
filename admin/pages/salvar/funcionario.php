<?php
    if (!isset($pagina)) exit;

    if ($_POST) {

        $id_funcionario = trim($_POST["id_funcionario"] ?? NULL);
        $nm_funcionario = trim($_POST["nm_funcionario"] ?? NULL);
        $nm_cargo = trim($_POST["nm_cargo"] ?? NULL);
        $nr_telefone = trim($_POST["nr_telefone"] ?? NULL);
        $nr_salario = trim($_POST["nr_salario"] ?? NULL);

        if (empty($nm_funcionario) || empty($nm_cargo) || empty($nr_salario)) {
            echo "<script>alert('Preencha nome, cargo e salário');history.back();</script>";
        } else {

            if (empty($id_funcionario)) {
                $sql = "insert into funcionario (id_funcionario, nm_funcionario, nm_cargo, nr_telefone, nr_salario)
                values (NULL, :nm_funcionario, :nm_cargo, :nr_telefone, :nr_salario)";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_funcionario", $nm_funcionario);
                $consulta->bindParam(":nm_cargo", $nm_cargo);
                $consulta->bindParam(":nr_telefone", $nr_telefone);
                $consulta->bindParam(":nr_salario", $nr_salario);
            } else {
                $sql = "update funcionario set nm_funcionario = :nm_funcionario, nm_cargo = :nm_cargo, nr_telefone = :nr_telefone, nr_salario = :nr_salario where id_funcionario = :id_funcionario limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_funcionario", $nm_funcionario);
                $consulta->bindParam(":nm_cargo", $nm_cargo);
                $consulta->bindParam(":nr_telefone", $nr_telefone);
                $consulta->bindParam(":nr_salario", $nr_salario);
                $consulta->bindParam(":id_funcionario", $id_funcionario);
            }

            if ($consulta->execute()) {
                echo "<script>alert('Registro salvo');location.href='listar/funcionario';</script>";
            } else {
                echo "<script>alert('Erro ao salvar');history.back();</script>";
            }

        }

    } else {
        echo "<script>alert('Requisição inválida');history.back();</script>";
    }