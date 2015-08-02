<?php
class Message{
    /*
CREATE TABLE Messages (
  id INT AUTO_INCREMENT,
  send_id INT,
  receive_id INT,
  subject VARCHAR (140),
  text VARCHAR (140),
  send_date DATETIME,
  open_date DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (send_id) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY (receive_id) REFERENCES Users(id) ON DELETE CASCADE
)
     */

    private $id;
    private $send_id;
    private $receive_id;
    private $subject;
    private $text;
    private $send_date;
    private $open_date;
    private $new_message;

    public function __construct(){
        $this->id= -1;
        $this->send_id= -1;
        $this->receive_id= -1;
        $this->subject= "";
        $this-> text="";
        $this->send_date="";
        $this->open_date= "";
        $this->new_message= 0;
    }
    public function openTime(mysqli $conn,$id){
        $sql = " UPDATE Messages SET open_date=NOW() WHERE id=".$id;
        $conn->query($sql);
    }

    public function messageRead(mysqli $conn, $id, $new_message){
        $sql = " UPDATE Messages SET new_message='" . $new_message . "' WHERE id=".$id;
        $result = $conn->query($sql);
        if ($result == TRUE) {
            $this->new_message = $conn->$new_message;
        }else {
            echo "Error: " . $conn->error . "<br>";
        }
    }

    public function checkIfNew()
    {
        if($this->new_message==0){
            echo "<span style='color: red'>NEW MESSAGE</span><br>";
        }elseif($this->new_message==1){
            echo "<span style='color: green'>MESSAGE READ <br>".$this->open_date."</span><br>";
        }
    }
    
    public function showMessageUser(mysqli $conn, $userId)
    {
        $name = new User();
        $name->loadFromDB($conn, $userId);
        echo (
            "<a href='http://localhost/ProjectTwitter/user_show.php?user_id=" . $userId . "'>" .$name->getName(). "</a> "
        );
    }


    public function showMessage(){
        $short = substr($this->text, 0,30);
        echo(
            "Subject: ".$this->subject."<br>
            <p>Open message: <a href='http://localhost/ProjectTwitter/message_show_new.php?id=" . $this->id . "&text=".$this->text."&new_message=1'>".$short. "...<br></a></p>

            Date: ".$this->send_date."<br>"
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
    public function createMessage(mysqli $conn, $send_id, $receive_id, $subject, $text){
        $sqlInsertMessage = " INSERT INTO Messages(send_id, receive_id, subject, text) VALUES ('" . $send_id . "','" . $receive_id . "','" . $subject . "','" . $text . "')";
        $result = $conn->query($sqlInsertMessage);
        if ($result == TRUE) {
            $this->text = $conn->insert_id;
            $this->send_id = $send_id;
            $this->receive_id = $receive_id;
            $this->subject = $subject;
            $this->text = $text;
        }
    }
    public function loadFromDB(mysqli $conn, $idToLoad){
        $sqlLoMessage = "SELECT * FROM Messages WHERE id= '" .$idToLoad . "'";
        $result = $conn->query($sqlLoMessage);

        if ($result->num_rows === 1){
            $messageData = $result->fetch_assoc();

            $this->id = $messageData["id"];
            $this->send_id = $messageData["send_id"];
            $this->receive_id = $messageData["receive_id"];
            $this->text = $messageData["text"];
            $this->subject = $messageData["subject"];
            $this->send_date = $messageData["send_date"];
            $this->open_date = $messageData["open_date"];
            $this->new_message = $messageData["new_message"];
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
    public function getReceiveId()
    {
        return $this->receive_id;
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
    public function getNewMessage(){
        return $this->new_message;
    }
    public function setNewMessage($new_message){
        $this->new_message = $new_message;
    }
}