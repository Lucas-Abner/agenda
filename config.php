<?php
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("BASE", "sislogin");
    define("BD", "sistema");

    $conn = mysqli_connect(HOST, USER, PASS, BASE) or die("Erro ao tentar conectar");
    $conexao = mysqli_connect(HOST, USER, PASS, BD) or die("Erro na conexão");

?>