<?php
session_start();
include("config.php");

if (!$_SESSION["login"]) {
    header("Location: index.php");
    exit;
}

// Consulta para buscar todos os usuários no banco de dados sislogin
$sqlUsuarios = "SELECT * FROM usuario";
$queryUsuarios = mysqli_query($conn, $sqlUsuarios);

// Consulta para buscar todos os eventos e associar com os usuários no banco de dados sistema
$sqlEventos = "SELECT * FROM evento";
$queryEventos = mysqli_query($conexao, $sqlEventos);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bulma.min.css">
    <link rel="stylesheet" href="./assets/css/style2.css">
</head>

<body>
    <div id="modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <p class="image is-4by3">
        <img id="modal-image" src="#" alt="Imagem">
        </p>
    </div>
    <button class="modal-close is-large" aria-label="close" onclick="closeModal()"></button>
    </div>

    <section class="perfil">
        <div class="perfil-foto">
            <img src="https://th.bing.com/th/id/OIP.Z4bqFXAzNTYPRzWFkQsZPQAAAA?rs=1&pid=ImgDetMain" alt="">
        </div>
        <div class="perfil-area">
            <h1>Perfil Administrador</h1><br>
            <div class="buttons">
                <a href="logout.php" class="button is-primary">
                    <strong>Sair</strong>
                </a>
            </div>
        </div>
    </section>

    <hr style="width: 70%; margin: auto;">

    <section class="usuarios">
        <div class="box">
            <h3>Usuarios</h3><br>
            <div class="tabela-area">
                <table>
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nome</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Config</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($queryUsuarios)) {
                            if($row["tipo"] != "admin"){
                                echo "<tr>";
                                echo "<td>".$row["id"]."</td>";
                                echo "<td>".$row["nome"]."</td>";
                                echo "<td>".$row["usuario"]."</td>";
                                echo "<td>".$row["email"]."</td>";
                                echo "<td><a href='editaruser.php?id=".$row["id"]."'>Editar</a></td>";
                                echo "<td><a style='color:red;' href='deleteuser.php?id=".$row["id"]."'>Excluir</a></td>";
                                echo "</tr>";
                            }

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="horarios">
        <div class="box">
            <h3>Horarios marcados</h3><br>
            <div class="tabela-area">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Imagem</th>
                            <th>Assunto</th>
                            <th>Horario</th>
                            <th>Data</th>
                            <th>Config</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($queryEventos)) {
                            echo "<tr>";
                            echo "<td>".$row["nome"]."</td>";
                            echo "<td><a href='./assets/imagens/uploads/".$row["imagem"]."' target='_blank'><img width='30px' src='./assets/imagens/uploads/".$row["imagem"]."' alt='Foto de exibição' /></a></td>";
                            echo "<td>".$row["title"]."</td>";
                            echo "<td>".$row["start"]."</td>";
                            echo "<td>".$row["end"]."</td>";
                            echo "<td><a href='editarreuniao.php?id=".$row["id"]."'>Editar</a></td>";
                            echo "<td><a style='color:red;' href='excluirreuniao.php?id=".$row["id"]."'>Excluir</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>
