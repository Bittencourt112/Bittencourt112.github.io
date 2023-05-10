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
            <h3>Ajuda</h3>
            <hr>
            <h4>Algum problema?</h4>
            <p>Em caso de dificuldades com a plataforma ou precisar tirar alguma duvída a respeito de suas funcionalidades, siga as intruções abaixo:</p>
            <ul>
                <li>Entre em contato com o seguinte <a href = "mailto:thiagobittencourt112@rede.ulbra.br" target = "_blank"><b>email</b></a> disponibilizado;</li>
                <li>Repasse o seu endereço de email e telefone utilizados no cadastro da conta em questão;</li>
                <li>Explique a sua situação no email e então aguarde pelo retorno do responsavél.</li>
            </ul><br>
        </div>
    </body>
</html>