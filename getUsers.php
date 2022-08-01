
<?php
require "DataBase.php";
require "myClasses.php";

header('Content-type: application/json');

$db = new DataBase();

    if ($db->dbConnect()) {
        $mygames=  $db->users("users");e
        echo json_encode($mygames);
    }   

?>
