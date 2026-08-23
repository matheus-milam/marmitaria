<?php
    if (!isset($pagina)) exit;

    if ($_POST) {

        $id_pedido = trim($_POST["id_pedido"] ?? NULL);
        $nm_cliente = trim($_POST["nm_cliente"] ?? NULL);
        $id_marmita = trim($_POST["id_marmita"] ?? NULL);
        $nr_qnt = trim($_POST["nr_qnt"] ?? NULL);

        if (empty($nm_cliente) || empty($id_marmita) || empty($nr_qnt)) {
            echo "<script>alert('Preencha todos os campos');history.back();</script>";
        } else {

            if (empty($id_pedido)) {
                $sql = "insert into pedido (id_pedido, nm_cliente, id_marmita, nr_qnt)
                values (NULL, :nm_cliente, :id_marmita, :nr_qnt)";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_cliente", $nm_cliente);
                $consulta->bindParam(":id_marmita", $id_marmita);
                $consulta->bindParam(":nr_qnt", $nr_qnt);
            } else {
                $sql = "update pedido set nm_cliente = :nm_cliente, id_marmita = :id_marmita, nr_qnt = :nr_qnt where id_pedido = :id_pedido limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_cliente", $nm_cliente);
                $consulta->bindParam(":id_marmita", $id_marmita);
                $consulta->bindParam(":nr_qnt", $nr_qnt);
                $consulta->bindParam(":id_pedido", $id_pedido);
            }

            if ($consulta->execute()) {
                echo "<script>alert('Registro salvo');location.href='listar/pedido';</script>";
            } else {
                echo "<script>alert('Erro ao salvar');history.back();</script>";
            }

        }

    } else {
        echo "<script>alert('Requisição inválida');history.back();</script>";
    }