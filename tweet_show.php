<?php
echo "<hr>";
echo "Tweets created by ".$loggedUser->getName()." : <br>";


$retArray=$loggedUser->getAllTweets($conn,3);

foreach ($retArray as $tweet ) {
    //TODO Jak zrobić aby showTweet było widoczne
     echo ($tweet->showTweet());
};






