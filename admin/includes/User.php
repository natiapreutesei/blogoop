<?php
class User{
    /*properties or variables*/
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    /*methods*/
    public static function  find_this_query($sql, $values = []){
        global $database;
        $result = $database->query($sql, $values);
        return $result;
    }
    public static function find_all_users(){
        global $database;
        $result = $database->query("SELECT * FROM users");
//        var_dump($result);
//        print_r($result);
        return $result;
    }
    public static function find_user_by_id($user_id){
        global $database;
        // sanitizing the user_id
        $user_id = $database->escape_string($user_id);
        $result = $database->query("SELECT * FROM users WHERE id =?", [$user_id]);
        return $result;
    }
    public static function find_user_by_lastname($lastname){
        global $database;
        // sanitizing the lastname
        $lastname = $database->escape_string($lastname);
        $result = $database->query("SELECT * FROM users WHERE last_name LIKE '% . $lastname . %'");
        return $result;
    }
    //find user by lastname
    public static function find_user_by_firstname($firstname){
        global $database;
        // sanitizing the lastname
        $firstname = $database->escape_string($firstname);
        $result = $database->query("SELECT * FROM users WHERE first_name = '% . $firstname . %'");

        return $result;
    }
}
?>