<?php
include("config.php");

$PicNum = $_GET["PicNum"];

$result = mysqli_query($conexao, "SELECT imagem FROM evento WHERE id = $PicNum") or die("Impossível executar a query");

$row = mysqli_fetch_assoc($result);

$imagemPath = $row["imagem"]; // Caminho da imagem armazenado no banco de dados

// Verifica se o arquivo de imagem existe no servidor
if (file_exists($imagemPath)) {
    // Define o tipo de conteúdo como imagem
    header("Content-type: image/jpeg");

    // Lê o conteúdo do arquivo e envia como resposta
    readfile($imagemPath);
} else {
    // Se o arquivo de imagem não existir, exibe uma imagem de erro ou uma mensagem
    // Por exemplo, uma imagem padrão de erro ou uma mensagem de erro
    echo "Imagem não encontrada";
}
?>
