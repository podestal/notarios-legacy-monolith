<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consula = mysql_query("SELECT cliente.tipper, cliente.direccion, cliente.domfiscal FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consula);

if($row["tipper"]=="N"){
	
	$data = $row["direccion"];
	}
elseif($row["tipper"]=="J")
{
	$data = $row["domfiscal"];
	
	}


echo $data;
?>