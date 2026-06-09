<?php 

$host = "10.0.2.15";
$usuario = "marmitaria";
$senha = "1707";
$banco = "marmitariabd";

$conexao = mysqli_connect($host , $usuario, $senha, $banco);

if(!$conexao) {
    die("Erro ao conectar com banco de dados" . mysqli_connect_error());
}


?>


