<?php
require_once('dbmanager.php');

class Authentication {
	function newUser($username, $password) {
		$db_handle = new DBManager();

        $query = "CALL REGISTER(?,?)";
        $result = $db_handle->runQuery($query, 'ss', array($username, password_hash($password, PASSWORD_DEFAULT)));

        return $result;
	}
    function login($username) {
        $db_handle = new DBManager();

        $query = "CALL LOGIN(?)";
        $result = $db_handle->runQuery($query, 's', array($username));

        return $result;
    }
}

if(isset($_POST["uname"]) && isset($_POST["psw"]) && isset($_POST["action"])) {
    if($_POST["action"] == "registration") {
        session_start();

        $post = new Authentication();
        $query = $post->newUser($_POST["uname"], $_POST["psw"]);

        $_SESSION['uid'] = $query[0]['ID'];

        echo json_encode($query);
    } else if($_POST["action"] == "login") {
        session_start();

        $post = new Authentication();
        $query = $post->login($_POST["uname"]);

        if(password_verify($_POST["psw"], $query[0]['PASSWORD']) == true) {
            $_SESSION['uid'] = $query[0]['ID'];
            echo json_encode($query);
        } else {
            echo -1;
        }
    }
} else {
    echo "Error";
    http_response_code(400);
}
?>