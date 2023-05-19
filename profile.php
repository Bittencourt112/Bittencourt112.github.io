<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        header("Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Seus dados - MyBookBase</title>
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
            <h3>Seus dados</h3>
            <hr>
                <?php
                    $sqlCode = "SELECT * FROM db_users WHERE userId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");
                   
                    $userData = $sqlQuery->fetch_assoc();

                    echo "<h4>Seu nome de usuário</h4>";
                    echo "<p>" . $userData["userName"] . ".</p>";
                    echo "<h4>Seu número de telefone</h4>";
                    echo "<p>" . $userData["userPhoneNumber"] . ".</p>";
                    echo "<h4>Seu endereço de email</h4>";
                    echo "<p>" . $userData["userEmail"] . ".</p>";

                    $dbConnection->close();

                ?>
            <a href = "profileModify.php"><button id = "button01" type = "button">Mudar dados</button></a>
            <a href = "profileRemoval.php"><button id = "button01" type = "button">Excluir conta</button></a><br><br>
        </div>
    </body>
</html>