<!DOCTYPE html>
<html>
<head>
	<title>Register page</title>
	<style type="text/css">
		table{
			margin-top: 150px;
			border:1px solid;
			background-color: #eee;
		}
		td{
			border: 0px;
			padding: 10px;
		}
		th{
			border-bottom: 1px solid;
			background-color: #ddd;
		}
	</style>
</head>
<body>
	<?php
		//SE SONO GIA' LOGGATO VADO ALLA HOME
		session_start();
		if(isset($_SESSION['uid'])){
			header("location:home.php");
			exit;
		}
		//ALTRIMENTI VEDO LA PAGINA
	?>

	<table align="center">
		<tr>
			<th colspan="2">
				<h2>Register</h2>
			</th>
		</tr>
		<tr>
			<td>
				Username:
			</td>
			<td>
				<input type="text" name="uname" id="uname">
			</td>
		</tr>
		<tr>
			<td>
				Password:
			</td>
			<td>
				<input type="password" name="pwd" id="psw">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<button onclick="registration()">
			</td>
		</tr>
	</table>

</body>
<script type="text/javascript">
	function registration() {
		var xml = new XMLHttpRequest();
		xml.onreadystatechange = function() {
		    if( xml.readyState==4 && xml.status==200 ) {
		        //console.log(JSON.parse(xml.responseText));
		        window.location.href = "home.php";
		    }
		};
		xml.open("POST", "/login/db/queriesAuthentication.php", true);
		xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xml.send("uname=" + document.getElementById('uname').value + "&psw=" + document.getElementById('psw').value + "&action=registration");
	}
</script>
</html>