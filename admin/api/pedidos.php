<?php
header("Content-Type: application/json");
include "../../conexao.php";

$pedidos = $pdo->query("
    SELECT p.id_pedido, p.nm_cliente, p.nr_qnt, m.nm_marmita, m.nr_preco
    FROM pedido p
    INNER JOIN marmita m ON m.id_marmita = p.id_marmita
    ORDER BY p.id_pedido DESC
")->fetchAll(PDO::FETCH_OBJ);

echo json_encode($pedidos);