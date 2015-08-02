<?php
echo "<hr>";
echo "<strong>Tweets created by ".$loggedUser->getName()." :</strong> <br>";

$retArrayUser=$loggedUser->getAllTweets($conn,5);
foreach ($retArrayUser as $tweet) {
    echo "<hr>";
    echo $tweet->showTweet();
    echo $tweet->generateLinkToMyTweet();
    $retComArray=$tweet->getAllComments($conn);
    foreach ($retComArray as $comment){
        echo $comment->showCommentUser($conn, $comment->getUserId());
        echo $comment->showComment();
    }
};



