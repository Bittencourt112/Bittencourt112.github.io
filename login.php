<?php
    include("connect.php");

    if(!isset($_SESSION)){
        session_start();
    }else{
        session_destroy();
        session_start();
    }

    $sucess = 0;
    
    if(isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])){
        if(strlen($_POST["inputEmail"]) != 0 || strlen($_POST["inputPassword"]) != 0){
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

            if($sucess > 1){
                $sqlCode = "SELECT * FROM db_users WHERE userEmail = '$webUserEmail' AND userPassword = '$webUserPassword'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error ."</h4>");

                if($sqlQuery->num_rows != 0){
                    $webUserData = $sqlQuery->fetch_assoc();

                    $_SESSION["userId"] = $webUserData["userId"];
                    $_SESSION["userName"] = $webUserData["userName"];

                    header("Location: home.php");

                }else{
                    echo "<h4>Dados inseridos não estão cadastrados!</h4>";

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
        <title>Login - MyBookBase</title>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
    <body>
        <div class = "div00">
            <h2>MyBookBase</h2>
            <h3>Gerencie seus livros online</h3>
            <h4>Login</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "email" name = "inputEmail" placeholder = "Digite o seu email"><br><br>
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite sua senha"><br><br>
                <a href = "register.php"><button id = "button01" type = "button">Fazer cadastro</button></a>
                <input id = "button01" type = "submit" value = "Entrar">
            </form>
            <h4><a id = "loginHelp01" href = "mailto:thiagobittencourt112@rede.ulbra.br">Esqueceu a senha?</a></h4><br>
        </div>
    </body>
</html>