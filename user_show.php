<?php
header ('Content-type: text/html; charset=utf-8');
include "header.php";

$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);

if (isset($_GET["user_id"]) == TRUE){
    $userToShow= new User();
    $userToShow->loadFromDB($conn, $_GET["user_id"]);

    $userToShow->showUser();
}else{
    $loggedUser->showUser();
}

include "footer.php";