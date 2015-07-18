<?php
header ('Content-type: text/html; charset=utf-8');
require_once ("src/user.php");
require_once ("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $newUser= new User();
    $newUser->login($conn, $_POST["name"], $_POST["password"]);

    if($newUser->getId()   != -1){
        $_SESSION["user_id"]=$newUser->getId();
        //var_dump($_SESSION);
        header("Location: http://localhost/Exercise/Twitter/");
        die();
    } else {
        echo "Błąd podczas logowania. <br>";
    }
}



?>




<form method="post" action="#">
    <label>Nazwa użytkownika</label><br>
    <input type="text" name="name" maxlength="255" value=""/><br>
    <label>Hasło</label><br>
    <input type="password" name="password" maxlength="255" value=""/><br>

    <button type="submit">Wyślij</button>
</form>
