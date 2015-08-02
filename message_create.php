<?php
include_once "header.php";
if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $newTweet = new Message();
    $newTweet->createMessage($conn, $_SESSION["user_id"],$_GET['receive_id'], $_POST["subject"], $_POST["message"]);
    header("Location: http://localhost/ProjectTwitter/message_show.php");
}
?>
<hr>
<form method="post" action="#" style="padding: 20px">
    <label>CREATE NEW MESSAGE</label><br>
    <label></label><br>
    <input name="subject" placeholder="Enter Subject"/><br>
    <label></label><br>
    <textarea name="message" placeholder="Enter tweet here"></textarea><br>
    <label></label><br>
    <input type="submit" value="MESSAGE">
</form>
<hr>