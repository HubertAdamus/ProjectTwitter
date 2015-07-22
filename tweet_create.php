<?php

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    var_dump($_POST);
    echo "<br>";
    $newTweet = new Tweet();
    $newTweet->createTweet($conn, $_POST["tweet"]);

    if($newTweet->getId() != -1){
        $_SESSION["user_id"]=$newTweet->getId();
        die();
    }else{
        echo "Error during creating tweet.<br>";
    }
}
?>


<form method="post" action="#" style="padding: 20px"/>
    <label></label><br>
    <textarea name="tweet" form="usrform" placeholder="Enter tweet here"></textarea><br>
    <label</label><br>
    <input type="submit" value="Send">
</form>

