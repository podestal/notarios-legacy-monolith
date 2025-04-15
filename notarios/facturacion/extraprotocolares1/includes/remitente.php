<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

#";

$consul = mysql_query("SELECT cliente.nombre, cliente.numdoc, cliente.tipper, cliente.razonsocial FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consul);

if($row["tipper"]=="N"){
	
	$data = $row["nombre"];
	}
elseif($row["tipper"]=="J")
{
	$data = $row["razonsocial"];
	
	}

echo $data;
?>