<?php
include_once "header.php";
$user=new User;
$user->deleteUser($conn, $_SESSION['user_id']);
header("Location: http://localhost/ProjectTwitter/user_login.php");