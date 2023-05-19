<?php
    include("connect.php");
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["userId"])){
        header("Location: login.php");
    }

    $sucess = 0;

    if(isset($_POST["inputBookTitle"]) && isset($_POST["inputBookAuthor"]) && isset($_POST["inputBookSummary"]) && isset($_POST["inputBookPublisher"]) && isset($_POST["inputBookImageLink"]) && isset($_POST["inputBookShopLink"]) && isset($_POST["inputBookReleaseDate"]) && isset($_POST["inputOldBookTitle"])){
        if(strlen($_POST["inputOldBookTitle"]) > 3){
            $webOldBookTitle = $dbConnection->real_escape_string($_POST["inputOldBookTitle"]);

            $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
            $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

            if($sqlQuery->num_rows != 0){
                if(strlen($_POST["inputBookAuthor"]) != 0){
                    if(strlen($_POST["inputBookAuthor"]) > 7){
                        $webBookAuthor = $dbConnection->real_escape_string($_POST["inputBookAuthor"]);

                        $sqlCode = "UPDATE db_books SET bookAuthor = '$webBookAuthor' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Nome do autor precisa de ao menos 8 caracteres!');</script>";

                    }

                }

                if(strlen($_POST["inputBookSummary"]) != 0){
                    if(strlen($_POST["inputBookSummary"]) > 127){
                        $webBookSummary = $dbConnection->real_escape_string($_POST["inputBookSummary"]);

                        $sqlCode = "UPDATE db_books SET bookSummary = '$webBookSummary' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Sinopse precisa de ao menos 128 caracteres!');</script>";

                    }

                }

                if(strlen($_POST["inputBookPublisher"]) != 0){
                    if(strlen($_POST["inputBookPublisher"]) > 3){
                        $webBookPublisher = $dbConnection->real_escape_string($_POST["inputBookPublisher"]);

                        $sqlCode = "UPDATE db_books SET bookPublisher = '$webBookPublisher' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Nome da editora precisa de ao menos 4 caracteres!');</script>";

                    }

                }

                if(strlen($_POST["inputBookImageLink"]) != 0){
                    if(strlen($_POST["inputBookImageLink"]) > 15){
                        $webBookImageLink = $dbConnection->real_escape_string($_POST["inputBookImageLink"]);

                        $sqlCode = "UPDATE db_books SET bookImageLink = '$webBookImageLink' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Link de imagem precisa de ao menos 16 caracteres!');</script>";

                    }

                }

                if(strlen($_POST["inputBookShopLink"]) != 0){
                    if(strlen($_POST["inputBookShopLink"]) > 15){
                        $webBookShopLink = $dbConnection->real_escape_string($_POST["inputBookShopLink"]);

                        $sqlCode = "UPDATE db_books SET bookShopLink = '$webBookShopLink' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Link de compra precisa de ao menos 16 caracteres!');</script>";

                    }

                }

                if(strlen($_POST["inputBookReleaseDate"]) != 0){
                    if(strlen($_POST["inputBookReleaseDate"]) > 9){
                        $webBookReleaseDate = $dbConnection->real_escape_string($_POST["inputBookReleaseDate"]);

                        $sqlCode = "UPDATE db_books SET bookReleaseDate = '$webBookReleaseDate' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Data de publicação deve seguir o seguinte formato:\n01/01/2000');</script>";

                    }

                }

                if(strlen($_POST["inputBookTitle"]) != 0){
                    if(strlen($_POST["inputBookTitle"]) > 3){
                        $webBookTitle = $dbConnection->real_escape_string($_POST["inputBookTitle"]);

                        $sqlCode = "UPDATE db_books SET bookTitle = '$webBookTitle' WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle = '$webOldBookTitle'";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert('$dbConnection->error');</script>");

                        if(!$dbConnection->error){
                            $sucess++;

                        }

                    }else{
                        echo "<script type = 'text/javascript'>alert('Titulo precisa de ao menos 4 caracteres!');</script>";

                    }

                }

                if($sucess > 6){
                    echo "<script type = 'text/javascript'>alert('Alterações foram realizadas!');</script>";

                }

            }else{
                echo "<script type = 'text/javascript'>alert('Livro não foi encontrado para alteração!');</script>";

            }

        }else{
            echo "<script type = 'text/javascript'>alert('Titulo escolhido para alteração precisa de ao menos 4 caracteres!');</script>";

        }

    }

    $dbConnection->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Modificar livro - MyBookBase</title>
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
            <h3>Modificar livro</h3>
            <hr>
            <h4>Digite as novas informações nos campos</h4>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputBookTitle" placeholder = "Novo titulo"><br><br>
                <input id = "input01" type = "text" name = "inputBookAuthor" placeholder = "Novo autor"><br><br>
                <input id = "input01" type = "text" name = "inputBookSummary" placeholder = "Nova sinopse"><br><br>
                <input id = "input01" type = "text" name = "inputBookPublisher" placeholder = "Nova editora"><br><br>
                <input id = "input01" type = "text" name = "inputBookImageLink" placeholder = "Novo link para capa"><br><br>
                <input id = "input01" type = "text" name = "inputBookShopLink" placeholder = "Novo link para compra"><br><br>
                <input id = "input01" type = "text" name = "inputBookReleaseDate" placeholder = "Nova data: dd/mm/yyyy">
                <h4>Digite o titulo do livro que irá realizar alterações</h4>
                <input id = "input01" type = "text" name = "inputOldBookTitle" placeholder = "Titulo atual"><br><br>
                <a href = "library.php"><input id = "button01" type = "button" value = "Cancelar"></a>
                <input id = "button01" type = "submit" value = "Enviar">
            </form><br>
        </div>
    </body>
</html>