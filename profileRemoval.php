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
        <title>Remover dados - MyBookBase</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
    <body>
        <div class = "div01">
            <div class = "divTable">
                <table>
                    <tr>
                        <td id = "mainTd">MyBookBase</td>
                        <td><a id = "menuTd" href = "home.php">Início</a></td>
                        <td><a id = "menuTd" href = "library.php">Biblioteca</a></td>
                        <td><a id = "menuTd" href = "profile.php">Perfil</a></td>
                        <td><a id = "menuTd" href = "support.php">Ajuda</a></td>
                        <td><a id = "menuTd" href = "logout.php">Sair</a></td>
                    </tr>
                </table>
            </div>
            <h4>Olá, <?php echo $_SESSION["userName"];?>!</h4>
            <hr>
            <h3>Remover dados</h3>
            <hr>
            <h4>Tem certeza que deseja apagar sua conta?</h4>
            <form action = "" method= "POST">
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite a senha atual"><br><br>
                <a href = "profile.php"><button id = "button01" type = "button">Cancelar</button></a>
                <input id = "button01" type = "submit" value = "Confirmar">
            </form><br>
        </div>
    </body>
</html>