<?php
include_once "header.php";
echo "Comment : ".$_GET['text']."<br>";
$userName = new User();
$userName->loadFromDB($conn, $_GET["user_id"]);
echo "Created by: ".$userName->getName()."<br>";
echo "Creation date : ".$_GET['creation_date']."<br>";
