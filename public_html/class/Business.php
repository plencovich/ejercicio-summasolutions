<?php
defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden'));

class Business {

    private $database;
    private $db;
    private $conn;
    private $table_name = "business";

    public function __construct(){
        require_once(CONFIG_PATH.'database.php');

        $this->database = new Database();
        $this->db = $this->database->getConnection();
        $this->conn = $this->db;
    }

    public function getInfo($idBiz=NULL) {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name;
        if(isset($idBiz)){
			$query .= ' WHERE b_id = '.$idBiz;
        }

        $stmt = $this->conn->prepare( $query );
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt;
    }

}
?>
