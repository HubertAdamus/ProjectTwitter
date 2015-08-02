<?php
echo "<br><strong>Tweets created by others: </strong><br>";

$retArrayAll=$loggedUser->getEverybodyTweets($conn,40);
foreach ($retArrayAll as $tweet ) {
    echo "<hr>";
    echo $tweet->showTweet();
    echo $tweet->generateLinkToMyTweet();
    $retComArray=$tweet->getAllComments($conn);
    foreach ($retComArray as $comment){
        echo $comment->showUser($conn, $comment->getUserId());
        echo $comment->showComment();
    }
};
