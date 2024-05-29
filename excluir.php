<?php
session_start();

$host = "localhost";
$root = "root";
$pass = "";
$db = "sistema";

$conexao = mysqli_connect($host, $root, $pass, $db);

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET["id"])) {
    $idValor = $_GET["id"];

    // Obter a data de término, a hora de início e o nome da imagem do evento
    $sql = "SELECT imagem, start, end FROM evento WHERE id = '$idValor'";
    $result = mysqli_query($conexao, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);

        // Concatenar a data e a hora para formar um DateTime completo
        $dataMarcacao = new DateTime($event["end"] . ' ' . $event["start"]);
        // Data e hora atuais
        $atual = new DateTime();

        // Calcular a diferença em horas
        $intervalo = $atual->diff($dataMarcacao);
        $horasRestantes = ($intervalo->days * 24) + $intervalo->h + ($intervalo->i / 60);

        if ($intervalo->invert == 0 && $horasRestantes < 72) {
            // Se a diferença for menor que 72 horas, não permitir a exclusão
            echo "<script>alert('Não é possível excluir o evento com menos de 72 horas de antecedência.'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            // Excluir o evento
            $sql = "DELETE FROM evento WHERE id = '$idValor'";
            if (mysqli_query($conexao, $sql)) {
                // Excluir o arquivo da imagem associada
                if (!empty($event["imagem"])) {
                    unlink("./assets/imagens/uploads/" . $event["imagem"]);
                }
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Erro ao excluir o evento.'); window.location.href='admin.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Evento não encontrado.'); window.location.href='dashboard.php';</script>";
    }
}

mysqli_close($conexao);
?>
