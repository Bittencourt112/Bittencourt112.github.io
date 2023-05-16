<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        header("Location: login.php");
    }

    $sucess = 0;

    if(isset($_POST["inputBookTitle"]) && isset($_POST["inputBookAuthor"]) && isset($_POST["inputBookSummary"]) && isset($_POST["inputBookPublisher"]) && isset($_POST["inputBookImageLink"]) && isset($_POST["inputBookShopLink"]) && isset($_POST["inputBookReleaseDate"])){
        if(strlen($_POST["inputBookTitle"]) != 0 && strlen($_POST["inputBookAuthor"]) != 0 && strlen($_POST["inputBookSummary"]) != 0 && strlen($_POST["inputBookPublisher"]) != 0 && strlen($_POST["inputBookImageLink"]) != 0 && strlen($_POST["inputBookShopLink"]) != 0 && strlen($_POST["inputBookReleaseDate"]) != 0){
            if(strlen($_POST["inputBookTitle"]) > 3){
                $webBookTitle = $dbConnection->real_escape_string($_POST["inputBookTitle"]);
                
                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Titulo precisa de ao menos 4 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookAuthor"]) > 7){
                $webBookAuthor = $dbConnection->real_escape_string($_POST["inputBookAuthor"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Nome do autor precisa de ao menos 8 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookSummary"]) > 127){
                $webBookSummary = $dbConnection->real_escape_string($_POST["inputBookSummary"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Sinopse precisa de ao menos 128 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookPublisher"]) > 3){
                $webBookPublisher = $dbConnection->real_escape_string($_POST["inputBookPublisher"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Nome da editora precisa de ao menos 4 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookImageLink"]) > 15){
                $webBookImageLink = $dbConnection->real_escape_string($_POST["inputBookImageLink"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Link da imagem precisa de ao menos 16 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookShopLink"]) > 15){
                $webBookShopLink = $dbConnection->real_escape_string($_POST["inputBookShopLink"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Link de compra precisa de ao menos 16 caracteres!');</script>";

            }

            if(strlen($_POST["inputBookReleaseDate"]) > 9){
                $webBookReleaseDate = $dbConnection->real_escape_string($_POST["inputBookReleaseDate"]);

                $sucess++;

            }else{
                echo "<script type = 'text/javascript'>alert('Data de publicação deve seguir o seguinte formato: 01/01/2000');</script>";

            }

            if($sucess > 6){
                $sqlCode = "INSERT INTO db_books (bookTitle, bookAuthor, bookSummary, bookReleaseDate, bookPublisher, bookImageLink, bookShopLink, bookOwnerId) VALUES ('$webBookTitle', '$webBookAuthor', '$webBookSummary', '$webBookReleaseDate', '$webBookPublisher', '$webBookImageLink', '$webBookShopLink', '{$_SESSION['userId']}')";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                if(!$dbConnection->error){
                    echo "<script type = 'text/javascript'>alert('Livro inserido na biblioteca!');</script>";

                }

            }

        }else{
            echo "<script type = 'text/javascript'>alert('Preencha todos os campos!');</script>";

        }

    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Adicionar livro - MyBookBase</title>
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
            <h3>Adicionar livro</h3>
            <hr>
            <h4>Preencha os campos com informações do novo livro</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputBookTitle" placeholder = "Titulo"><br><br>
                <input id = "input01" type = "text" name = "inputBookAuthor" placeholder = "Autor"><br><br>
                <input id = "input01" type = "text" name = "inputBookSummary" placeholder = "Sinopse"><br><br>
                <input id = "input01" type = "text" name = "inputBookPublisher" placeholder = "Editora"><br><br>
                <input id = "input01" type = "text" name = "inputBookImageLink" placeholder = "Link para capa"><br><br>
                <input id = "input01" type = "text" name = "inputBookShopLink" placeholder = "Link para compra"><br><br>
                <input id = "input01" type = "text" name = "inputBookReleaseDate" placeholder = "Data: dd/mm/yyyy"><br><br>
                <a href = "library.php"><input id = "button01" type = "button" value = "Voltar"></a>
                <input id = "button01" type = "submit" value = "Enviar">
            </form><br>
        </div>
    </body>
</html>