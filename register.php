<?php
    include("connect.php");

    if(!isset($_SESSION)){
        session_start();
    }else{
        session_destroy();
        session_start();
    }

    $sucess = 0;

    if(isset($_POST["inputName"]) && isset($_POST["inputPhoneNumber"]) && isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])){
        if(strlen($_POST["inputName"]) != 0 && strlen($_POST["inputPhoneNumber"]) != 0 && strlen($_POST["inputEmail"]) != 0 && strlen($_POST["inputPassword"]) != 0){
            if(strlen($_POST["inputName"]) > 7){
                $webUserName = $dbConnection->real_escape_string($_POST["inputName"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Nome precisa de ao menos 8 caracteres!');</script>";

            }

            if(strlen($_POST["inputPhoneNumber"]) > 10){
                $webUserPhoneNumber = $dbConnection->real_escape_string($_POST["inputPhoneNumber"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Telefone precisa de ao menos 9 digitos e o seu DDD!');</script>";

            }

            if(strlen($_POST["inputEmail"]) > 9){
                $webUserEmail = $dbConnection->real_escape_string($_POST["inputEmail"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Email precisa de ao menos 10 caracteres!');</script>";

            }

            if(strlen($_POST["inputPassword"]) > 7){
                $webUserPassword = $dbConnection->real_escape_string($_POST["inputPassword"]);
                $webUserPassword = hash("sha512", $webUserPassword);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Senha precisa de ao menos 8 caracteres!');</script>";

            }

            if($sucess > 3){
                $sqlCode = "SELECT * FROM db_users WHERE userPhoneNumber = '$webUserPhoneNumber' AND userEmail = '$webUserEmail'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                if($sqlQuery->num_rows == 0){
                    $sqlCode = "INSERT INTO db_users (userName, userPhoneNumber, userEmail, userPassword) VALUES ('$webUserName', '$webUserPhoneNumber', '$webUserEmail', '$webUserPassword')";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                    if(!$dbConnection->error){
                        echo "<script type = 'text/javascript'>alert('Cadastrado com sucesso!');</script>";

                    }

                }else{
                    echo "<script type = 'text/javascript'>alert('Telefone e email já cadastrados!');</script>";

                }

            }

        }else{
            echo "<script type = 'text/javascript'>alert('Preencha todos os campos!');</script>";

        }
    }

    $dbConnection->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro - MyBookBase</title>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
    <body>
        <div class = "div00">
            <h2>MyBookBase</h2>
            <h3>Gerencie seus livros online</h3>
            <h4>Cadastro</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputName" placeholder = "Digite o seu nome"><br><br>
                <input id = "input01" type = "number" name = "inputPhoneNumber" placeholder="Digite o seu telefone"><br><br>
                <input id = "input01" type = "email" name = "inputEmail" placeholder = "Digite o seu email"><br><br>
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite sua senha"><br><br>
                <a href= "login.php"><button id = "button01" type= "button">Fazer login</button></a>
                <input id = "button01" type = "submit" value = "Enviar">
            </form><br>
        </div>
    </body>
</html>