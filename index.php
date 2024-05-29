<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Caso Prático PHP</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Entrar no site</h3>
                            <form action="login.php" method="post">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="text" name="login" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Senha</label>
                                    <input type="password" name="senha" class="form-control">
                                </div>
                                <div class="mb-3 btn-area">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="criar.php">Criar conta</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>