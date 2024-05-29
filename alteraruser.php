<?php
session_start();
include("config.php");

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_user"])) {
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $user = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $id_user = mysqli_real_escape_string($conn, $_POST["id_user"]);

    if (!empty($nome) && !empty($user)) {
        $sql = "UPDATE usuario SET nome = '$nome', usuario = '$user' WHERE id = '$id_user'";

        if (mysqli_query($conn, $sql)) {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Alteração realizada');window.location.href='admin.php';</script>";
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Alteração não realizada');window.location.href='dados.php';</script>";
            exit();
        }
    } else {
        echo "<script language='javascript' type='text/javascript'>
              alert('Os campos nome e usuário são obrigatórios.');window.location.href='dados.php';</script>";
        exit();
    }
}

mysqli_close($conn);
?>
