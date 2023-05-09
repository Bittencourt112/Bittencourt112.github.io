<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        die("<h4>Você não está logado no sistema!</h4><a href = 'login.php'><h4>Entre por aqui</h4></a>");
    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Ajuda - MyBookBase</title>
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
            <h3>Ajuda</h3>
            <hr>
            <h4>Algum problema?</h4>
            <p>Em caso de dificuldades com a plataforma ou precisar tirar alguma duvída a respeito de suas funcionalidades, aqui estão alguns meios para você realizar contato com o responsável.</p>
            <h4>Emails para entrar em contato</h4>
            <a href="mailto:thiagobittencourt112@gmail.com"><img src = "https://cdn-icons-png.flaticon.com/512/281/281769.png" width = "100" height = "100"></a>
            <a href="mailto:thiagobit5@outlook.com"><img src = "https://cdn-icons-png.flaticon.com/512/732/732223.png" width = "100" height = "100"></a>
            <a href="mailto:thiagobittencourt112@rede.ulbra.br"><img src = "https://seeklogo.com/images/U/ULBRA-logo-8262C7CDE1-seeklogo.com.png" width = "100" height = "100"></a><br><br>
        </div>
    </body>
</html>