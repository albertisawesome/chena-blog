<?php

require_once(__DIR__ . "/../model/config.php");

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

echo $username;

$query = $_SESSION["connection"]->query("SELECT password, salt FROM users WHERE username ='$username'");

if ($query->num_rows == 1) {
    $row = $query->fetch_array();

    if ($row["password"] === crypt($password, $row["salt"])) {
        $_SESSION["authenticated"] = true;
        echo "<p>Login Succesfull!</p>";
    } else {
        echo "<p>Invalid username and password1</p>";
    }
} else {
    echo "<p>Invalid username and password2<p>";
}