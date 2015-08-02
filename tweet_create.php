<?php
if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $newTweet = new Tweet();
    $newTweet->createTweet($conn, $_SESSION["user_id"], $_POST["tweet"]);
}
?>
<hr>
<form method="post" action="#" style="padding: 20px">
    <label>CREATE NEW TWEET</label><br>
    <textarea name="tweet" placeholder="Enter tweet here"></textarea><br>
    <label></label><br>
    <input type="submit" value="Tweet">
</form>
<hr>