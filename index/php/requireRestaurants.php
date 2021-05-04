<?php
	//require_once("queries.php");

	if(isset($_POST["id"])){
		//$query = new Query();

		//$result = $query->queryOne($_POST["id"]);

		/*if(!empty($result)){
			echo json_encode($result);
		} else {
			echo 0;
		}*/
		echo "ciao";
    } else {
        print_r($_POST);
        echo "Error";
        http_response_code(400);
    }
?>