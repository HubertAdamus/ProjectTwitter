<?php
require_once "header.php";

$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);

if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $loggedUser->updateUser($conn, $_POST["desc"], $_POST["password"], $_POST["password2"]);
}



?>
<form method="post" style="padding: 20px">
    <label>CHANGE DESCRIPTION</label><br>
    <label></label><br>
    <input type="text" name="desc" maxlength="255"placeholder="Description"/><br>
    <label></label><br>
    <input type="password" name="password" maxlength="255" placeholder="Password"><br>
    <label></label><br>
    <input type="password" name="password2" maxlength="255"  placeholder="Password again"><br>
    <label></label><br>
    <input type="submit" value="Send"/>
</form>



<?php
include "footer.php";
?>
