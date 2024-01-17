<?php
class Db_object{
    public static function find_this_query($sql, $values = []){
        global $database;
        $result = $database->query($sql,$values);
        $the_object_array = [];
        while($row = mysqli_fetch_assoc($result)){
            $the_object_array[] = static::instantie($row);
        }
        return $the_object_array;
    }

    public static function find_all(){
        $result = static::find_this_query("SELECT * FROM " . static::$table_name . " ");
        //var_dump($result);
        return $result;
    }

    public static function find_by_id($id){
        $result = static::find_this_query("SELECT * FROM " . static::$table_name . " WHERE id=?", [$id]);

        return !empty($result) ? array_shift($result) : false;
    }

    public static function instantie($result){
        //static late binding
        $calling_class = get_called_class();
        $the_object = new $calling_class;
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

    /*CRUD*/
    public function create(){
        global $database;
        //tabel naam en de properties
        $table = static::$table_name;
        $properties= $this->get_properties();
        //filter de id property als het bestaat
        if(array_key_exists('id',$properties)){
            unset($properties['id']);
        }
        //escape van the values tegen sql injection
        $escaped_values = array_map([$database,'escape_string'], $properties);

        //placeholders maken
        $placeholders = array_fill(0, count($properties), '?');

        //create a string of field names seperated by commas
        $fields_string = implode(',', array_keys($properties));
        //create a string of types representing data type of each value
        $types_string = "";
        foreach ($properties as $value){
            if(is_int($value)){
                $types_string .="i";
            }elseif (is_float($value)){
                $types_string .= "d";
            }else{
                $types_string .= "s";
            }
        }
        //create prepared statement
        $sql = "INSERT INTO $table ($fields_string) VALUES (" . implode(',', $placeholders) .")";
        //execute the statement
        $database->query($sql, $escaped_values);
    }

    public function update()
    {
        global $database;
        // Taking the table name from the class
        $table = static::$table_name;
        // Taking the properties from the object
        $properties = $this->get_properties();
        unset($properties['id']);
        //escape van the values tegen sql injection
        $escaped_values = array_map([$database,'escape_string'], $properties);
        $escaped_values[] = $this->id;

        //placeholders maken
        $placeholders = array_fill(0, count($properties), '?');

        $fields_string = "";
        $i = 0;
        foreach ($properties as $key => $value){
            if($i > 0){
                $fields_string .= ", ";
            }
            $fields_string .= "$key = $placeholders[$i]";
            $i++;
        }
        /*//types = 'ssss'
        $types_string = "";
        foreach ($properties as $value){
            if(is_int($value)){
                $types_string .="i";
            }elseif (is_float($value)){
                $types_string .= "d";
            }else{
                $types_string .= "s";
            }
        }*/
        // prepared statement
        $sql = "UPDATE $table SET $fields_string WHERE id = ?";
        //execute the statement
        $database->query($sql, $escaped_values);
    }

    public function delete(){
        global $database;
        $table = static::$table_name;
        $escaped_id = $database->escape_string($this->id);

        $sql = "DELETE FROM " . $table . " WHERE id = ?";
        //params
        $params = [$escaped_id];
        //execute
        $database->query($sql, $params);
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }
}
?>