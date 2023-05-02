<?php
$dbHost = "localhost";
$dbUserName = "root";
$dbPassword = "c9r7j5l4";
$dbName = "mybookbase";

$dbConnection = new mysqli($dbHost, $dbUserName, $dbPassword, $dbName);

if($dbConnection->error){
    die("<h4>Erro de conexão ao banco de dados: " . $dbConnection->error . "</h4>");

}

?>