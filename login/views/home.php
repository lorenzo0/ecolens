<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION['uid'])){
			echo "HOME DA LOGGATO";
			echo $_SESSION['uid'];
		} else {
			echo "HOME DA NON LOGGATO";
		}
	?>
</body>
</html>