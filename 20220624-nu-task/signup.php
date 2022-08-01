<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_GET['fullname']) && isset($_GET['email']) && isset($_GET['username']) && isset($_GET['password'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("users", $_GET['fullname'], $_GET['email'], $_GET['username'], $_GET['password'])) {
            echo "Sign Up Success";
        } else echo "Sign up Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
