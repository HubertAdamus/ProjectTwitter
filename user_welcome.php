<?php
$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);
echo "<h1>Witaj ".$loggedUser->getName()." </h1><br>";