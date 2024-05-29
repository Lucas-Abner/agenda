<?php
session_start();
include("config.php");

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET["id"])) {
    $idValor = $_GET["id"];

    // Obter a imagem, data de término e a hora de início do evento
    $sql = "SELECT imagem, start, end FROM evento WHERE id = '$idValor'";
    $result = mysqli_query($conexao, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);

        // Excluir o evento
        $sql = "DELETE FROM evento WHERE id = '$idValor'";
        if (mysqli_query($conexao, $sql)) {
            // Excluir o arquivo da imagem associada
            if (!empty($event["imagem"])) {
                unlink("./assets/imagens/uploads/" . $event["imagem"]);
            }
            header("Location: admin.php");
            exit();
        } else {
            echo "<script>alert('Erro ao excluir o evento.'); window.location.href='admin.php';</script>";
        }
    } else {
        echo "<script>alert('Evento não encontrado.'); window.location.href='admin.php';</script>";
    }
} else {
    echo "<script>alert('Evento não encontrado.'); window.location.href='admin.php';</script>";
}

mysqli_close($conexao);
?>
