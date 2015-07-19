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

    public function getAllComments(){
        //TODO Messages connection
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
    public function create(mysqli $conn, $tweet){
        $sqlInsertTweets = " INSERT INTO Tweets(text) VALUES ('" . $tweet . "')";
        $result = $conn->query($sqlInsertTweets);
        if ($result == TRUE) {
            $this->text = $conn->insert_id;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoadTweet = "SELECT * FROM Tweets WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoadTweet);

        if ($result->num_rows === 1){
            $userData = $result->fetch_assoc();

            $this->id = $userData["id"];
            $this->user_id = $userData["user_id"];
            $this->creation_date = $userData["creation_date"];
            $this->text = $userData["text"];
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