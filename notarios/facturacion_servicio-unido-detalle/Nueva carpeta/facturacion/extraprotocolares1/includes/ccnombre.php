<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consulb = mysql_query("SELECT cliente.nombre, cliente.numdoc, cliente.tipper, cliente.razonsocial FROM cliente WHERE cliente.numdoc  = '".$numdoc."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);

if($rowb["tipper"]=="N"){
	
	$data = $rowb["nombre"];
	}
elseif($rowb["tipper"]=="J")
{
	$data = $rowb["razonsocial"];
	
	}



echo $data;
?>