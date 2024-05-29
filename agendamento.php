<?php
session_start();
include("config.php");

// Conexão com o banco de dados de usuários
$conn_usuarios = mysqli_connect(HOST, USER, PASS, 'sislogin');
if (!$conn_usuarios) {
    die("Falha na conexão com o banco de dados de usuários: " . mysqli_connect_error());
}

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM usuario WHERE email = '" . $_SESSION["login"] . "'";
$result = mysqli_query($conn_usuarios, $query);
if (!$result) {
    die("Erro ao executar a consulta: " . mysqli_error($conn_usuarios));
}
$row = mysqli_fetch_assoc($result);

$nome = $row["nome"];
$usuario_id = $row["id"];

mysqli_close($conn_usuarios);

// Conexão com o banco de dados de eventos
$conn_eventos = mysqli_connect(HOST, USER, PASS, BD);
if (!$conn_eventos) {
    die("Falha na conexão com o banco de dados de eventos: " . mysqli_connect_error());
}

// Verificar se a imagem foi enviada corretamente
if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
    //Variáveis que contêm os detalhes da imagem
    $imagem = $_FILES["imagem"]["name"];
    $nomeTemporario = $_FILES["imagem"]["tmp_name"];

    // Verificar se o tipo de arquivo é suportado
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($_FILES["imagem"]["type"], $allowed_types)) {
        echo "<script>alert('Tipo de arquivo de imagem não suportado.');window.location.href='dashboard.php';</script>";
        exit();
    }

    // Mover o arquivo de imagem para o diretório correto
    $nome_imagem = md5(uniqid(time())) . ".jpg"; // Use .jpg para garantir que a extensão seja compatível com todas as imagens
    $caminho = "./assets/imagens/uploads/" . $nome_imagem;
    move_uploaded_file($nomeTemporario, $caminho);
} else {
    echo "<script>alert('Falha ao enviar a imagem.');window.location.href='dashboard.php';</script>";
    exit();
}

// Variáveis do formulário
$title = $_POST["title"];
$hora = $_POST["hora"];
$data = $_POST["data"];

if (empty($hora) || empty($data) || empty($imagem)) {
    echo "<script>alert('Necessário preencher os campos.');window.location.href='dashboard.php';</script>";
    exit();
}

$sql = "INSERT INTO evento (usuario_id, nome, imagem, title, start, end) VALUES ('$usuario_id', '$nome', '$nome_imagem', '$title', '$hora', '$data')";
if (mysqli_query($conn_eventos, $sql)) {
    echo "<script>alert('Agendamento realizado.');window.location.href='dashboard.php';</script>";
    exit();
} else {
    echo "<script>alert('Agendamento não realizado.');window.location.href='dashboard.php';</script>";
    exit();
}

mysqli_close($conn_eventos);
?>
