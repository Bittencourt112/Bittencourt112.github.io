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
                echo "<h4>Nome inserido é muito pequeno!</h4>";

            }

            if(strlen($_POST["inputPhoneNumber"]) > 8){
                $webUserPhoneNumber = $dbConnection->real_escape_string($_POST["inputPhoneNumber"]);

                $sucess++;

            }else{
                echo "<h4>Telefone inserido é muito pequeno!</h4>";

            }

            if(strlen($_POST["inputEmail"]) > 9){
                $webUserEmail = $dbConnection->real_escape_string($_POST["inputEmail"]);

                $sucess++;

            }else{
                echo "<h4>Email inserido é muito pequeno!</h4>";

            }

            if(strlen($_POST["inputPassword"]) > 7){
                $webUserPassword = $dbConnection->real_escape_string($_POST["inputPassword"]);
                $webUserPassword = hash("sha512", $webUserPassword);

                $sucess++;

            }else{
                echo "<h4>Senha inserida é muito pequena!</h4>";

            }

            if($sucess > 3){
                $sqlCode = "SELECT * FROM db_users WHERE userPhoneNumber = '$webUserPhoneNumber' AND userEmail = '$webUserEmail'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                if($sqlQuery->num_rows == 0){
                    $sqlCode = "INSERT INTO db_users (userName, userPhoneNumber, userEmail, userPassword) VALUES ('$webUserName', '$webUserPhoneNumber', '$webUserEmail', '$webUserPassword')";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução de código SQL: " . $dbConnection->error ."</h4>");

                    if(!$dbConnection->error){
                        echo "<h4>Cadastro realizado com sucesso!</h4>";

                    }

                }else{
                    echo "<h4>Telefone e email inseridos já estão cadastrados!</h4>";

                }

            }

        }else{
            echo "<h4>Preencha todos os campos!</h4>";

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
        <div class = "div01">
            <h1>MyBookBase</h1>
            <h3>Gerenciamento de livros</h3>
            <h4>Preencha os campos com seus dados</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputName" placeholder = "Digite o seu nome"><br><br>
                <input id = "input01" type = "number" name = "inputPhoneNumber" placeholder="Digite o seu telefone"><br><br>
                <input id = "input01" type = "email" name = "inputEmail" placeholder = "Digite o seu email"><br><br>
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite sua senha"><br><br>
                <a href= "login.php"><button id = "button01" type= "button">Fazer login</button></a>
                <input id = "button01" type = "submit" value = "Cadastrar">
            </form><br>
        </div>
    </body>
</html>