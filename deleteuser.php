<?php
session_start();
include("config.php");

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}
// ID de exemplo
if(isset($_GET["id"])){
    $id_user = $_GET["id"];
    // Removendo usuário do banco de dados
    $sql = mysqli_query($conn, "DELETE FROM usuario WHERE id = '".$id_user."'");
    header("Location: admin.php");
    exit;
}

mysqli_close($conn);
?>