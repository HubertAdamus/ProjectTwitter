<?php
header ('Content-type: text/html; charset=utf-8');
require ("src/user.php");
require ("conn.php");

session_start();

if($_SERVER["REQUEST_METHOD"] === 'POST'){

    $newUser= new User();
    $newUser->login($conn, $_POST["name"], $_POST["password"]);

    if($newUser->getId() != -1){
        $_SESSION["user_id"]=$newUser->getId();
        var_dump($_SESSION);
        header("Location: http://localhost/ProjectTwitter/index.php");
        die();
    } else {
        echo "LOG ERROR <br>";
    }
}

?>




<form method="post" style="padding: 20px">
    <label>LOGIN</label><br>
    <label></label><br>
    <input type="text" name="name" maxlength="255" placeholder="Username"/><br>
    <label></label><br>
    <input type="password" name="password" maxlength="255" placeholder="Password"/><br>
    <label></label><br>
    <input type="submit" value="LOG"/>
</form>
<form action="user_create.php" style="padding: 20px">
    <input type="submit" value="CREATE NEW USER">
</form>


