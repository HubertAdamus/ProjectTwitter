<?php
header ('Content-type: text/html; charset=utf-8');
require_once ('src/tweet.php');
require_once ("conn.php");
session_start();


if($_SERVER["REQUEST_METHOD"] === 'POST') {
    var_dump($_POST);
    var_dump($_SESSION);
    $newTweet = new Tweet();
    $newTweet->createTweet($conn, $_SESSION["user_id"], $_POST["tweet"]);
}
?>

<hr>
<form method="post" action="#" style="padding: 20px">
    <label>CREATE NEW TWEET</label><br>
    <textarea name="tweet" placeholder="Enter tweet here"></textarea><br>
    <label></label><br>
    <input type="submit" value="Send">
</form>
<hr>