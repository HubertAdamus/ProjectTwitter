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
    private $cration_date;
    private $text;

    public function __construct(){
        $this->id = -1;
        $this->user_id = -1;
        $this->creation_date = NULL;
        $this->text="";
    }

    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoadUser = "SELECT * FROM Tweets WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoadUser);

        if ($result->num_rows === 1){
            $userData = $result->fetch_assoc();

            $this->id = $userData["id"];
            $this->name = $userData["user_id"];
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
    public function getCrationDate()
    {
        return $this->cration_date;
    }
    public function setCrationDate($cration_date){
        $this->cration_date = $cration_date;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }





}