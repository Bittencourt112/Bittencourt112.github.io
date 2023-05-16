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
<html lang="en">
    <head>
        <title>Detalhes de livro - MyBookBase</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" type = "text/css" href= "style.css">
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
            <h3>Detalhes de livro</h3>
            <hr>
            <?php
                $sqlCode = "SELECT * FROM db_books WHERE bookId = '{$_GET['id']}'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                $bookData = $sqlQuery->fetch_assoc();

                echo "<h4>" . $bookData["bookTitle"] . "</h4>";
                echo "<img src = '" . $bookData["bookImageLink"] . "' width = '300' height = '400'>";
                echo "<h4>Autor da obra</h4>";
                echo "<p>" . $bookData["bookAuthor"] . ".</p>";
                echo "<h4>Sinopse</h4>";
                echo "<p>" . $bookData["bookSummary"] . "</p>";
                echo "<h4>Editora</h4>";
                echo "<p>" . $bookData["bookPublisher"] . ".</p>";
                echo "<h4>Data de publicação</h4>";
                echo "<p>" . $bookData["bookReleaseDate"] . ".</p>";
                echo "<a href = '" . $bookData["bookShopLink"] . "' target = '_blank'><button id = 'button01' type = 'button'>Comprar</button></a><br><br>";

                $dbConnection->close();
            
            ?>
        </div>
    </body>
</html>