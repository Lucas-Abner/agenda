<?php
session_start();

include("config.php");

if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["usuario"]) || empty($_POST["senha"])){
    echo"<script language='javascript' type='text/javascript'>
    alert('Necessario preencher todos os campos');window.location.href='criar.php';</script>";
    exit;
}

$nome = mysqli_real_escape_string($conn, trim($_POST["nome"]));
$email = mysqli_real_escape_string($conn, trim($_POST["email"]));
$usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"]));
$senha = mysqli_real_escape_string($conn, trim($_POST["senha"]));
$query = "SELECT COUNT(*) AS total FROM usuario WHERE usuario = '$usuario'";
$select = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($select);

if($row["total"] == 1){
    echo"<script language='javascript' type='text/javascript'>
    alert('Usuario já existe');window.location.href='criar.php';</script>";
    exit;
}

$sql = "INSERT INTO usuario(nome, email, usuario, senha, tipo) VALUES ('$nome','$email','$usuario','$senha', 'utilizador')";

if($conn->query($sql) === TRUE){
    echo"<script language='javascript' type='text/javascript'>
    alert('Cadastro realizado com sucesso');";
}

$conn->close();

header("Location: index.php");
exit;
?>