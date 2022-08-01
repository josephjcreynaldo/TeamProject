<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_GET['username']) && isset($_GET['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("users", $_GET['username'], $_GET['password'])) {
            echo "Login Success";
        } else echo "Username or Password wrong";
    } else echo "Error: Database connection";
} else echo "All fields are required ";
?>
