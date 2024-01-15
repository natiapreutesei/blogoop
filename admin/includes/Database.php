<?php
require_once('config.php');
class Database
{
    /*properties or variables*/
    public $connection;

    /*methodes and functions*/
    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            printf("Connection failed: %s\n", mysqli_connect_error());
            exit();
        }
    }
    public function query($sql, $params = []){
        //create a prepared statement
        $stmt = $this->connection->prepare($sql);
        // bind parameters
        if (!empty($params)) {
            $types = "";
            $values = [];
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= "i";
                } elseif (is_string($param)) {
                    $types .= "s";
                } elseif (is_float($param)) {
                    $types .= "d";
                }
                $values[] = $param;
                //var_dump($values);
            }
        }
        array_unshift($values, $types);
        call_user_func_array([$stmt, "bind_param"],$this ->ref_values($values));
        //execute statement
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
        /*//method chaining
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;*/
    }
    private function ref_values($array){
        //var_dump($array);
        $refs = [];
        foreach ($array as $key => $value) {
            /*var_dump($array);
            var_dump($key);
            var_dump($value);*/
            if ($key === 0) {
                $refs[$key] = $value;
                //var_dump($refs);
            }else{
                $refs[$key] = &$array[$key];
                //var_dump($refs);
            }

        }
        return $refs;
    }
    private function confirm_query($result)
    {
        if (!$result) {
            die("QUERY FAILED ." . $this->connection->error);
        }
    }
    public function escape_string($string){
        $escape_string = $this->connection->real_escape_string($string);
        return $escape_string;
    }
    /*constructors*/
    function __construct()
    {
        $this->open_db_connection();
    }
}

$database = new Database();
?>