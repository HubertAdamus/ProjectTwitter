<?php
header ('Content-type: text/html; charset=utf-8');
require_once ("src/user.php");
require_once ("conn.php");
session_start();



if(isset($_SESSION["user_id"]) == FALSE){
    header("Location: http://localhost/Exercise/Twitter/login.php");
    die();
}


echo("<a href='http://localhost/Exercise/Twitter/index.php'>HOME </a><br>");
echo("<a href='http://localhost/Exercise/Twitter/edit_user.php'>EDIT </a><br>");
echo("<a href='http://localhost/Exercise/Twitter/show_user.php'>MY </a><br>");
echo("<a href='http://localhost/Exercise/Twitter/list_all_users.php'>USERS </a><br>");

?>

