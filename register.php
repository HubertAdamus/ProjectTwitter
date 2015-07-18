<?php
header ('Content-type: text/html; charset=utf-8');
require_once ("src/user.php");
require_once ("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    var_dump($_POST);
    echo "<br>";
    $newUser = new User();
    $newUser->register($conn, $_POST["name"], $_POST["desc"], $_POST["password"], $_POST["password2"]);

    if($newUser->getId() != -1){
        $_SESSION["user_id"]=$newUser->getId();
        header ("Location: http://localhost/Exercise/Twitter/");
        die();
    }else{
        echo "Error during register.<br>";
    }
}

?>




<form method="post" action="#">
    <label>Nazwa użytkownika</label><br>
    <input type="text" name="name" maxlength="255" value=""/><br>
    <label>Description</label><br>
    <input type="text" name="desc" maxlength="255" value=""/><br>
    <label>Hasło</label><br>
    <input type="password" name="password" maxlength="255" value=""><br>
    <label>Powtórz hasło</label><br>
    <input type="password" name="password2" maxlength="255"  value=""><br>
    <button type="submit">Wyślij</button>
</form>
