<?php
if (!isset($pagina)) exit;

if (!empty($id)) {
    $sql = $pdo->prepare("DELETE FROM marmita WHERE id_marmita = ?");
    $sql->execute([$id]);
}

header("Location: /marmitaria/admin/listar/marmita");
exit;