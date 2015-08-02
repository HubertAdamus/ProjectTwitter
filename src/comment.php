<?php
include_once "user.php";
class Comment{
    /*
CREATE TABLE Comments(
  id INT AUTO_INCREMENT,
  user_id INT,
  tweet_id INT,
  text VARCHAR (140),
  creation_date DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY (tweet_id) REFERENCES Tweet(id) ON DELETE CASCADE)
     */
    private $id;
    private $user_id;
    private $tweet_id;
    private $text;
    private $creation_date;

    public function __construct(){
        $this->id = -1;
        $this->user_id= -1;
        $this->tweet_id= -1;
        $this->text="";
        $this->creation_date;
    }


    public function showCommentUser(mysqli $conn, $userId)
    {
        $name = new User();
        $name->loadFromDB($conn, $userId);
        echo (
            "<a href='http://localhost/ProjectTwitter/user_show.php?user_id=" . $userId . "'>" .$name->getName(). "</a> "
        );
    }


    public function showComment(){
        echo(
            $this->text. "<br>"
        );
    }
    public function updateComment(mysqli $conn, $newText){
        $sqlUpdateComment ="UPDATE Comments SET text='".$newText."' WHERE id=".$this->id;
        $result = $conn->query($sqlUpdateComment);
        if ($result == TRUE) {
            $this->text = $conn->$newText;
        } else {
            echo "Error: " . $conn->error . "<br>";
        }
    }


    public function createComment(mysqli $conn, $user_id, $tweet_id, $comment){
        $sql = " INSERT INTO Comments(user_id, tweet_id, text) VALUES ('" . $user_id . "','" . $tweet_id . "','" . $comment . "')";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            $this->text = $conn->insert_id;
            $this->user_id = $user_id;
            $this->tweet_id = $tweet_id;
            $this->text = $comment;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoadComment = "SELECT * FROM Comments WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoadComment);

        if ($result->num_rows === 1){
            $commentData = $result->fetch_assoc();

            $this->id = $commentData["id"];
            $this->user_id = $commentData["user_id"];
            $this->tweet_id = $commentData["tweet_id"];
            $this->creation_date = $commentData["creation_date"];
            $this->text = $commentData["text"];
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
    public function getTweetId()
    {
        return $this->tweet_id;
    }
    public function setTweetId($tweet_id)
    {
        $this->tweet_id = $tweet_id;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($text)
    {
        $this->text = $text;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }


}