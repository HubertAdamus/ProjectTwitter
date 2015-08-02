<?php
require_once "header.php";

$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);


/**
 * PREVENTING WRITING MESSAGE TO MYSELF
 */
if ($_GET["user_id"]==$_SESSION['user_id']){
    header("Location: http://localhost/ProjectTwitter/user_show.php");
}

if (isset($_GET["user_id"]) == TRUE){
    $userToShow= new User();
    $userToShow->loadFromDB($conn, $_GET["user_id"]);
    $userToShow->showUser();
    echo "<button><a href='message_create.php?receive_id=".$_GET['user_id']."'>MESSAGE</a></button>";
}else{
    $loggedUser->showUser();
    echo "<button><a href='user_delete.php'>DELETE USER</a></button>";
}


$retArrayId=$loggedUser->getAllTweetsFromId($conn,$_GET['user_id']);
foreach ($retArrayId as $tweet) {
    echo "<hr>";
    echo $tweet->showTweet();
    echo $tweet->generateLinkToMyTweet();
    $retComArray = $tweet->getAllComments($conn);
    foreach ($retComArray as $comment) {
        echo $comment->showUser($conn, $comment->getUserId());
        echo $comment->showComment();
    }
}
require_once "footer.php";