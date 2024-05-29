<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Caso Prático PHP</title>
    <style>
        body{
            background-color: #f2f2f2;
            margin: 100px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Cadastrar conta</h3>
                            <form action="cadastro.php" method="post">
                            <div class="mb-3">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Usuario</label>
                                    <input type="text" name="usuario" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Senha</label>
                                    <input type="password" name="senha" class="form-control">
                                </div>
                                <div class="mb-3 btn-area">
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>