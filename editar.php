<?php
    session_start();

    if(!$_SESSION["login"]){
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bulma.min.css">
    <link rel="stylesheet" href="./assets/css/style2.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
        <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-item">
                    <div class="buttons">
                        <a href="dashboard.php" class="button is-link">
                            <strong>Voltar</strong>
                        </a>
                    </div>
                </div>
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

    <div class="reuniao-area">
    <div class="reuniao">
        <h3>Marcar reunião</h3><br>
        <form action="reagendar.php" method="post">
            <input type="hidden" name="id_reuniao" value="<?php echo $_GET['id']; ?>">
            <label for="title">Qual motivo da reunião?</label>
            <div class="select">
                <select name="title">
                    <option value="">Selecione um assunto</option>
                    <option value="Projeto">Projetos</option>
                    <option value="Orcamento">Orçamento</option>
                    <option value="Outros">Outros</option>
                </select>
            </div><br>
            <label for="data">Data:</label><br>
            <input class="input is-normal" type="date" name="data" placeholder="Escolha um novo horario" />
            <label for="hora">Hora:</label><br>
            <input class="input is-normal" type="time" name="hora" placeholder="Escolha uma nova data" />
            <div class="control">
                <button type="submit" class="agendar button is-primary"><strong>Reagendar</strong></button>
            </div>
        </form>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/aa86e8bc42.js" crossorigin="anonymous"></script>
</body>
</html>