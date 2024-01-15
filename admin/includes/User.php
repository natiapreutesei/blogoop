<?php
class User{
    /*properties or variables*/
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    /*methods*/
    public static function find_this_query($sql, $values = []){
        global $database;
        $result = $database->query($sql,$values);
        $the_object_array = [];
        while($row = mysqli_fetch_assoc($result)){
            $the_object_array[] = self::instantie($row);
        }
        return $the_object_array;
    }

    public static function find_all_users(){
        $result = self::find_this_query("SELECT * FROM users");
        //var_dump($result);
        return $result;
    }

    public static function find_user_by_id($user_id){
        $result = self::find_this_query("SELECT * FROM users WHERE id=?", [$user_id]);

        return !empty($result) ? array_shift($result) : false;
    }
    public static function find_user_by_lastname($lastname){
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
    public static function instantie($result){
        $the_object = new self;
        foreach($result as $the_attribute => $value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    public function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

}
?>