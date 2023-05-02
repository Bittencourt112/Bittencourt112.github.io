<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        die("<h4>Você não está logado no sistema!</h4><a href = 'login.php'><h4>Entre por aqui</h4></a>");
    }

    if(isset($_POST["inputPassword"])){
        if(strlen($_POST["inputPassword"]) != 0){
            if(strlen($_POST["inputPassword"]) > 7){
                $webUserPassword = $dbConnection->real_escape_string($_POST["inputPassword"]);
                $webUserPassword = hash("sha512", $webUserPassword);
    
                $sqlCode = "SELECT * FROM db_users WHERE userId = '{$_SESSION['userId']}' AND userPassword = '$webUserPassword'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");
    
                if($sqlQuery->num_rows != 0){
                    $sqlCode = "DELETE FROM db_users WHERE userId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");
    
                    $sqlCode = "DELETE FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");
    
                    if(!$dbConnection->error){
                        header("Location: logout.php");
    
                    }
    
                }else{
                    echo "<h4>Senha incorreta!</h4>";
    
                }
    
            }else{
                echo "<h4>Senha inserida é muito pequena!</h4>";
    
            }

        }else{
            echo "<h4>Preencha o campo!</h4>";

        }

    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Remover perfil - MyBookBase</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
    <body>
        <div class = "div02">
            <h1>MyBookBase</h1>
            <a href = "home.php"><button id = "button01" type = "button">Inicio</button></a>
            <a href = "library.php"><button id = "button01" type = "button">Biblioteca</button></a>
            <a href = "profile.php"><button id = "button01" type = "button">Perfil</button></a>
            <a href = "support.php"><button id = "button01" type = "button">Ajuda</button></a>
            <a href = "logout.php"><button id = "button01" type = "button">Sair</button></a>
            <h4>Bem vindo, <?php echo $_SESSION["userName"];?>!</h4><br>
            <hr>
            <h3>Seus dados</h3>
            <h4>Tem certeza que deseja apagar sua conta?</h4>
            <form action = "" method= "POST">
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite a senha atual"><br><br>
                <a href = "profile.php"><button id = "button01" type = "button">Cancelar</button></a>
                <input id = "button01" type = "submit" value = "Confirmar">
            </form><br>
        </div>
    </body>
</html>