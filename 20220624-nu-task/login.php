
<?php
require "DataBase.php";
require "myClasses.php";

$db = new DataBase();
if (isset($_GET['username']) && isset($_GET['password'])) {
    if ($db->dbConnect()) {
        $res=  $db->logIn("users", $_GET['username'], $_GET['password']);
        if ($res) {
            //$res['username']
            echo "Login Success : userid:".$res['id'];
            $user = new user($res['id'],$res['fullname'],$res['email'],$res['username']);

            $user->tasks[] = new task(1,'task1','on going'); // works fine
            $user->tasks[] = new task(2,'task2','on going'); // works fine

            echo ' </br> $user->username:'.$user->username;

            $var_roles=  $db->getRole("roles", $res['id']);
            if(is_null($var_roles)){
               // echo ' no roles for this user';
                $user->roleName="User";
            }
            else {
               //echo '  roles for this user is :'.$var_roles['roleName'];
               $user->roleName=$var_roles['roleName'];
            }

            echo ' </br> roles for this user is :'.$user->roleName;            

            foreach($user->tasks as $key => $value){

               echo "The Key <b>". $key."</b> has the value <b>".print_r($value)."</b><br>" ;
            }


            

        } else echo "Username or Password wrong! userid:".$res['id'];
    } else echo "Error: Database connection";
} else echo "All fields are required ";
?>
