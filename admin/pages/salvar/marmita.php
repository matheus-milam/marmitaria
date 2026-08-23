<?php
    if (!isset($pagina)) exit;

    if ($_POST) {

        $id_marmita = trim($_POST["id_marmita"] ?? NULL);
        $nm_marmita = trim($_POST["nm_marmita"] ?? NULL);
        $ds_marmita = trim($_POST["ds_marmita"] ?? NULL);
        $nr_preco = trim($_POST["nr_preco"] ?? NULL);
        $img_marmita = $_POST["img_atual"] ?? NULL;

        if (empty($nm_marmita) || empty($nr_preco)) {
            echo "<script>alert('Preencha o nome e o preço');history.back();</script>";
        } else {

            if (!empty($_FILES["img_marmita"]["name"])) {
                $extensao = pathinfo($_FILES["img_marmita"]["name"], PATHINFO_EXTENSION);
                $nomeArquivo = uniqid("marmita_") . "." . $extensao;
                $caminhoDestino = "../../../imgs/{$nomeArquivo}";

                if (move_uploaded_file($_FILES["img_marmita"]["tmp_name"], $caminhoDestino)) {
                    redimensionarImagem($caminhoDestino, 400, 400);
                    $img_marmita = $nomeArquivo;
                }
            }

            if (empty($id_marmita)) {
                $sql = "insert into marmita (id_marmita, nm_marmita, ds_marmita, nr_preco, img_marmita)
                values (NULL, :nm_marmita, :ds_marmita, :nr_preco, :img_marmita)";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_marmita", $nm_marmita);
                $consulta->bindParam(":ds_marmita", $ds_marmita);
                $consulta->bindParam(":nr_preco", $nr_preco);
                $consulta->bindParam(":img_marmita", $img_marmita);
            } else {
                $sql = "update marmita set nm_marmita = :nm_marmita, ds_marmita = :ds_marmita, nr_preco = :nr_preco, img_marmita = :img_marmita where id_marmita = :id_marmita limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nm_marmita", $nm_marmita);
                $consulta->bindParam(":ds_marmita", $ds_marmita);
                $consulta->bindParam(":nr_preco", $nr_preco);
                $consulta->bindParam(":img_marmita", $img_marmita);
                $consulta->bindParam(":id_marmita", $id_marmita);
            }

            if ($consulta->execute()) {
                echo "<script>alert('Registro salvo');location.href='listar/marmita';</script>";
            } else {
                echo "<script>alert('Erro ao salvar');history.back();</script>";
            }

        }

    } else {
        echo "<script>alert('Requisição inválida');history.back();</script>";
    }