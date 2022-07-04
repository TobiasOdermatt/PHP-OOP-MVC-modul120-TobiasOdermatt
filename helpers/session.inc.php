
<?php
session_start();
$userisloggedIn = isset($_SESSION["username"]);

function createSession($mail, $username, $role)
{
    $_SESSION["mail"] = $mail;
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;
}
?>