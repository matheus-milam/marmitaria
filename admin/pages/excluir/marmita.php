<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {

        $sqlVerifica = $pdo->prepare("SELECT COUNT(*) FROM pedido WHERE id_marmita = :id");
        $sqlVerifica->bindParam(":id", $id);
        $sqlVerifica->execute();
        $totalPedidos = $sqlVerifica->fetchColumn();

        if ($totalPedidos > 0) {
            echo "<script>alert('Não é possível excluir: existem pedidos vinculados a esta marmita');history.back();</script>";
        } else {

            $sqlDias = $pdo->prepare("DELETE FROM dia_marmita WHERE id_marmita = :id");
            $sqlDias->bindParam(":id", $id);
            $sqlDias->execute();

            $sql = $pdo->prepare("delete from marmita where id_marmita = :id limit 1");
            $sql->bindParam(":id", $id);

            if ($sql->execute()) {
                echo "<script>alert('Registro excluído com sucesso');location.href='/marmitaria/admin/listar/marmita';</script>";
            } else {
                echo "<script>alert('Erro ao excluir o registro');history.back();</script>";
            }

        }

    } else {
        echo "<script>alert('Requisição inválida');history.back();</script>";
    }