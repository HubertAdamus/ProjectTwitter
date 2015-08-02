<?php
include_once "header.php";
echo "<h3><p>".$_GET['text']."</p></h3>";

$newMessage = new Message();
$newMessage->messageRead($conn, $_GET['id'], $_GET['new_message']);
$newMessage->openTime($conn, $_GET['id']);