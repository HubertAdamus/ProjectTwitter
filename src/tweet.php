<?php
include_once "comment.php";
class Tweet{
    /*
CREATE TABLE Tweets (
  id INT AUTO_INCREMENT,
  user_id INT,
  creation_date DATETIME,
  text VARCHAR (140),
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
)
      */

    private $id;
    private $user_id;
    private $creation_date;
    private $text;

    public function __construct(){
        $this->id = -1;
        $this->user_id = -1;
        $this->creation_date = NULL;
        $this->text="";
    }
    public function generateLinkToMyTweet()
    {
        return "<a href='http://localhost/ProjectTwitter/comment_create.php?tweet_id=" . $this->id . "'>Comment</a><br>";
    }


    public function getAllComments(mysqli $conn)
    {
        $sql = "SELECT * FROM Comments WHERE tweet_id = '".$this->id."'ORDER BY creation_date DESC";
        $result = $conn->query($sql);
        $retComArray = array();
        if($result->num_rows > 0){
            while($commentData = $result->fetch_assoc()) {
                $tempComment = new Comment();
                $tempComment->loadFromDB($conn, $commentData['id']);
                $retComArray[] = $tempComment;
            }
        }
        return $retComArray;
    }

    public function showTweet()
    {
        echo(
            "<a href='http://localhost/ProjectTwitter/tweet_info.php?user_id=". $this->user_id ."&creation_date=".$this->creation_date."&text=" .$this->text. "'>Tweet info: </a>
            <p>".$this->text."</p>"
        );
    }
    public function updateTweet(mysqli $conn, $newText)
    {
        $newText = $conn->real_escape_string($newText);
        $sql ="UPDATE Tweets SET text='".$newText."' WHERE id=".$this->id;
        $result = $conn->query($sql);
        if ($result == TRUE) {
            $this->text = $conn->$newText;
        } else {
            echo "Error: " . $conn->error . "<br>";
        }
    }
    public function createTweet(mysqli $conn, $user_id, $tweet)
    {
        $tweet = $conn->real_escape_string($tweet);
        $sql = " INSERT INTO Tweets(user_id, text) VALUES ('" . $user_id . "','" . $tweet . "')";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            $this->id = $conn->insert_id;
            $this->user_id = $user_id;
            $this->text = $tweet;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sql = "SELECT * FROM Tweets WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1){
            $tweetData = $result->fetch_assoc();

            $this->id = $tweetData["id"];
            $this->user_id = $tweetData["user_id"];
            $this->creation_date = $tweetData["creation_date"];
            $this->text = $tweetData["text"];
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }
}