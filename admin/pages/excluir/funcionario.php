<?php
if (!isset($pagina)) exit;
 
if (!empty($id)) {
    $sql = $pdo->prepare("DELETE FROM funcionario WHERE id_funcionario = ?");
    $sql->execute([$id]);
}
 
header("Location: /marmitaria/admin/listar/funcionario");
exit;