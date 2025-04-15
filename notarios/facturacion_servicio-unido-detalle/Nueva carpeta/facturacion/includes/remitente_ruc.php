<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

#";

$consul = mysql_query("SELECT cliente.razonsocial FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consul);

$data = $row["razonsocial"];

echo $data;
?>