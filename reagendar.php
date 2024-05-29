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

    // Obter a data e hora atuais
    $atual = new DateTime();

    // Obter a data e hora originais do evento
    $sql = "SELECT start, end FROM evento WHERE id = '$id_reuniao'";
    $result = mysqli_query($conexao, $sql);
    $event = mysqli_fetch_assoc($result);

    if ($event) {
        // Combinar a data de término (end) e a hora de início (start) do evento original
        $dataHoraOriginal = new DateTime($event["end"] . ' ' . $event["start"]);

        // Calcular a diferença em horas
        $intervalo = $atual->diff($dataHoraOriginal);
        $horasRestantes = ($intervalo->days * 24) + $intervalo->h + ($intervalo->i / 60);

        if ($intervalo->invert == 0 && $horasRestantes >= 72) {
            // Se a diferença for maior ou igual a 72 horas, permitir a atualização
            $sql = "UPDATE evento SET title = '$title', start = '$hora', end = '$data' WHERE id = '$id_reuniao'";
            if (mysqli_query($conexao, $sql)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Erro ao reagendar a reunião";
            }
        } else {
            // Se a diferença for menor que 72 horas, não permitir a atualização
            echo "<script>alert('Não é possível reagendar a reunião se faltarem menos de 72 horas para a data e hora atuais.'); window.location.href='dashboard.php';</script>";
            exit();
        }
    } else {
        echo "Evento não encontrado";
    }
}

$conexao->close();
?>
