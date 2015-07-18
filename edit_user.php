<?php
include "header.php";

$loggedUser = new User();
$loggedUser->loadFromDB($conn, $_SESSION["user_id"]);

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $loggedUser->saveToDB($conn, $_POST["desc"], $_POST["password"], $_POST["password2"]);
}



?>
<form method="post" action="#">
    <label>Description</label><br>
    <input type="text" name="desc" maxlength="255" value=""/><br>
    <label>Hasło</label><br>
    <input type="password" name="password" maxlength="255" value=""><br>
    <label>Powtórz hasło</label><br>
    <input type="password" name="password2" maxlength="255"  value=""><br>
    <button type="submit">Wyślij</button>
</form>



<?php
include "footer.php";
?>
