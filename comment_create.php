<?php
require_once "header.php";

if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $newComment = new Comment();
    $newComment->createComment($conn, $_SESSION["user_id"], $_GET["tweet_id"], $_POST["comment"]);
    header("Location: http://localhost/ProjectTwitter/index.php");
}
?>

<hr>
<form method="post" action="#" style="padding: 20px">
    <textarea name="comment" placeholder="Enter comment here"></textarea><br>
    <label></label><br>
    <input type="submit" value="Comment">
</form>
<hr>