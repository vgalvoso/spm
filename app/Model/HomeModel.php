<?php
namespace App\Model;

use App\Libraries\Model;

class HomeModel extends Model{
  
    //returns object or false
    public function getUser(){
        $query = "SELECT * FROM users WHERE id = 1";
        return $this->getItem($query);
    }

    //returns array of objects or false
    public function getAllUsers(){
        $query = "SELECT * FROM users";
        return $this->getItems($query);
    }

    //using prepared statements to prevent sql injection
    public function validateUser($username,$password){
        $query = "SELECT * FROM users WHERE username = :uname AND pass = :pass";
        $params = ["uname" => $username, "pass"=>$password];
        return $this->getItem($query,$params);
    }

    //insert uses prepared statement to prevent sql injection
    public function addUser($username,$password,$firstname){
        $params = ["u_username"=>$username,
                "u_password"=>password_hash($password,PASSWORD_DEFAULT),
                "firstname"=>$firstname];
        if($this->insert("users",$params))
            return true;
        return false;
    }

    //returns true if success and false if not
    public function deleteUser($userId){
        $params = ["id" => $userId];
        $query = "DELETE FROM users WHERE id = :id";
        return $this->exec($query,$params);
    }

    //returns true if success and false if not
    public function updateUser($firstname,$userId){
        $query = "UPDATE users SET firstname = :firstname WHERE id = :userId";
        $params = ["firstname" => $firstname,"userId"=>$userId];
        return $this->exec($query,$params);
    }
}