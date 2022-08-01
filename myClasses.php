<?php

class role
{
    public $roleName; 
}

class task
{
    public $id; 
    public $taskName; 
    public $status;

   public function __construct($id,$taskName,$status) {
      $this->id = $id;
      $this->taskName = $taskName;
      $this->status = $status;
      
   }
}

class tasks  extends ArrayObject
{
    public function offsetSet($name, $value)
    {
        if (!is_object($value) || !($value instanceof task))
        {
            throw new InvalidArgumentException(sprintf('Only objects of task allowed.'));
        }
        parent::offsetSet($name, $value);
    }
}


class user extends role 
{
    public $id;
    public $fullname;
    public $email;
    public $username;
    public $tasks;

   public function __construct($id,$fullname,$email,$username) {
      $this->id = (int) $id;
      $this->fullname = $fullname;
      $this->email = $email;
      $this->username = $username;
      $this->tasks = new tasks();
   }
}


class users 
{
   public $users=array();

   function populateUsers($user) {
       $this->users[] = $user;
   } 

}


?>
