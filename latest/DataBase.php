<?php

require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    

    function logIn($table, $username, $password)
    {
        $this->sql = "select * from " . $table . " where username = '" . $username . "' and password = '" . $password . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            if ($dbusername == $username ) {
               // $login = $row['id'];
               $login=$row;
            } else $login = NULL;
        } else $login = NULL;

        return $login;
    }

    function signUp($table, $fullname, $email, $username, $password)
    {
        $this->sql =
            "INSERT INTO " . $table . " (fullname, username, password, email) VALUES ('" . $fullname . "','" . $username . "','" . $password . "','" . $email . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

   function getRole($table, $user_id)
    {
        $this->sql = "select * from " . $table . " where user_id = " . $user_id ;
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
               $role=$row;
        } else $role = NULL;

        return $role;
    }

    function getTasks($table, $user_id)
    {
        $this->sql = "select * from " . $table . " where user_id = " . $user_id ;
        $result = mysqli_query($this->connect, $this->sql);
        //$row = mysqli_fetch_assoc($result);
        $new_tasks=new tasks();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
           //print("id: ".$row["id"]."\n");
           //print("taskName: ".$row["taskName"]."\n");
           //print("status: ".$row["status"]."\n");
           $new_tasks->append(new task($row["id"],$row["taskName"],$row["status"]));
        }
        return $new_tasks;
    }

}

?>
