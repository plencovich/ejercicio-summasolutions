<?php
defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden'));

class Database {

    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    public $conn;

    function __construct()
    {
        $this->db_host = getenv('DB_HOST');
        $this->db_name = getenv('DB_NAME');
        $this->db_user = getenv('DB_USER');
        $this->db_pass = getenv('DB_PASS');
    }

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
        }catch(PDOException $exception){
            echo "Error de Conexion: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
