<?php
    session_start();
    include("config.php");

    $nome = $_POST["nome"];
    $user = $_POST["usuario"];

    if(isset($nome) || isset($user)){
        $sql = "UPDATE usuario SET nome = '$nome', usuario = '$user' WHERE email ='".$_SESSION["login"]."'";

        if($conn->query($sql) === TRUE){
            echo"<script language='javascript' type='text/javascript'>
            alert('Alteração realizada');window.location.href='dados.php';</script>";
            exit;
        }else{
            echo"<script language='javascript' type='text/javascript'>
            alert('Alteração não realizada');window.location.href='dados.php';</script>";
            exit;
        }
    }

    $conn->close();
?>