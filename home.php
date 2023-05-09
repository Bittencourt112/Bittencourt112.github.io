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
        <title>Início - MyBookBase</title>
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
            <h3>Início</h3>
            <hr>
            <h4>Introdução</h4>
            <p>MyBookBase serve como um sistema web de gerenciamento de livros, pode ser utilizado também para gerênciar grandes bibliotecas com vários usuários.</p>
            <h4>Recursos</h4>
            <ul>
                <li>Cadastro e login de usuários;</li>
                <li>Registro, atualização e remoção de livros;</li>
                <li>Listagem detalhada de obras;</li>
                <li>Redirecionamento para compras.</li>
            </ul><br>
        </div>
    </body>
</html>