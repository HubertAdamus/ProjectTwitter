<?php
header ('Content-type: text/html; charset=utf-8');
require_once ("src/tweet.php");
require_once ("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    var_dump($_POST);
    echo "<br>";
    $newTweet = new Tweet();
    $newTweet->create($conn, $_POST["tweet"]);

    if($newTweet->getId() != -1){
        $_SESSION["user_id"]=$newTweet->getId();
        header ("Location: http://localhost/Exercise/Twitter/");
        die();
    }else{
        echo "Error during creating tweet.<br>";
    }
}

?>




<form method="post" action="#" id="usrform">
    <label>Wprowadź tweeta</label><br>
    <textarea name="tweet" form="usrform" placeholder="Enter Tweet here"></textarea><br>
    <input type="submit" value="Wyślij">
</form>

