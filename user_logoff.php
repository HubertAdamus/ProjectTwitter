<?php
header ('Content-type: text/html; charset=utf-8');
session_destroy();

var_dump($_SESSION);
header("Location: http://localhost/ProjectTwitter/user_login.php");