<?php
include_once "header.php";
$showMessage = new User();
$showMessage->loadFromDB($conn, $_SESSION["user_id"]);
echo "<h1>".$showMessage->getName()."'s messages : </h1><br>";
echo "<h2>Received</h2><br>";
echo "<hr>";

$retReceivedArray=$showMessage->getAllReceivedMessages($conn);
foreach ($retReceivedArray as $message) {
    echo $message->checkIfNew();
    echo "Message from ";
    echo $message->showMessageUser($conn, $message->getSendId());
    echo ": <br>";
    echo $message->showMessage();
    echo "<hr>";
};
echo "<h2>Sent</h2><br>";
echo "<hr>";
$retSendArray=$showMessage->getAllSentMessages($conn);
foreach ($retSendArray as $message) {
    echo "Message to ";
    echo $message->showMessageUser($conn, $message->getReceiveId());
    echo ": <br>";
    echo $message->showMessage();
    echo "<hr>";
};