<?php
include_once ("src/user.php");
include_once ("src/tweet.php");
include_once ("src/comment.php");
include_once ("src/message.php");
include_once ("conn.php");
session_start();

if(isset($_SESSION["user_id"]) == FALSE){
    header("Location: http://localhost/ProjectTwitter/user_login.php");
    die();
}

header ('Content-type: text/html; charset=utf-8');
echo("<a href='index.php' style='text-decoration: none'>MAIN  </a>");
echo "   |   ";
echo("<a href='user_edit.php' style='text-decoration: none'>EDIT  </a>");
echo "   |   ";
echo("<a href='user_show.php' style='text-decoration: none'>PROFILE  </a>");
echo "   |   ";
echo("<a href='users_list_all.php' style='text-decoration: none'>USERS  </a>");
echo "   |   ";
echo("<a href='message_show.php' style='text-decoration: none'>MESSAGES  </a>");
echo "   |   ";
echo("<a href='user_logoff.php' style='text-decoration: none'>LOGOFF </a><br>");
echo "<hr>";


