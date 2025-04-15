<?php

	include("../conexion.php");
	$kardex = $_POST['kardex'];

	$query = "SELECT k.responsable ,k.responsable_new as loginusuario
			FROM kardex as k
			INNER JOIN usuarios as u ON u.idusuario=k.responsable
			WHERE k.kardex='$kardex'";

	$executeQuery=mysql_query($query,$conn);
	$result=mysql_fetch_assoc($executeQuery);
	echo json_encode($result);
?>