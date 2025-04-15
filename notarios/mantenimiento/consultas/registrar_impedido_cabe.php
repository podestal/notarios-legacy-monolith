<?php 

include ("../../conexion.php");


$n_cod=intval($_POST['n_cod']);
$n_fecha=$_POST['n_fecha'];
$n_impentidad=$_POST['n_impentidad'];
$n_impmotivo=$_POST['n_impmotivo'];

$sql=mysql_query("insert into impedidos (idimpedido,idcliente,fechaing,oficio,origen,motivo) 
				  values ('".$n_cod."','','".$n_fecha."','','".$n_impentidad."','".$n_impmotivo."')",$conn);
		  

?>