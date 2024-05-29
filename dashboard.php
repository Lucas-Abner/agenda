<?php
session_start();
include("config.php");

// Conexão com o banco de dados de usuários
$conn_usuarios = mysqli_connect(HOST, USER, PASS, BASE); // Substitua 'usuarios_db' pelo nome correto do banco de dados de usuários
if (!$conn_usuarios) {
    die("Falha na conexão com o banco de dados de usuários: " . mysqli_connect_error());
}

// Verificação de login
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

// Recuperar dados do usuário
$query = "SELECT * FROM usuario WHERE email = '" . $_SESSION["login"] . "'";
$result = mysqli_query($conn_usuarios, $query);
if (!$result) {
    die("Erro ao executar a consulta: " . mysqli_error($conn_usuarios));
}
$row = mysqli_fetch_assoc($result);

$nome = $row["nome"];
$email = $row["email"];
$usuario = $row["usuario"];
$usuario_id = $row["id"];

mysqli_close($conn_usuarios);

// Conexão com o banco de dados de eventos
$conn_eventos = mysqli_connect(HOST, USER, PASS, BD); // Usando o banco de dados de eventos
if (!$conn_eventos) {
    die("Falha na conexão com o banco de dados de eventos: " . mysqli_connect_error());
}

$consulta = "SELECT * FROM evento WHERE usuario_id = '$usuario_id'";
$res = mysqli_query($conn_eventos, $consulta);
if (!$res) {
    die("Erro ao executar a consulta: " . mysqli_error($conn_eventos));
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bulma.min.css">
    <link rel="stylesheet" href="./assets/css/style2.css">
    <title>Caso Prático PHP</title>
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <h2>Olá, <?php echo htmlspecialchars($nome); ?></h2>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="logout.php" class="button is-primary">
                            <strong>Sair</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <article id="dados">
        <section class="container">
            <div class="dados">
                <h3>Dados cadastrais</h3><br>
                <p><strong>Nome: </strong><?php echo htmlspecialchars($nome); ?></p>
                <p><strong>Usuário: </strong><?php echo htmlspecialchars($usuario); ?></p>
                <p><strong>Email: </strong><?php echo htmlspecialchars($email); ?></p><br>
                <a href="dados.php" class="button is-primary">
                    <strong>Alterar dados</strong>
                </a>
            </div>
            <div class="reuniao">
                <h3>Marcar reunião</h3><br>
                <form action="agendamento.php" method="post" enctype="multipart/form-data">
                    <label for="title">Qual motivo da reunião?</label>
                    <div class="select">
                        <select name="title" required>
                            <option value="">Selecione um assunto</option>
                            <option value="Projeto">Projeto</option>
                            <option value="Orcamento">Orçamento</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div><br>
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input" type="file" name="imagem" />
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">Imagem projeto</span>
                            </span>
                        </label>
                    </div>
                    <label for="data">Data:</label><br>
                    <input class="input is-normal" type="date" name="data" placeholder="Escolha uma data" required />
                    <label for="hora">Hora:</label><br>
                    <input class="input is-normal" type="time" name="hora" placeholder="Escolha uma hora" required />
                    <div class="control">
                        <button type="submit" class="agendar button is-primary"><strong>Agendar</strong></button>
                    </div>
                </form>
            </div>
            <div class="infos">
                <h3>Reuniões -</h3><br>
                <table>
                    <thead>
                        <tr>
                            <th>Sobre</th>
                            <th>Hora</th>
                            <th>Data</th>
                            <th scope="col" colspan="2" style="text-align: center;">Config</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = mysqli_fetch_assoc($res)) {

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["start"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["end"]) . "</td>";
                            echo "<td><a href='editar.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a></td>";
                            echo "<td><a href='excluir.php?id=" . htmlspecialchars($row['id']) . "' style='color: red;'>Excluir</a></td>";
                        }

                        mysqli_close($conn_eventos);
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </article>

    <script src="https://kit.fontawesome.com/aa86e8bc42.js" crossorigin="anonymous"></script>
</body>
</html>
