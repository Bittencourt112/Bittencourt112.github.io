<?php
    include("connect.php");

    if(!isset($_SESSION)){
        session_start();
    }else{
        session_destroy();
        session_start();
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
            <h4>Recuperação de conta</h4>
            <p>Caso encontre problemas de acesso a sua conta cadastrada ou algo relacionado, siga as intruções abaixo:</p>
            <ul>
                <li>Entre em contato com o seguinte <a href = "mailto:thiagobittencourt112@rede.ulbra.br" target = "_blank"><b>email</b></a> disponibilizado;</li>
                <li>Repasse o seu endereço de email e telefone utilizados no cadastro da conta em questão;</li>
                <li>Explique a sua situação no email disponibilizado e então aguarde pelo retorno do responsavél.</li>
            </ul>
            <a href = "login.php"><button id = "button01" type = "button">Voltar</button></a><br><br>
        </div>
    </body>
</html>