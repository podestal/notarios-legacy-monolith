<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consulb = mysql_query("SELECT cliente.tipper, cliente.telfijo, cliente.telempresa FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);

if($row["tipper"]=="N"){
	
	$data = $row["telfijo"];
	}
elseif($row["tipper"]=="J")
{
	$data = $row["telempresa"];
	
	}


echo $data;
?>