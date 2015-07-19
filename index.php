<?php
include "header.php";
echo "Działa";

$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);

echo "<h1>Witaj ".$loggedUser->getName()." </h1><br>";
echo "Moje Tweety:";
$tweets = $loggedUser->getAllPosts($conn, 40);
foreach ($retArray as $tweet ) {
    //TODO:
    echo "<br>";
    echo ($tweet->showTweet());
}

include "footer.php";
?>


















