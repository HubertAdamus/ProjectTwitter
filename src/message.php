<?php
class Message{
    /*
CREATE TABLE Messages (
  id INT AUTO_INCREMENT,
  send_id INT,
  recive_id INT,
  subject VARCHAR (140),
  text VARCHAR (140),
  send_date DATETIME,
  open_date DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (send_id) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY (recive_id) REFERENCES Users(id) ON DELETE CASCADE
)
     */

    private $id;
    private $send_id;
    private $recive_id;
    private $subject;
    private $text;
    private $send_date;
    private $open_date;

    public function __construct(){
        $this->id= -1;
        $this->send_id= -1;
        $this->recive_id= -1;
        $this->subject= "";
        $this-> text="";
        $this->send_date="";
        $this->open_date="";
    }
    public function showMessage(){
        echo(
            "Message: ".$this->text. "<br>"
        );
    }
    public function updateMessage(mysqli $conn, $newText){
        $sqlUpdateMessage ="UPDATE Messages SET text='".$newText."' WHERE id=".$this->id;
        $result = $conn->query($sqlUpdateMessage);
        if ($result == TRUE) {
            $this->text = $conn->$newText;
        } else {
            echo "Error: " . $conn->error . "<br>";
        }
    }
    public function createMessage(mysqli $conn, $message){
        $sqlInsertMessage = " INSERT INTO Messages(text) VALUES ('" . $message . "')";
        $result = $conn->query($sqlInsertMessage);
        if ($result == TRUE) {
            $this->text = $conn->insert_id;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoMessage = "SELECT * FROM Messages WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoMessage);

        if ($result->num_rows === 1){
            $messageData = $result->fetch_assoc();

            $this->id = $messageData["id"];
            $this->send_id = $messageData["send_id"];
            $this->recive_id = $messageData["recive_id"];
            $this->text = $messageData["text"];
            $this->send_date = $messageData["send_date"];
            $this->open_date = $messageData["open_date"];
        }
    }





    public function getSendId()
    {
        return $this->send_id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getReciveId()
    {
        return $this->recive_id;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($text)
    {
        $this->text = $text;
    }
    public function getSendDate()
    {
        return $this->send_date;
    }
    public function setSendDate($send_date)
    {
        $this->send_date = $send_date;
    }
    public function getOpenDate(){
        return $this->open_date;
    }
    public function setOpenDate($open_date){
        $this->open_date = $open_date;
    }





}