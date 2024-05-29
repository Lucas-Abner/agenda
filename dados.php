<?php
    session_start();
    include("config.php");

    if (!$_SESSION["login"]) {
        header("Location: index.php");
        exit();
    }

    $query = "SELECT * FROM usuario WHERE email = '".$_SESSION["login"]."'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $nome = $row["nome"];
    $email = $row["email"];
    $usuario = $row["usuario"];
?>

<!DOCTYPE html>
<html lang="pt">

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

    <article id="dados">
    <section class="container">
        <div class="dados">
            <h3>Dados cadastrais</h3><br>
            <form action="alterar.php" method="post">
                <p><strong>Nome: </strong><br>
                <div class="control">
                    <input class="input is-hovered"  type="text" name="nome" value="<?php echo $nome?>">
                </div>
                <p><strong>Usuario: </strong><br>
                <div class="control">
                    <input class="input is-hovered"  type="text" name="usuario" value="<?php echo $usuario?>">
                </div>
                <p><strong>Email: <br></strong></p>
                <div class="control">
                    <input class="input is-hovered"  type="text" name="email" value="<?php echo $email?>" disabled>
                </div><br>
                <div class="control">
                    <button type="submit" class="button is-primary"><strong>Alterar dados</strong></button>
                </div>
            </form>
        </div>
    </section>
    </article>

</body>

</html>