<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "newsdesk_db";

$con = mysqli_connect($servername, $username, $password, $db);

if(mysqli_connect_error()){
    echo "failed";
}

?>
