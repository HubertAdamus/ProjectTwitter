<?php
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



    //TODO Messages connection
    public function getAllComments()
    {

    }



    public function showTweet()
    {
        echo(
          "Tweet: ".$this->text. "<br>"
        );
    }
    public function updateTweet(mysqli $conn, $newText){
        $sqlUpdateTweet ="UPDATE Tweets SET text='".$newText."' WHERE id=".$this->id;
        $result = $conn->query($sqlUpdateTweet);
        if ($result == TRUE) {
            $this->text = $conn->$newText;
        } else {
            echo "Error: " . $conn->error . "<br>";
        }
    }
    public function createTweet(mysqli $conn, $user_id, $tweet){
        $sqlInsertTweets = " INSERT INTO Tweets(user_id, text) VALUES ('" . $user_id . "','" . $tweet . "')";
        $result = $conn->query($sqlInsertTweets);
        if ($result == TRUE) {
            $this->id = $conn->insert_id;
            $this->user_id = $user_id;
            //$this->creation_date = $date; TODO Date
            $this->text = $tweet;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoadTweet = "SELECT * FROM Tweets WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoadTweet);

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
    public function setCreationDate($creation_date){
        $this->creation_date = $creation_date;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }
}