<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        die("<h4>Você não está logado no sistema!</h4><a href = 'login.php'><h4>Entre por aqui</h4></a>");
    }

    $sucess = 0;

    if(isset($_POST["inputNewName"]) && isset($_POST["inputNewPhoneNumber"]) && isset($_POST["inputNewEmail"]) && isset($_POST["inputNewPassword"]) && isset($_POST["inputPassword"])){
        if(strlen($_POST["inputPassword"]) > 7){
            $webUserPassword = $dbConnection->real_escape_string($_POST["inputPassword"]);
            $webUserPassword = hash("sha512", $webUserPassword);

            $sqlCode = "SELECT * FROM db_users WHERE userId = '{$_SESSION['userId']}' AND userPassword = '$webUserPassword'";
            $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

            if($sqlQuery->num_rows != 0){
                if(strlen($_POST["inputNewName"]) != 0){
                    if(strlen($_POST["inputNewName"]) > 7){
                    $webUserNewName = $dbConnection->real_escape_string($_POST["inputNewName"]);

                    $sqlCode = "UPDATE db_users SET userName = '$webUserNewName' WHERE userId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                    $sqlCode = "SELECT * FROM db_users WHERE userId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                    if(!$dbConnection->error){
                        $webUserData = $sqlQuery->fetch_assoc();

                        $_SESSION["userName"] = $webUserData["userName"];

                        $sucess++;

                    }

                    }else{
                        echo "<h4>Nome inserido é muito pequeno!<h4>";
                    }

                }

                if(strlen($_POST["inputNewPhoneNumber"]) != 0){
                    if(strlen($_POST["inputNewPhoneNumber"]) > 8){
                        $webUserNewPhoneNumber = $dbConnection->real_escape_string($_POST["inputNewPhoneNumber"]);

                        $sqlCode = "SELECT * FROM db_users WHERE userPhoneNumber = '$webUserNewPhoneNumber'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                        if($sqlQuery->num_rows == 0){
                            $sqlCode = "UPDATE db_users SET userPhoneNumber = '$webUserNewPhoneNumber' WHERE userId = '{$_SESSION['userId']}'";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                            if(!$dbConnection->error){
                                $sucess++;

                            }

                        }else{
                            echo "<h4>Telefone inserido já cadastrado!<h4>";

                        }

                    }else{
                        echo "<h4>Telefone inserido é muito pequeno!<h4>";

                    }

                }

                if(strlen($_POST["inputNewEmail"]) != 0){
                    if(strlen($_POST["inputNewEmail"]) > 9){
                        $webUserNewEmail = $dbConnection->real_escape_string($_POST["inputNewEmail"]);

                        $sqlCode = "SELECT * FROM db_users WHERE userEmail = '$webUserNewEmail'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");
                
                        if($sqlQuery->num_rows == 0){
                            $sqlCode = "UPDATE db_users SET userEmail = '$webUserNewEmail' WHERE userId = '{$_SESSION['userId']}'";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                            if(!$dbConnection->error){
                                $sucess++;

                            }

                        }else{
                            echo "<h4>Email inserido já cadastrado!<h4>";

                        }

                    }else{
                        echo "<h4>Email inserido é muito pequeno!<h4>";

                    }

                }

                if(strlen($_POST["inputNewPassword"]) != 0){
                    if(strlen($_POST["inputNewPassword"]) > 7){
                        $webUserNewPassword = $dbConnection->real_escape_string($_POST["inputNewPassword"]);
                        $webUserNewPassword = hash("sha512", $webUserNewPassword);

                        $sqlCode = "UPDATE db_users SET userPassword = '$webUserNewPassword' WHERE userId = '{$_SESSION['userId']}'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<h4>Nova senha é muito pequena!<h4>";

                    }

                }

                if($sucess > 0){
                    echo "<h4>Alterações realizadas com sucesso!<h4>";

                }

            }else{
                echo "<h4>Senha atual incorreta! Alterações foram canceladas.<h4>";

            }

        }else{
            echo "<h4>Preencha o campo de senha atual para realizar alterações!<h4>";

        }

    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Modificar dados - MyBookBase</title>
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
            <h3>Modificar dados</h3>
            <hr>
            <h4>Preencha com novas informações somente os campos que deseja atualizar</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputNewName" placeholder = "Novo nome"><br><br>
                <input id = "input01" type = "number" name = "inputNewPhoneNumber" placeholder = "Novo telefone"><br><br> 
                <input id = "input01" type = "email" name = "inputNewEmail" placeholder = "Novo email"><br><br>  
                <input id = "input01" type = "password" name = "inputNewPassword" placeholder = "Nova senha"><br><br>
                <input id = "input01" type = "password" name = "inputPassword" placeholder = "Digite a senha atual"><br><br>
                <a href = "profile.php"><button id = "button01" type = "button">Cancelar</button></a>
                <input id = "button01" type = "submit" value = "Enviar">           
            </form><br>
        </div>
    </body>
</html>