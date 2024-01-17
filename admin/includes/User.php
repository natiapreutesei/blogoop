<?php
class User extends Db_object{
    /*properties or variables*/
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    protected static $table_name = "users";

    /*get proprieties methods*/
    public function get_properties(){
        return [
            "id" => $this->id,
            "username" => $this->username,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "password" => $this->password
        ];
    }

    /*methods*/
    public static function find_by_lastname($lastname){
        global $database;
        // sanitizing the lastname
        $lastname = $database->escape_string($lastname);
        $result = $database->query("SELECT * FROM users WHERE last_name LIKE '%$lastname%'");
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

    /*verify user*/
    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password= $database->escape_string($password);

        //SELECT * FROM users WHERE username = ? and password = ? LIMIT 1

        $sql = "SELECT * FROM " . self::$table_name . " WHERE ";
        $sql .= "username = ? ";
        $sql .= "AND password = ? ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql,[$username,$password]);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}
?>