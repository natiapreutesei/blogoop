<?php
class Photo extends Db_object{
    /*proprieties*/
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "assets/images/photos";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension",

    );
    protected static $table_name = "photos";

    /*get proprieties methods*/
    public function get_properties(){
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "filename" => $this->filename,
            "type" => $this->type,
            "size" => $this->size
        ];
    }

    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array['error'];
            return false;
        }else{
            $date = date("Y-m-d-H-i-s");
            $without_extension = pathinfo(basename($file['name']), PATHINFO_FILENAME);
            $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);

            $this->filename = $without_extension . $date . "." . $extension;
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
}
?>