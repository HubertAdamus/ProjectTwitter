<?php

$conn = new mysqli("localhost", "Hubert", "test", "Twitter");
//echo "Połączenie aktywne<br>";

if ($conn ==null && $conn->errno !=0){
    echo "Error connecting to database:<br>";
    echo ($conn->errno);
    die("Połączenie nie udane");
    die();
}
?>