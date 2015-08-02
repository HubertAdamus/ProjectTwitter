<?php
include_once "tweet.php";
 class User
 {
     /*
CREATE TABLE Users(
      id int AUTO_INCREMENT,
      nick VARCHAR (255) UNIQUE NOT NULL,
      hashed_password VARCHAR (60) NOT NULL,
      description TEXT,
      PRIMARY KEY (id)
);
      */

     private $id;
     private $name;
     private $desc;

     public function __construct(){
         $this->id = -1; // not loaded from dv - state unknown
         $this->name = "";
         $this->desc = "";
     }

     public function deleteUser(mysqli $conn, $id)
     {
         $sql = "DELETE FROM Users WHERE id='".$id."'";

         if ($conn->query($sql) === TRUE) {
             echo "Record deleted successfully";
         } else {
             echo "Error deleting record: " . $conn->error;
         }
    }



     public function getAllReceivedMessages(mysqli $conn){
         $sql = "SELECT * FROM Messages WHERE receive_id='".$this->id."'";
         $result = $conn->query($sql);

         $retReceivedArray = [];

         if ($result->num_rows>0){
             WHILE($row = $result->fetch_assoc()){
                 $tempMessage = new Message();
                 $tempMessage->loadFromDB($conn, $row['id']);
                 $retReceivedArray []=$tempMessage;
             }
         }
         return $retReceivedArray;
     }

     public function getAllSentMessages(mysqli $conn){
         $sql = "SELECT * FROM Messages WHERE send_id='".$this->id."'";
         $result = $conn->query($sql);

         $retSendArray = [];

         if ($result->num_rows>0){
             WHILE($row = $result->fetch_assoc()){
                 $tempMessage = new Message();
                 $tempMessage->loadFromDB($conn, $row['id']);
                 $retSendArray []=$tempMessage;
             }
         }
         return $retSendArray;
     }

     /**
      * @param mysqli $conn
      * @param $userId
      * @return array
      * USER_SHOW
      */
     public function getAllTweetsFromId(mysqli $conn, $userId){
         $sqlGetUserTweets = "SELECT * FROM Tweets WHERE user_id='" . $userId . "'";
         $result = $conn->query($sqlGetUserTweets);

         $retArrayId = [];

         if ($result->num_rows>0){
             WHILE($row = $result->fetch_assoc()){
                 $tempTweet = new Tweet();
                 $tempTweet->loadFromDB($conn, $row['id']);
                 $retArrayId []=$tempTweet;
             }
         }
         return $retArrayId;
     }

     /**
      * @param mysqli $conn
      * @param $numberOfPosts
      * @return array
      * INDEX
      */
     public function getEverybodyTweets(mysqli $conn, $numberOfPosts){
         $sql = "SELECT * FROM Tweets WHERE user_id!='" . $this->id . "' LIMIT " . $numberOfPosts;
         $result = $conn->query($sql);

         $retArrayAll = [];

         if ($result->num_rows>0){
             WHILE($row = $result->fetch_assoc()){

                 $tempData = new Tweet();
                 $tempData->loadFromDB($conn, $row['id']);
                 $retArrayAll []=$tempData;
             }
         }
         return $retArrayAll;
     }

     /**
      * @param mysqli $conn
      * @param $numberOfPosts
      * @return array
      * INDEX
      */
     public function getAllTweets(mysqli $conn, $numberOfPosts){
         $sql = "SELECT * FROM Tweets WHERE user_id='" . $this->id . "' LIMIT " . $numberOfPosts;
         $result = $conn->query($sql);

         $retArrayUser = [];

         if ($result->num_rows>0){
             WHILE($row = $result->fetch_assoc()){
                 $tempTweet = new Tweet();
                 $tempTweet->loadFromDB($conn, $row['id']);
                 $retArrayUser []=$tempTweet;
             }
         }
         return $retArrayUser;
     }
     public function login(mysqli $conn, $name, $pass)
     {
         $sqlGetUser = "SELECT * FROM Users WHERE nick= '" . $name . "'";
         $result = $conn->query($sqlGetUser);
         if ($result->num_rows === 1) {
             $userData = $result->fetch_assoc();
             if (password_verify($pass, $userData["hashed_password"])) {
                 $this->id = $userData["id"];
                 $this->name = $userData["nick"];
                 $this->desc = $userData["description"];
             } else {
                 echo "Wrong name or password.<br>";
             }

         } else {
             echo "Error during logging<br>";
             echo "Error: " . $conn->error . "<br>";
         }
     }
     public function showUser()
     {
         echo(
             "User: " . $this->name . "<br>
             Description: " . $this->desc . "<br>
             "
         );
     }
     public function updateUser(mysqli $conn, $newDesc, $newPass, $newPass2)
     {
         if ($newPass !== $newPass2) {
             echo "Passwords does not match";
             return;
         }
         $options = [
             'cost' => 11,
             'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
         ];

         $hashedPas = password_hash($newPass, PASSWORD_BCRYPT, $options);
         $newDesc = $conn->real_escape_string($newDesc);
         $sqlUpdateUser = " UPDATE Users SET hashed_password='" . $hashedPas . "',
                                              description='" . $newDesc . "'
                                                  WHERE id=" . $this->id;
         $result = $conn->query($sqlUpdateUser);
         if ($result == TRUE) {
             $this->desc = $conn->$newDesc;
         } else {
             echo "Error: " . $conn->error . "<br>";
         }
     }
     public function createUser(mysqli $conn, $name, $desc, $password, $password2)
     {
         if ($password != $password2) {
             echo "Passwords does not match";
             return;
         }
         $options = [
             'cost' => 11,
             'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
         ];

         $hashedPas = password_hash($password, PASSWORD_BCRYPT, $options);
         $sqlInsertUser = " INSERT INTO Users(nick, hashed_password, description) VALUES ('" . $name . "','" . $hashedPas . "','" . $desc . "')";
         $result = $conn->query($sqlInsertUser);
         if ($result == TRUE) {
             $this->id = $conn->insert_id;
             $this->name = $conn->$name;
             $this->desc = $conn->$desc;
         }
     }
     public function loadFromDB(mysqli $conn, $idToLoad){
         $sqlLoadUser = "SELECT * FROM Users WHERE id= '" . $idToLoad . "'";
         $result = $conn->query($sqlLoadUser);

         if ($result->num_rows === 1) {
             $userData = $result->fetch_assoc();

             $this->id = $userData["id"];
             $this->name = $userData["nick"];
             $this->desc = $userData["description"];
         }
     }




     public function generateLinkToMyPage()
     {
         return "<a href='http://localhost/ProjectTwitter/user_show.php?user_id=" . $this->id . "'>" . $this->name . "</a>";
     }
     public function getId()
     {
         return $this->id;
     }
     public function getName()
     {
         return $this->name;
     }
     public function setName($name)
     {
         $this->name = $name;
     }
     public function getDesc()
     {
         return $this->desc;
     }
     public function setDesc($desc)
     {
         $this->desc = $desc;
     }
 }