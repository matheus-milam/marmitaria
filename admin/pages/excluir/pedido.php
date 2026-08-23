<?php
if (!isset($pagina)) exit;

if (!empty($id)) {
    $sql = $pdo->prepare("DELETE FROM pedido WHERE id_pedido = ?");
    $sql->execute([$id]);
}

header("Location: /marmitaria/admin/listar/pedido");
exit;