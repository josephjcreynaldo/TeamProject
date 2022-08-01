
<?php
require "DataBase.php";
require "myClasses.php";

header('Content-type: application/json');

$db = new DataBase();
if (isset($_GET['username']) && isset($_GET['password'])) {
    if ($db->dbConnect()) {
        $res=  $db->logIn("users", $_GET['username'], $_GET['password']);
        if ($res) {
            $user = new user($res['id'],$res['fullname'],$res['email'],$res['username']);           
            $var_roles=  $db->getRole("roles", $res['id']);
            if(is_null($var_roles)){
                $user->roleName="User";
            }
            else {
               $user->roleName=$var_roles['roleName'];
            }
            $user->tasks = $db->getTasks("task", $res['id']);

            echo json_encode($user);

          } else echo json_encode(new user(-1,"","",""));

      } else echo  print_r(new user(-1,"","",""));

} else echo  json_encode(new user(-1,"","",""));
?>
