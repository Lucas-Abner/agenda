<?php
    session_start();
    include("config.php");

    if(empty($_POST["login"]) || empty($_POST["senha"])){
        header("Location: index.php");
        exit();
    }

    //Essa função protege o login de mysql inject
    $usuario = mysqli_real_escape_string($conn, $_POST["login"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

    $query = "SELECT * FROM usuario WHERE email = '{$usuario}' AND senha = '{$senha}'";

    $result = mysqli_query($conn, $query);

    if($result->num_rows == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION["login"] = $usuario;
        if($row["tipo"] == "admin"){
            header("Location: admin.php");
        }else{
            header("Location: dashboard.php");
        }
    }else{
        header("Location: index.php");
        exit();
    }
?>

