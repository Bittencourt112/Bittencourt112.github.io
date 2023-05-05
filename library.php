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
        <title>Biblioteca - MyBookBase</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
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
            <h3>Sua biblioteca</h3>
            <a href = "addBook.php"><button id = "button01" type = "button">Adicionar livro</button></a>
            <a href = "modifyBook.php"><button id = "button01" type = "button">Modificar livro</button></a>
            <a href = "removeBook.php"><button id = "button01" type = "button">Remover livro</button></a><br><br><br>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputBookSearch" placeholder = "Digite o nome do livro">
                <input id = "button01" type = "submit" value = "Pesquisar">
            </form><br>
            <hr>
            <?php
                if(isset($_POST["inputBookSearch"])){
                    if(strlen($_POST["inputBookSearch"]) != 0 || $_POST["inputBookSearch"] != null){
                        $webBookSearch = $dbConnection->real_escape_string($_POST["inputBookSearch"]);

                        if(strlen($webBookSearch) == 1){
                            $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle LIKE '$webBookSearch%' ORDER BY bookTitle";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                            if($sqlQuery->num_rows != 0){
                                while($row = mysqli_fetch_assoc($sqlQuery)){
                                echo "<a href = 'showBook.php?id=" . $row["bookId"] . "'><img src = '" . $row["bookImageLink"] . "' width = '200' height = '300'></a>";
    
                                }
                            }else{
                                echo "<h4>Não há resultados para: ' " . $webBookSearch . " '</h4>";
    
                            }

                        }else if(strlen($webBookSearch) > 1){
                            $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle LIKE '%$webBookSearch%' ORDER BY bookTitle";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                            if($sqlQuery->num_rows != 0){
                                while($row = mysqli_fetch_assoc($sqlQuery)){
                                echo "<a href = 'showBook.php?id=" . $row["bookId"] . "'><img src = '" . $row["bookImageLink"] . "' width = '200' height = '300'></a>";
    
                                }
                            }else{
                                echo "<h4>Não há resultados para: ' " . $webBookSearch . " '</h4>";
    
                            }

                        }
                        
            
                    }else{
                        $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' ORDER BY bookTitle";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<h4>Falha na execução do código SQL: " . $dbConnection->error . "</h4>");

                        if($sqlQuery->num_rows != 0){
                            while($row = mysqli_fetch_assoc($sqlQuery)){
                                echo "<a href = 'showBook.php?id=" . $row["bookId"] . "' target = '_blank'><img src = '" . $row["bookImageLink"] . "' width = '200' height = '300'></a>";

                            }
                        }else{
                            echo "<h4>Não há livros!</h4>";

                        }
            
                    }
            
                }

                $dbConnection->close();
                
            ?>
            <br>
        </div>
    </body>
</html>