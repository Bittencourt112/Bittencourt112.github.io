<?php
$dbHost = "localhost";
$dbUserName = "root";
$dbPassword = "c9r7j5l4";
$dbName = "mybookbase";

$dbConnection = new mysqli($dbHost, $dbUserName, $dbPassword, $dbName);

if($dbConnection->error){
    die("<script type = 'text/javascript'>alert($dbConnection->error);</script>");

}

?>