<?php
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

     public function login(mysqli $conn, $name, $insertedpassword)
     {
         $sqlGetUser = "SELECT * FROM Users WHERE nick= '" . $name . "'";
         $result = $conn->query($sqlGetUser);
         if ($result->num_rows === 1) {
             $userData = $result->fetch_assoc();
             if (password_verify($insertedpassword, $userData["hashed_password"])) {
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

     public function register(mysqli $conn, $name, $desc, $password, $password2)
     {
         if ($password !== $password2) {
             echo "Passwords does not match";
             return;
         }
         $options = [
             'cost' => 11,
             'salt' => "qwertasdfgzxcvbqwertas"//mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
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

     public function showUser()
     {
         echo(
             "User: " . $this->name . "<br>
             Desc: " . $this->desc . "<br>
             "
         );
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

     public function getAllPosts(mysqli $conn, $numberOfPosts){
         $sql = "SELECT * FROM Tweets WHERE user_id='" . $this->id . "' LIMIT " . $numberOfPosts;
         $result = $conn->query($sql);

         $retArray = array();
         if ($result->num_rows > 0) {
             //TODO: Stworzyć obiekt klasy Tweet i dodać je do tablicy zwrotnej z tej funkcji
             WHILE($tweetData = $result->fetch_assoc()){
                 $tempTweet = new Tweet();
                 $tempTweet->loadFromDB($conn, $tweetData['id']);

                 $retArray[]=$tempTweet;
             }
         }
         return $retArray;
     }

     public function saveToDB(mysqli $conn, $newDesc, $newPass, $newPass2)
     {
         if ($newPass !== $newPass2) {
             echo "Passwords does not match";
             return;
         }
         $options = [
             'cost' => 11,
             'salt' => "qwertasdfgzxcvbqwertas"//mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
         ];

         $hashedPas = password_hash($newPass, PASSWORD_BCRYPT, $options);


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

     public function generateLinkToMyPage()
     {
         return "<a href='http://localhost/Exercise/Twitter/user_show.php?user_id=" . $this->id . "'>" . $this->name . "</a>";
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