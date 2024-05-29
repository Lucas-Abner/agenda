<?php
session_start();
include("config.php");

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reuniao = $_POST["id_reuniao"];
    $title = $_POST["title"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    // Obter a data e hora originais do evento
    $sql = "SELECT start, end FROM evento WHERE id = '$id_reuniao'";
    $result = mysqli_query($conexao, $sql);
    $event = mysqli_fetch_assoc($result);

    if ($event) {
        $sql = "UPDATE evento SET title = '$title', start = '$hora', end = '$data' WHERE id = '$id_reuniao'";
        if (mysqli_query($conexao, $sql)) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Erro ao reagendar a reunião";
        }
    } else {
        echo "Evento não encontrado";
    }
}

$conexao->close();
?>
