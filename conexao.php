<?php 

$host = "192.168.56.101";
$usuario = "marmitaria";
$senha = "1707";
$banco = "marmitariabd";

$conexao = mysqli_connect($host , $usuario, $senha, $banco);

if(!$conexao) {
    die("Erro ao conectar com banco de dados" . mysqli_connect_error());
}


?>


