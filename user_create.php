<?php
require_once ("src/user.php");
require_once ("conn.php");
session_start();




if($_SERVER["REQUEST_METHOD"] === 'POST') {
    echo "<br>";
    $newUser = new User();
    $newUser->createUser($conn, $_POST["name"], $_POST["desc"], $_POST["password"], $_POST["password2"]);
    if ($newUser->getId() != -1) {
        $_SESSION["user_id"] = $newUser->getId();
        header("Location: http://localhost/ProjectTwitter/index.php");
        die();
    } else {
        echo "<br>Error during registration<br>";
    }
}
?>




<form method="post" style="padding: 20px">
    <label>CREATE USER</label><br>
    <label></label><br>
    <input type="text" name="name" maxlength="255" placeholder="Username"/><br>
    <label></label><br>
    <input type="text" name="desc" maxlength="255" placeholder="Description"/><br>
    <label></label><br>
    <input type="password" name="password" maxlength="255" placeholder="Password"><br>
    <label></label><br>
    <input type="password" name="password2" maxlength="255"  placeholder="Password again"><br>
    <label></label><br>
    <input type="submit" value="Send"/>
</form>
