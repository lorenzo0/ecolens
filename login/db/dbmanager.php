<?php
class DBManager {
	/*private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbpassword = "";
	private $dbdatabase = "ecolens";*/
    private $dbhost = "108.167.189.36";
    private $dbuser = "ecolens0";
    private $dbpassword = "GiorgiaSingsUnder7heShower!";
    private $dbdatabase = "ecolens0_sdb";

	private $conn;
    function __construct() {
        $this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbdatabase);
        if (!$conn) {
          echo mysqli_connect_errno() . ":" . mysqli_connect_error();
          exit;
        }
        return $conn;
	}

    function runBaseQuery($query) {
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if(isset($result->num_rows)){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $resultset[] = $row;
                }
            }
            if(!empty($resultset)) {
                return $resultset;
            } else {
                return false;
            }
        }
        else{
            return 0;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array($sql,'bind_param'), $param_value_reference);
    }
    
    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        //gestione errore?
    }
    
    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        //gestione errore?
    }
}
?>