
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

            echo ' </br> roles for this user is :'.$user->roleName . ' </br> ';            


            $user->tasks=  $db->getTasks("task", $res['id']);

		foreach($user->tasks as $key => $value)
		{
//			  echo 'key:'.$key." has the value:". var_dump($value) .' <br>';
//			  echo  var_dump($value) .' <br>';
                    echo  $value->taskName .' <br>';
		}
            //assginment
            //create a method that will get specific task
            

        } else echo "Username or Password wrong! userid:".$res['id'];
    } else echo "Error: Database connection";
} else echo "All fields are required ";
?>
