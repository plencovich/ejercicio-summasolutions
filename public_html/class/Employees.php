<?php
defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden'));

class Employees {

    private $database;
    private $db;
    private $conn;
    private $table_name = "employees";
    private $biz_name = "business";

    public $first_name;
    public $last_name;
    public $age;
    public $type_employee;
    public $biz_id;
    public $sub_type;

    public function __construct(){
        require_once(CONFIG_PATH.'database.php');

        $this->database = new Database();
        $this->db = $this->database->getConnection();
        $this->conn = $this->db;
    }

    public function getInfo($idEmployee=NULL, $ageTotal=NULL) {
        $query = "SELECT
                    e_id, e_first_name, e_last_name, CONCAT(e_first_name, ' ', e_last_name) AS e_full_name, e_age, b_name, et_name, est_name";
        if((bool)$ageTotal){
			$query .= " ,AVG(e_age) AS average";
        }
        $query .= " FROM
                    " . $this->table_name . "
                INNER JOIN ". $this->biz_name . " ON e_biz_id = b_id
                INNER JOIN employees_type ON e_type = et_id
                INNER JOIN employees_sub_type ON e_sub_type = est_id";

        if(isset($idEmployee)){
			$query .= ' WHERE e_id = '.$idEmployee;
        }

        $query .=" ORDER BY
                    e_last_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt;
    }

    public function setData(){

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    e_first_name=:first_name, e_last_name=:last_name, e_age=:age, e_type=:type_employee, e_sub_type=:sub_type, e_biz_id=:biz_id";

        $stmt = $this->conn->prepare($query);

        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->type_employee=htmlspecialchars(strip_tags($this->type_employee));
        $this->sub_type=htmlspecialchars(strip_tags($this->sub_type));
        $this->biz_id=htmlspecialchars(strip_tags($this->biz_id));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":type_employee", $this->type_employee);
        $stmt->bindParam(":sub_type", $this->sub_type);
        $stmt->bindParam(":biz_id", $this->biz_id);

        return ($stmt->execute()) ? TRUE : FALSE;
    }

    public function typeEmployees($typeId=NULL) {
        $query = "SELECT
                    *
                FROM employees_type";
        if(isset($typeId)){
			$query .= ' WHERE et_id = '.$typeId;
		}
        $query .= " ORDER BY
                    et_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt;
    }

    public function subTypeById($idSubTypes) {
        $query = "SELECT
                    *
                FROM employees_sub_type
                WHERE est_et_id = ". $idSubTypes ."
                ORDER BY
                    est_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
