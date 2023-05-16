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
<html lang="pt-br">
    <head>
        <title>Biblioteca - MyBookBase</title>
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
            <h3>Biblioteca</h3>
            <hr><br>
            <a href = "addBook.php"><button id = "button01" type = "button">Adicionar livros</button></a>
            <a href = "modifyBook.php"><button id = "button01" type = "button">Modificar livros</button></a>
            <a href = "removeBook.php"><button id = "button01" type = "button">Remover livros</button></a><br><br><br>
            <form action = "" method = "POST">
                <input id = "input01" type = "text" name = "inputBookSearch" placeholder = "Digite o nome do livro">
                <input id = "button01" type = "submit" value = "Pesquisar">
            </form><br>
            <h4>Resultados</h4>
            <?php
                if(isset($_POST["inputBookSearch"])){
                    if(strlen($_POST["inputBookSearch"]) != 0 || $_POST["inputBookSearch"] != null){
                        $webBookSearch = $dbConnection->real_escape_string($_POST["inputBookSearch"]);

                        if(strlen($webBookSearch) == 1){
                            $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle LIKE '$webBookSearch%' ORDER BY bookTitle";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                            if($sqlQuery->num_rows != 0){
                                while($row = mysqli_fetch_assoc($sqlQuery)){
                                echo "<a href = 'showBook.php?id=" . $row["bookId"] . "' target = '_blank'><img src = '" . $row["bookImageLink"] . "' width = '200' height = '300'></a>";
    
                                }
                            }else{
                                echo "<h4>Não há resultados para: ' " . $webBookSearch . " '</h4>";
    
                            }

                        }else if(strlen($webBookSearch) > 1){
                            $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' AND bookTitle LIKE '%$webBookSearch%' ORDER BY bookTitle";
                            $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

                            if($sqlQuery->num_rows != 0){
                                while($row = mysqli_fetch_assoc($sqlQuery)){
                                echo "<a href = 'showBook.php?id=" . $row["bookId"] . "' target = '_blank'><img src = '" . $row["bookImageLink"] . "' width = '200' height = '300'></a>";
    
                                }
                            }else{
                                echo "<h4>Não há resultados para: ' " . $webBookSearch . " '</h4>";
    
                            }

                        }
                        
            
                    }else{
                        $sqlCode = "SELECT * FROM db_books WHERE bookOwnerId = '{$_SESSION['userId']}' ORDER BY bookTitle";
                        $sqlQuery = $dbConnection->query($sqlCode) or die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

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
            <br><br>
        </div>
    </body>
</html>