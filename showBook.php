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
<html lang="en">
    <head>
        <title>Detalhes de livro - MyBookBase</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" type = "text/css" href= "style.css">
    </head>
    <body>
        <div class = "div02">
            <h1>MyBookBase</h1>
            <a href = "home.php"><button id = "button01" type = "button">Inicio</button></a>
            <a href = "library.php"><button id = "button01" type = "button">Biblioteca</button></a>
            <a href = "profile.php"><button id = "button01" type = "button">Perfil</button></a>
            <a href = "support.php"><button id = "button01" type = "button">Ajuda</button></a>
            <a href = "logout.php"><button id = "button01" type = "button">Sair</button></a>
            <h4>Bem vindo, <?php echo $_SESSION["userName"];?>!</h4><br>
            <hr>
            <h3>Detalhes do livro</h3>
            <?php
                $sqlCode = "SELECT * FROM db_books WHERE bookId = '{$_GET['id']}'";
                $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

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