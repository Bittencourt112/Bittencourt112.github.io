<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        die("<h4>Você não está logado no sistema!</h4><a href = 'login.php'><h4>Entre por aqui</h4></a>");
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
            <h2>MyBookBase</h2>
            <a href = "home.php"><button id = "button01" type = "button">Início</button></a>
            <a href = "library.php"><button id = "button01" type = "button">Biblioteca</button></a>
            <a href = "profile.php"><button id = "button01" type = "button">Perfil</button></a>
            <a href = "support.php"><button id = "button01" type = "button">Ajuda</button></a>
            <a href = "logout.php"><button id = "button01" type = "button">Sair</button></a>
            <h4>Bem vindo, <?php echo $_SESSION["userName"];?>!</h4><br>
            <hr>
            <h3>Seus dados</h3>
            <hr>
                <?php
                    $sqlCode = "SELECT * FROM db_users WHERE userId = '{$_SESSION['userId']}'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");
                   
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