<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        header("Location: login.php");
    }

    if(isset($_POST["inputBookTitle"])){
        if(strlen($_POST["inputBookTitle"]) != 0){
            if(strlen($_POST["inputBookTitle"]) > 3){
                $webBookTitle = $dbConnection->real_escape_string($_POST["inputBookTitle"]);

                $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webBookTitle'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                if($sqlQuery->num_rows != 0){
                    $sqlCode = "DELETE FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webBookTitle'";
                    $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script");

                    if(!$dbConnection->error){
                        echo "<script type = 'text/javascript'>alert('Livro removido da biblioteca!');</script>";

                    }

                }else{
                    echo "<script type = 'text/javascript'>alert('Livro não foi encontrado na biblioteca!');</script>";

                }

            }else{
                echo "<script type = 'text/javascript'>alert('Titulo precisa de ao menos 4 caracteres!');</script>";

            }

        }else{
            echo "<script type = 'text/javascript'>alert('Preencha o campo de titulo para poder identificá-lo!');</script>";

        }

    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Remover livro - MyBookBase</title>
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
            <h3>Remover livro</h3>
            <hr>
            <h4>Digite o titulo do livro que deseja remover</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputBookTitle" placeholder = "Titulo do livro"><br><br>
                <a href = "library.php"><input id = "button01" type = "button" value = "Cancelar"></a>
                <input id = "button01" type = "submit" value = "Confirmar">
            </form><br>
        </div>
    </body>
</html>